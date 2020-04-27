@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.css">
@endsection
@section('content')
@include('products::tabs')
<div class="row">
  <div class="col-xs-12">
    <div class="box"> 
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3"><a href="{{route('add-product')}}" type="button" class="btn btn-primary">Add Products</a>
                                <a href="{{route('excel-report-products')}}" type="button" class="btn btn-info">Generate Excel </a><br><br>
          </div>
              <div class="col-sm-3 select-bar">
                <select name="category_id" id="category_id" class="form-control">
                  <option >Select</option>
                  @foreach($category as $index => $d)
                  <option value="{{$index}}">{{$d}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-3 select-bar">
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                  <option >Please Select Category First</option>
                </select>
              </div>
              <div class="col-sm-6 input-search">
                <input type="text" name="search_term" class="form-control" id="search_term" placeholder="Please enter Product ID or Product Name">
                <div style="color:red;">Enter product name or product code</div>
              </div>
              <button class="btn btn-danger" onclick ='switchselectbarandinputsearch()' id="switch_button">Switch Search Type</button>
          </div><br>
        <div id="products-list">
        @foreach($products->chunk(4) as $product)
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
        </div> 
      </div>
    </div>
    {{$products->render()}}
  </div>
</div>  
@endsection
@section('custom-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
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
<script type="text/javascript">
$(document).ready(function(){
    $('#category_id').change(function(){
        updateSubCategoryList();
    });

    $('#subcategory_id').change(function(){
        updateProductsList();
    });
});
    function updateSubCategoryList()
    {
        var category_id = $('#category_id').val();
        $('#subcategory_id').html('<option>Loading...</option>');
        $.ajax({
              'url' : '{{route('ajax-get-subcategory-id-from-category-id')}}',
              'data' : {'category_id': category_id}, 
              'method': 'GET'
            }).done(function(data){
              $('#subcategory_id').html(data);
            });
        
    }

    function updateProductsList()
    {
        var category_id = $('#category_id').val();
        var subcategory_id = $('#subcategory_id').val();
        $('#products-list').html('<p align="center"><img src = "{{ asset('public/images/giphy.gif')}}"></p>');
        $.ajax({
              'url' : '{{route('ajax-get-products-list-from-category-id-and-sub-category-id')}}', 
              'data': {
                        'category_id' : category_id, 
                        'subcategory_id' : subcategory_id
                      }, 
              'method': 'GET'
            }).done(function(data){
            $('#products-list').html(data);
            }); 
    }

</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.select-bar').show();
    $('.input-search').hide();
  });
    
    function switchselectbarandinputsearch()
    {
      if($('.select-bar').is(':visible'))
      {
          $('.select-bar').hide();
          $('.input-search').show();
      }
      else
      {
          $('.select-bar').show();
          $('.input-search').hide();
      }
     
    }
</script>
<script type="text/javascript">
 
    $('#search_term').on('keyup',function(){
     
      var search_term = $('#search_term').val();
      var table_to_search = 'products';
      $('#products-list').html('<p align="center"><img src = "{{ asset('public/images/giphy.gif')}}"></p>');
          $.ajax({
           
          type : 'get',
           
          url : '{{URL::route('ajax-get-table-search')}}',
           
          data:{'search_term':search_term , 'table_to_search': table_to_search},
           
          success:function(data){
           
          $('#products-list').html(data);
           
          }
           
        });
 
    
    });
 
</script>
@endsection