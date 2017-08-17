@extends("layouts.admin")

@section("content")

	<h1>Edit User</h1>

	<div class="col-md-3">
		<img src="{{ $user->photo ? $user->photo->file : '/images/image.png' }}" class="img-responsive  img-rounded">
	</div>

	<div class="col-md-9">

		{!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

			<div class="form-group">
				{!! Form::label('name', 'Name') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label("email", "Email") !!}	
				{!! Form::email("email", null, ["class"=>"form-control"]) !!}
			</div>

			<div class="form-group">
				{!! Form::label("role_id", "Role") !!}
				<!--{!! Form::select("role_id", $roles, null, ["class"=>"form-control", "placeholder" => "Assign Role"]) !!}-->
				{!! Form::select("role_id", $roles, null, ["class"=>"form-control"]) !!}
			</div>

			<div class="form-group">
				{!! Form::label("is_active", "Status") !!}
				{!! Form::select("is_active", array(1 => "Active", 0 => "Not Active"), null , ["class"=>"form-control"]) !!}
			</div>

			<div class="form-group">
				{!! Form::label("photo_id", "Upload Selfie") !!}
				{!! Form::file("photo_id", null, ["class" => "form-control"]) !!}
			</div>

			<div class="form-group">
				{!! Form::label("password", "Password") !!}
				{!! Form::password("password", ["class"=>"form-control"]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit("Update User", ["class"=>"btn btn-primary col-sm-6 "]) !!}
			</div>

		{!! Form::close() !!}

		<!--delete form-->
		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

			<div class="form-group"> 
				{!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
			</div>

		{!! Form::close() !!}

	</div>

	<!--Display errors section-->
	@if(count($errors))

	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)

						<li>{{ $error }}</li>

					@endforeach
				</ul>
			</div>
		</div>
	</div>	


	@endif

@endsection