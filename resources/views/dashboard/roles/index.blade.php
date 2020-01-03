@extends('dashboard.layout')
@section('content')
	 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Roles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('roles.create')}}"><button type="button" class="btn btn-sm btn-outline-secondary">Add Role</button></a>
          </div>
        </div>
      </div>
	 @if(!$roles->isEmpty())
		<div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>id</th>
				  <th>Role Name</th>
				  <th>Created date</th>
				  <th>Updated date</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
					@foreach($roles as $role)
					 <tr>
						<td>{{$role->id}}</td>
						<td>{{$role->name}}</td>
						<td>{{$role->created_at}}</td>
						<td>{{$role->updated_at}}</td>
						<td>
							<a href="{{route('roles.show',$role->id)}}">Show</a> |
							<form method="post" action="{{route('roles.destroy',$role->id)}}">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-link">Delete</button>
							</form> |
							<a href="{{route('roles.edit',$role->id)}}">Edit</a>
						</td>
					 </tr>	
                    @endforeach
			  </tbody>
			  </table>
	    </div>
	 @else
		 <p class="alert alert-info">No Record Found...</p>
	 @endif    
@endsection 