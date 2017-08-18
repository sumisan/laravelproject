

@extends('layouts.admin')


@section('content')

	<h1>Edit Post</h1>

	<!--Show errors if there is any that exists-->
	@if(count($errors))
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li> {{ $error }} </li>
				@endforeach
			</ul>				
		</div>
	@endif

	<div class="col-md-3">
		<img src="{{ $post->photo->file}}" height="70" class="img-responsive img-circle" >
	</div>

	<div class="col-sm-9">

		{!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true] ) !!}

			<div class="form-group">
				{!! Form::label('photo_id', 'Upload Photo') !!}
				{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('title', 'Title') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('category_id', 'Category') !!}
				{!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
			</div>		

			<div class="form-group">
				{!! Form::label('body', 'Write Post') !!}
				{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
			</div>	

		{!! Form::close() !!}

		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
			<div class="form-group">
				{!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
			</div>
		{!! Form::close() !!}

	</div>

@endsection	
