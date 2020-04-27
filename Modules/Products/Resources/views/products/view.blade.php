@extends('backend.layouts.submain')
@section('content')

<section class="content">
<div class="box">
<div class="box-body">
<h4><b>Product Detail</b></h4>
<div class="row">
	<div class="col-sm-12">
		<div class="box"> 
			<div class="box-body">  
				<div class="row">
					<div class="col-sm-12">       
					<p align="center">
					@if($product->image)
                      <img  src="{{ URL::to('public/images/product_photos',$product->image)}}" class ="img-responsive">
                    @else
                       <img src="{{ asset('public/images/product_photos/no-image.png')}}" height="150px">
                    @endif</p>
					<div class="caption">
					<b> <p>Code: {{ $product->product_code }}</p>
					<p>Product Name:{{ $product->product_name }}</p>
					<p>Description: {{ $product->description }}</p>
					<p>Sales Price: {{ $product->sales_price }}</p>
					<p>Category: {{ Modules\Products\Entities\Category::where('id', $product->category_id)->pluck('category_name')[0]}}</p>
					<p>Sub Category: {{ Modules\Products\Entities\SubCategory::where('id', $product->subcategory_id)->pluck('subcategory_name')[0]}}</p>
					<p>Status: {{ $product->status }}</p>
					</b>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>  
</div>
</div>
</section>
@endsection
