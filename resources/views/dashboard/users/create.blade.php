@extends('dashboard.layout')
@section('content')
	<form class="form-inline" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
		@csrf
	  <div class="col-12">
		<label for="inputPassword2" class="sr-only">User Name</label>
		<input type="text" class="form-control" id="inputPassword2" name="username" placeholder="Enter User Name">
	  </div>
	  <div class="col-12">
		<label for="inputPassword2" class="sr-only">Full Name</label>
		<input type="text" class="form-control form-file-control" id="inputPassword2" name="name" placeholder="Enter Full Name">
	  </div>
	  <div class="col-12">
		<label for="inputPassword2" class="sr-only">Email</label>
		<input type="email" class="form-control" id="inputPassword2" name="email" placeholder="Enter Email">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Password</label>
		<input type="password" class="form-control" id="inputPassword2" name="password" placeholder="Enter Password">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Phone</label>
		<input type="text" class="form-control" id="inputPassword2" name="phone" placeholder="Enter Phone">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Select Country</label>
		<select name="country" class="form-control">
			@if(!$countries->isEmpty())
				@foreach($countries as $country)
					<option value="{{$country->id}}">{{$country->name}}</option>
				@endforeach
			@endif
		</select>
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">City</label>
		<input type="text" class="form-control" id="inputPassword2" name="city" placeholder="Enter City Name">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Select Roles</label>
		<select name="roles[]" class="form-control" multiple>
			@if(!$roles->isEmpty())
				@foreach($roles as $role)
					<option value="{{$role->id}}">{{$role->name}}</option>
				@endforeach
			@endif
		</select>
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Thumbnail</label>
		<input type="file" class="form-control form-file-control" id="inputPassword2" name="photo">
	  </div>
	  <button type="submit" class="btn btn-primary mb-2">Submit</button>
	</form>
@endsection