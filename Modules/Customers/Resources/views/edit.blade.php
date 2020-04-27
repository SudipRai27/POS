@extends('backend.layouts.main')
@section('content')
@if ($errors->any())
<div class = "alert alert-danger alert-dissmissable">
<button type = "button" class = "close" data-dismiss = "alert">X</button>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
	<div class="col-xs-12">
		<div class="box"> 
			<div class="box-body">
				<a href="{{route('customer-list')}}" type="button" class="btn btn-danger">Go Back</a>
				<h4><b>Edit Customers</b></h4>
				<form enctype= "multipart/form-data" action="{{route('customer-edit-post', $customer->id)}}" method="POST" id="productForm"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="customer_code">Customer Code:</label>
							<input type="text" name="customer_code" class="form-control" value="{{ $customer->customer_code}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="customer_name">Customer Name:</label>
							<input type="text" name="customer_name" class="form-control" value="{{ $customer->customer_name }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="address">Address </label>
							<input type="text" name="address" class="form-control" value="{{ $customer->address}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="phone_no">Phone No:</label>
							<input type="text" name="phone_no" class="form-control" value="{{ $customer->phone_no}}">
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="customer_note">Note:</label>
							<textarea rows="5" class="form-control" name="customer_note">{{$customer->customer_note}}</textarea>
						</div>
					</div>					
					<div class="col-sm-7">
						<div class="form-group">
							<label for="status">Status:</label>
							<select class="form-control" name="status">			
							<option value="active" @if($customer->status == "active") selected @endif>Active</option>
							<option value="inactive" @if($customer->status == "inactive") selected @endif>Inactive</option>
							</select>
						</div>
					</div>						
				</div>
				<input type="submit" name="" value="Edit" class="btn btn-primary">
				{{ csrf_field()}}
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
