@extends('dashboard.layout')
@section('content')
	<form class="form-inline" action="{{route('roles.store')}}" method="post">
		@csrf
	  <div class="form-group mx-sm-3 mb-2">
		<label for="inputPassword2" class="sr-only">Role Name</label>
		<input type="text" class="form-control" id="inputPassword2" name="role_name" placeholder="Enter Role Name">
	  </div>
	  <button type="submit" class="btn btn-primary mb-2">Submit</button>
	</form>
@endsection