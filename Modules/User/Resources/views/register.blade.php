@extends('backend.layouts.main')
	
@section('content')
<h4><b>Create Users </b></h4>
<form action="{{ route('user-create-post') }}" method="POST" enctype="multipart/form-data">
 <div class="box-body">
	   <div class="form-group">
		Name: <input type="text" name="name" class="form-control" value="{{Input::old('name')}}">
		<div id="msg" style="color:red;">{{ $errors->first('name') }}</div>
	   </div>
	   <div class="form-group">
		Email: <input type="email" name="email" class="form-control" value="{{Input::old('email')}}">
		<div id="msg" style="color:red;">{{ $errors->first('email') }}</div>
	   </div>
	   <div class="form-group">
		Password:
		<input type="password" name="password" class="form-control" >
		<div id="msg" style="color:red;">{{ $errors->first('password') }}</div>
	   </div>
	   <div class="form-group">	
		Address: <input type="text" name="address" class="form-control" value="{{Input::old('address')}}">
		<div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
	   </div>
	   <div class="form-group">
		Contact: <input type="text" name="contact" class="form-control" value="{{Input::old('contact')}}"> 
		<div id="msg" style="color:red;">{{ $errors->first('contact') }}</div>
	   </div>
	   <div class="form-group">
	   Role: <select class="form-control" name="role_id">
	   	@foreach($roles as $index => $d)
	   	<option value="{{$index}}">{{$d}}</option>
	   	@endforeach
	   </select>
	   </div>
  </div>
	<input type="file" name="photo" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('photo') }}</div>	
   <div class="box-footer">
	<input type="submit" name="Submit" value="Create" class="btn btn-primary">
   </div>
	{{ csrf_field() }}
</form>
@stop
