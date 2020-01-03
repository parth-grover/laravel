@extends('dashboard.layout')
@section('content')
	@if($categories)
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
					<tr>
						<td>{{$categories->id}}</td>
						<td>{{$categories->title}}</td>
						<td>{{$categories->content}}</td>
						<td><img src="{{asset('storage/'.$categories->thumbanil)}}" width="50" height="50"></td>
						<td>
							@if($categories['childrens']->isEmpty())
								{{'parent Category'}}
							@else
								@foreach($categories["childrens"] as $children)
									{{$children->title}}
								@endforeach
							@endif
						</td>
						<td>
							<form method="post" action="{{route('categories.destroy',$categories->id)}}">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-link">Delete</button>
							</form> |
							<a href="{{route('categories.edit',$categories->id)}}">Edit</a>
						</td>
					 </tr>	
					</tr>	
				</tbody>
			</table>
		</div>
	@else
		<p class="alert alert-info">No Record Found...</p>
	@endif
@endsection