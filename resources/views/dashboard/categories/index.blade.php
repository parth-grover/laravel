@extends('dashboard.layout')
@section('content')
	 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Roles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('categories.create')}}"><button type="button" class="btn btn-sm btn-outline-secondary">Add Category</button></a>
          </div>
        </div>
      </div>
	 @if(!$categories->isEmpty())
		<div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>id</th>
				  <th>Category Name</th>
				  <th>Content</th>
				  <th>Image</th>
				  <th>parent</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
					@foreach($categories as $category)
					 <tr>
						<td>{{$category->id}}</td>
						<td>{{$category->title}}</td>
						<td>{{$category->content}}</td>
						<td><img src="{{asset('storage/'.$category->thumbanil)}}" width="50" height="50"></td>
						<td>
							@if(empty($category['parent']))
								{{'parent Category'}}
							@else
								{{$category['parent']->title}}
							@endif
						</td>
						<td>
							<a href="{{route('categories.show',$category->id)}}">Show</a> |
							<form method="post" action="{{route('categories.destroy',$category->id)}}">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-link">Delete</button>
							</form> |
							<a href="{{route('categories.edit',$category->id)}}">Edit</a>
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