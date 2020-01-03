@extends('dashboard.layout')
@section('content')
	 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Posts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('posts.create')}}"><button type="button" class="btn btn-sm btn-outline-secondary">Add Post</button></a>
          </div>
        </div>
      </div>
	  @if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
		@endif
	 @if(!$posts->isEmpty())
		<div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>id</th>
				  <th>title</th>
				  <th>Content</th>
				  <th>Image</th>
				  <th>slug</th>
				  <th>Created At</th>
				  <th>Updated At</th>
				  <th>Categories</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
					@foreach($posts as $post)
					 <tr>
						<td>{{$post->id}}</td>
						<td>{{$post->title}}</td>
						<td>{{$post->content}}</td>
						<td><img src="{{asset('storage/'.$post->thumbnail)}}" width="50" height="50"></td>
						<td>{{$post->slug}}</td>
						<td>{{$post->created_at}}</td>
						<td>{{$post->updated_at}}</td>
						@if(!$post->categories->isEmpty())
							<td>{{$post->categories->implode('title',', ')}}</td>
						@endif
						<td>
						<td>
							<a href="{{route('posts.show',$post->id)}}">Show</a> |
							@can('isuserPost',$post->user->id)
							<form method="post" action="{{route('posts.destroy',$post->id)}}">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-link">Delete</button>
							</form> |
							<a href="{{route('posts.edit',$post->id)}}">Edit</a>
							@endcan
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