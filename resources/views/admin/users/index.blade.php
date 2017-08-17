@extends('layouts.admin')

@section('content')
	
	<h1>Welcome User!</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>First Name</th>				
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>                                                                                                                                                                                          
		</thead>

		<tbody>

		<!--check if $users variable has been passed with values before proceeding-->
			@if($users)
				<!--loop through data that has been passed-->
				@foreach($users as $user)

					<tr>
						<td> {{$user->id}} </td>
						<td> <img src="{{ $user->photo ? $user->photo->file : '/images/image.png'}}" height="70"> </td>
						<td> <a href="{{ route('users.edit', $user->id) }}"> {{$user->name}} </a> </td>
						<td> {{$user->email}} </td>
						<td> {{$user->role->name}} </td>
						<td> {{$user->is_active == 1 ? 'Active' : 'Not Active'}} </td>
						<td> {{$user->created_at->diffForHumans()}} </td>
						<td> {{$user->updated_at->diffForHumans()}} </td>
					</tr>

				@endforeach
			@endif				

		</tbody>

	</table>

@stop