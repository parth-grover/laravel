@extends('dashboard.layout')
@section('content')
	<form class="form-inline" action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PUT')
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Category Name</label>
		<input type="text" class="form-control" id="inputPassword2" name="title" value="{{$category->title}}" placeholder="Enter Category Name">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<img src="{{asset('storage/'.$category->thumbanil)}}" width="50" height="50">
		<label for="inputPassword2" class="sr-only">Thumbnail</label>
		<input type="file" class="form-control form-file-control" id="inputPassword2" name="thumbnail">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Content</label>
		<input type="text" class="form-control" id="inputPassword2" name="content" value="{{$category->content}}" placeholder="Enter Content">
	  </div>
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Name</label>
		<select name="parent_id">
			<option value="0">Select a parent category</option>
			@if(!$categories->isEmpty())
				@foreach($categories as $cat)
					<option @if($cat->id == $category->parent_id){{'selected'}} @endif value="{{$cat->id}}">{{$cat->title}}</option>
				@endforeach
			@endif
		</select>
	  </div>
	  <button type="submit" class="btn btn-primary mb-2">Submit</button>
	</form>
@endsection