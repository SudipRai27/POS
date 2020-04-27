@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Users</b></h4>	
		<a href="{{route('generate-user-excel')}}" class="btn btn-primary">Generate Excel</a><br><br>
		<div class="box"> 
			<div class="box-body">				
				<div class="table-responsive">
			        <table class="table table-bordered table-hover" id="purchase-table" name="purchase-table">        
						<thead>
							<tr>
							<th>SN</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Role</th>
							<th>Contact</th>
							<th>Photo</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php  $i =1; ?>
						@foreach($user as $index => $d)
							<tr>
							<td>{{$i++}}</td>
							<td>{{$d->name}}</td>
							<td>{{$d->email}}</td>
							<td>{{$d->address}}</td>
							<td>{{$d->role_name}}</td>
							<td>{{$d->contact}}</td>
							<td>
								@if($d->photo)
								<img src="{{URL::to('public/images/user_photos/', $d->photo)}}" height="50px" width="60px">
								@else
								No photo
								@endif
							</td>	
							<td>
								<a href = "{{route('user-edit', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"> <i class="fa fa-fw fa-edit"></i></button></a>
		                        <a href = "{{route('user-delete', $d->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> <i class="fa fa-fw fa-trash"></i></button></a>
							</td>
							</tr>
						@endforeach
						</tbody>       								
			        </table>
				</div>
				{{$user->render()}}					
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
          return false;
    }
</script>  
@endsection
