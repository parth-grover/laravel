@extends('dashboard.layout')
@section('content')
	<form class="form-inline" action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PUT')
	  <div class="col-12">
		<label for="inputPassword2" class="sr-only">Full Name</label>
		<input type="text" class="form-control form-file-control" id="inputPassword2" name="name" value="{{$user->name}}" placeholder="Enter Full Name">
	  </div>
	  <div class="col-12">
		<label for="inputPassword2" class="sr-only">Email</label>
		<input type="email" class="form-control" id="inputPassword2" name="email" value="{{$user->email}}" placeholder="Enter Email">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Phone</label>
		<input type="text" class="form-control" id="inputPassword2" name="phone" value="{{$user->profile->phono}}" placeholder="Enter Phone">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Select Country</label>
		<select name="country" class="form-control">
			@if(!$countries->isEmpty())
				@foreach($countries as $country)
					<option @if($country->id == $user->profile->country_id) {{'selected'}} @endif value="{{$country->id}}">{{$country->name}}</option>
				@endforeach
			@endif
		</select>
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">City</label>
		<input type="text" class="form-control" id="inputPassword2" name="city" value="{{$user->profile->city}}" placeholder="Enter City Name">
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Select Roles</label>
		<select name="roles[]" class="form-control" multiple>
			@if(!$roles->isEmpty())
				@foreach($roles as $role)
					<option 
					@if(in_array($role->id,$user->roles->pluck('id')->toArray()))
						{{'selected'}}
					@endif
					value="{{$role->id}}">{{$role->name}}</option>
				@endforeach
			@endif
		</select>
	  </div>
	  <div class="form-group col-12">
		<label for="inputPassword2" class="sr-only">Thumbnail</label>
		<img src="{{asset('storage/'.$user->profile->photo)}}" width="50" height="50">
		<input type="file" class="form-control form-file-control" id="inputPassword2" name="photo">
	  </div>
	  <button type="submit" class="btn btn-primary mb-2">Submit</button>
	</form>
@endsection