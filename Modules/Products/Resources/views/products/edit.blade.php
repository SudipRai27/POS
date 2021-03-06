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
				<h4><b>Edit Product</b></h4>
				<form enctype= "multipart/form-data" action="{{route('product-edit-post', $product->id)}}" method="POST" id="productForm"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="product_code">Product Code:</label>
							<input type="text" name="product_code" class="form-control" value="{{ $product->product_code}}" readonly="">
							
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="product_code">Product Name:</label>
							<input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="sales_price">Sales Price:</label>
							<input type="text" name="sales_price" class="form-control" value="{{ $product->sales_price}}">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="description">Description:</label>
							<textarea name="description" class="form-control" rows="5">{{$product->description}}</textarea>
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
							<option value="{{$d->id}}" @if($product->category_id == $d->id) selected @endif>{{$d->category_name}}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="subcategory_id">Sub Category Name:</label>
							<select class="form-control" name="subcategory_id" id="subcategory_id">
							<option value="0">Please Select Category First</option>
							@foreach($subcategory as $index => $d)
							<option value="{{$d->id}}" @if($product->subcategory_id == $d->id) selected @endif>{{$d->subcategory_name}}</option>
							@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="status">Status:</label>
							<select class="form-control" name="status">			
							<option value="active" @if($product->status == "active") selected @endif>Active</option>
							<option value="inactive" @if($product->status == "inactive") selected @endif>Inactive</option>
							</select>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<label for="image">Image:
							<input type="file" name="image" class="form-control">
							</label>
							@if($product->image)
							<br>
							Current Photo:<br>
							<img src="{{URL::to('images/product_photos/'.$product->image)}}">
							@endif
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
@section('custom-js')
<script type="text/javascript">
	

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