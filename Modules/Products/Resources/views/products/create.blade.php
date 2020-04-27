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
				<a href="{{route('product-list')}}" type="button" class="btn btn-danger">Go Back</a>
				<h4><b>Add Product</b></h4>
				<form enctype= "multipart/form-data" action="{{route('add-product-post')}}" method="POST" id="productForm"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="product_code">Product Code:</label>
							<input type="text" name="product_code" class="form-control" value="{{ Input::old('product_code')}}">
							<p style="color:red;">Please Enter Product Code Carefully. You cannot edit afterwards</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="product_code">Product Name:</label>
							<input type="text" name="product_name" class="form-control" value="{{ Input::old('product_name')}}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="sales_price">Sales Price:</label>
							<input type="text" name="sales_price" class="form-control" value="{{ Input::old('sales_price')}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="description">Description:</label>
							<textarea name="description" class="form-control" rows="5">{{Input::old('description')}}</textarea>
						</div>
					</div>					
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="	category_id">Category Name:</label>
							<select class="form-control" name="category_id" id="category_id">
							<option value="0">Select</option>	
							@foreach($category as $index => $d)
							<option value="{{$index}}" {{ (Input::old("category_id") == $index ? "selected":"") }}>{{$d}}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="subcategory_id">Sub Category Name:</label>
							<select class="form-control" name="subcategory_id" id="subcategory_id">
							<option value="0">Please Select Category First</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="status">Status:</label>
							<select class="form-control" name="status">			
							<option value="active" {{ (Input::old("status") == "active" ? "selected":"") }}>Active</option>
							<option value="inactive" {{ (Input::old("status") == "inactive" ? "selected":"") }}>Inactive</option>
							</select>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="image">Image:
							<input type="file" name="image" class="form-control">							
							</label>
						</div>
					</div>				
				</div>
				<input type="submit" name="" value="Add" class="btn btn-primary">
				{{ csrf_field()}}
				</form>

			</div>
		</div>
	</div>
</div>

@endsection
@section('custom-js')
<script type="text/javascript">
	$(document).ready(function(){
		updateSubCategoryList();	
	});

	$('#category_id').change(function(){

		updateSubCategoryList();
	});

	function updateSubCategoryList()
	{
		var category_id = $('#category_id').val();
		
		$('#subcategory_id').html('<option>Loading...</option>');
		$.ajax({
			'url': '{{route('ajax-get-subcategory-id-from-category-id')}}', 
			'data': {'category_id': category_id}, 
			'method' : 'GET'
		}).done(function(data){

		$('#subcategory_id').html(data);

		});	
	}
</script>
@endsection