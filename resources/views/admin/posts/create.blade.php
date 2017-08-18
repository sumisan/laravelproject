

@extends('layouts.admin')


@section('content')

	<h1>Create Post</h1>

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

	{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true] ) !!}

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
			{!! Form::select('category_id', array(''=>'Select Category', 0 => 'Javascript', 1 => 'PHP'), null, ['class'=>'form-control']) !!}
		</div>		

		<div class="form-group">
			{!! Form::label('body', 'Write Post') !!}
			{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Publish Post', ['class'=>'btn btn-primary']) !!}
		</div>	

	{!! Form::close() !!}

@endsection