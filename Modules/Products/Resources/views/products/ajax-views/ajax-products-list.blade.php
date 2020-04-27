@foreach($product_list->chunk(4) as $product)
  @foreach($product as $p)
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        @if($p->image)
        <img src="{{ URL::to('public/images/product_photos',$p->image)}}" class ="img-responsive">
        @else
        <img src="{{ asset('public/images/product_photos/no-image.png')}}" height="150px">
        @endif
        <div class="caption">
        <h5><b> Code: {{ $p->product_code }} </b> </h3>
        <p>Product Name: {{ $p->product_name }}</p>
        <a href = "{{route('product-view', $p->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-primary btn-flat" type="button" data-original-title="View"> View  <i class="fa fa-fw fa-file"></i></button></a>
        <a href = "{{route('product-edit', $p->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"> Edit <i class="fa fa-fw fa-edit"></i></button></a>
        <a href = "{{route('product-delete', $p->id)}}" onclick="return ConfirmDelete();"><button data-toggle="tooltip" title="" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"> Delete <i class="fa fa-fw fa-trash"></i></button></a>
        </div>
      </div>
    </div>
  @endforeach 
@endforeach 


				
			
    
	