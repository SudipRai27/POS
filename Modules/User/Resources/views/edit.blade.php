@extends('backend.layouts.main')
	
@section('content')
<h4><b>Edit User </b></h4>
<form action="{{route('user-edit-post', $user->id)}}" method="POST" enctype="multipart/form-data">
 <div class="box-body">
   <div class="form-group">
	Name: <input type="text" name="name" class="form-control" value="{{$user->name}}">
	<div id="msg" style="color:red;">{{ $errors->first('name') }}</div>
   </div>
   <div class="form-group">
	Email: <input type="email" name="email" class="form-control" value="{{$user->email}}">
	<div id="msg" style="color:red;">{{ $errors->first('email') }}</div>
   </div>
   <div class="form-group">	
	Address: <input type="text" name="address" class="form-control" value="{{$user->address}}">
	<div id="msg" style="color:red;">{{ $errors->first('address') }}</div>
   </div>
   <div class="form-group">
	Contact: <input type="text" name="contact" class="form-control" value="{{$user->contact}}">
	<div id="msg" style="color:red;">{{ $errors->first('contact') }}</div>
   </div>
   <div class="form-group">
     Role: <select class="form-control" name="role_id">
      @foreach($roles as $index => $d)
      <option value="{{$d->id}}" @if($d->id == $current_user_role_id) selected @endif>{{$d->role_name}}</option>
      @endforeach
     </select>
     </div>
  @if($user->photo)
   Current Photo:<br><img src="{{URL::to('public/images/user_photos', $user->photo)}}" width="60px" height="50px"> 
   <br><br>
  @endif

	<input type="file" name="photo" class="form-control">
	<div id="msg" style="color:red;">{{ $errors->first('photo') }}</div>	
   <div class="box-footer">
	<input type="submit" name="Submit" value="Update" class="btn btn-primary">
   </div>
	{{ csrf_field() }}
</form>
@stop
