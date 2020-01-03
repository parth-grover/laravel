@extends('dashboard.layout')
@section('content')
	 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('users.create')}}"><button type="button" class="btn btn-sm btn-outline-secondary">Add User</button></a>
          </div>
        </div>
      </div>
	 @if($user)
		<div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>id</th>
				  <th>Name</th>
				  <th>Email</th>
				  <th>Thumbnail</th>
				  <th>City</th>
				  <th>Country</th>
				  <th>Roles</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
					 <tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td><img src="{{asset('storage/'.$user->profile->photo)}}" width="50" height="50"></td>
						<td>{{$user->profile->city}}</td>
						<td>{{$user->profile->country->name}}</td>
						@if(!$user->roles->isEmpty())
							<td>{{$user->roles->implode('name',', ')}}</td>
						@endif
						<td>
							<a href="{{route('users.show',$user->id)}}">Show</a> |
							<form method="post" action="{{route('roles.destroy',$user->id)}}">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-link">Delete</button>
							</form> |
							<a href="{{route('users.edit',$user->id)}}">Edit</a>
						</td>
					 </tr>	
			  </tbody>
			  </table>
	    </div>
	 @else
		 <p class="alert alert-info">No Record Found...</p>
	 @endif    
@endsection 