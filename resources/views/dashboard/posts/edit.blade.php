@extends('dashboard.layout')
@section('content')
	<form class="form-inline" action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PUT')
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Title</label>
		<input type="text" class="form-control" id="inputPassword2" name="title" value="{{$post->title}}" placeholder="Enter Category Name">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<img src="{{asset('storage/'.$post->thumbnail)}}" width="50" height="50">
		<label for="inputPassword2" class="sr-only">Thumbnail</label>
		<input type="file" class="form-control form-file-control" id="inputPassword2" name="thumbnail">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Content</label>
		<input type="text" class="form-control" id="inputPassword2" name="content" value="{{$post->content}}" placeholder="Enter Content">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Name</label>
		<select name="categories[]" multiple>
			<option value="0">Select a category</option>
			@if(!$categories->isEmpty())
				@foreach($categories as $cat)
					<option @if(in_array($cat->id,$post->categories->pluck('id')->toArray()))
						{{'selected'}} 
					@endif value="{{$cat->id}}">{{$cat->title}}</option>
				@endforeach
			@endif	
		</select>
	  </div>
	  <button type="submit" class="btn btn-primary mb-2">Submit</button>
	</form>
@endsection