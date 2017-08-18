
@extends('layouts.admin')

@section('content')

	<h1>Posts</h1>

	<!--check if deleted_post session exists-->
	@if(Session::has('deleted_post'))
		<div class="alert alert-success">
			{{session('deleted_post')}}
		</div>
	@endif

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>Author</th>
				<th>Category</th>
				<th>Title</th>
				<th>Content</th>		
				<th>Create</th>		
				<th>Updated</th>
			</tr>
		</thead>

		<tbody>

		<!--check to see if $posts has more than value-->
		<!--check to find out if the $posts variable exist-->
			@if($posts)
				<!--loop through passed values-->
				@foreach($posts as $post)

					<tr>
						<td>{{$post->id}}</td>
						<td><img height="50" src="{{$post->photo ? $post->photo->file : '/images/image.png'}}"></td>
						<td><a href="{{ route('posts.edit', $post->id) }}">{{$post->user->name}}</a></td>
						<td>{{$post->category ? $post->category->name : 'Uncategorised'}}</td>
						<td>{{$post->title}}</td>
						<td>{{str_limit($post->body, 9, '...')}}</td>
						<td>{{$post->created_at->diffForhumans()}}</td>
						<td>{{$post->updated_at->diffForhumans()}}</td>
					</tr>

				@endforeach
			@endif

		</tbody>

	</table>

@stop