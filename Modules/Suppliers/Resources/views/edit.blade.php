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
				<a href="{{route('supplier-list')}}" type="button" class="btn btn-danger">Go Back</a>
				<h4><b>Edit Suppliers</b></h4>
				<form enctype= "multipart/form-data" action="{{route('supplier-edit-post', $supplier->id)}}" method="POST" id="productForm"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="supplier_code">Supplier Code:</label>
							<input type="text" name="supplier_code" class="form-control" value="{{ $supplier->supplier_code}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="supplier_name">Supplier Name:</label>
							<input type="text" name="supplier_name" class="form-control" value="{{ $supplier->supplier_name}}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="address">Address </label>
							<input type="text" name="address" class="form-control" value="{{ $supplier->address}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="contact_person">Contact Person:</label>
							<input type="text" name="contact_person" class="form-control" value="{{ $supplier->contact_person}}">
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="phone_no">Phone Number:</label>
							<input type="text" name="phone_no" class="form-control" value="{{ $supplier->phone_no}}">
						</div>
					</div>					
					<div class="col-sm-7">
						<div class="form-group">
							<label for="status">Status:</label>
							<select class="form-control" name="status">			
							<option value="active" @if($supplier->status == "active") selected @endif>Active</option>
							<option value="inactive" @if($supplier->status == "inactive") selected @endif">Inactive</option>
							</select>
						</div>
					</div>						
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="phone_no">Note:</label>
							<textarea rows="5" class="form-control" name="supplier_note">{{ $supplier->supplier_note}}</textarea>
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
