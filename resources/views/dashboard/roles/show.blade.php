@extends('dashboard.layout')
@section('content')
	@if($role)
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
					<tr>
						<td>{{$role->id}}</td>
						<td>{{$role->name}}</td>
						<td>{{$role->created_at}}</td>
						<td>{{$role->updated_at}}</td>
						<td>
							<a href="{{route('roles.destroy',$role->id)}}">Delete</a> |
							<a href="{{route('roles.edit',$role->id)}}">Edit</a>
						</td>
					</tr>	
				</tbody>
			</table>
		</div>
	@else
		<p class="alert alert-info">No Record Found...</p>
	@endif
@endsection