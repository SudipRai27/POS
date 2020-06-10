@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.css">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     My Dashboard
    </h1>
  </section>
<?php
$product_count = DB::table('products')->count();
$category_count = DB::table('product_category')->count();
$subcategory_count = DB::table('product_subcategory')->count();
$supplier_count = DB::table('suppliers')->count();
$user_count = DB::table('users')->count();
$helpercontroller = new App\Http\Controllers\HelperController;
$top_ten_sales = $helpercontroller->getTopTenSales();
$best_seller = $helpercontroller->getBestSellingProduct();
$total_dues = $helpercontroller->getTotalPurchaseDues();
$todays_sales = $helpercontroller->getTodaysSales();
$todays_purchase = $helpercontroller->getTodaysPurchase()
?>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$product_count}}</h3>
            <p>Products</p>
          </div>
          <div class="icon">
            <i class="fa fa-product-hunt"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$category_count}}</h3>
            <p>Category</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-alt"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$subcategory_count}}</h3>
            <p>Sub Category</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-ol"></i>
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$supplier_count}}</h3>
            <p>Suppliers</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-secret"></i>
          </div>
        </div>
      </div><!-- ./col -->
    </div><!-- /.row -->
    <hr size="2" style="border-color:#3c8dbc;">
    <div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3>{{$user_count}}</h3>
            <p>Users</p>
          </div>
          <div class="icon">
           <i class="fa fa-users"></i>  
          </div>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{$total_dues}}</h3>
            <p>Total Dues</p>
          </div>
          <div class="icon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$todays_sales}}</h3>
            <p>Items Sold Today</p>
          </div>
          <div class="icon">
            <i class="fa fa-scribd" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$todays_purchase}}</h3>
            <p>Items Purchased Today</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

    </div>
    <div class="row">
      <section class="col-lg-6">              
        <div class="box box-primary"><!-- box upcoming events starts -->
          <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Top 10 Product Sales </h3>
          </div>
          
          <div class="box-body">
              <ul class="todo-list">
                <li>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="purchase-table" name="purchase-table">        
                <thead>
                  <tr>
                  <th>SN</th>
                  
                  <th>Product Name</th>
                  <th>Quantities Sold</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1;
                ?>
                @foreach($top_ten_sales as $product => $quantity)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$product}}</td>
                    
                    <td>{{$quantity}}</td>
                  </tr>
                @endforeach
                </tbody>                      
                  </table>
                </div>               

                </li>
              </ul>
          </div>        
         </div><!-- box upcoming events ends -->      
      </section>
      <section class="col-lg-6 connectedSortable ui-sortable">
        
         <!-- quick email widget -->

        <div class="box box-info">
          <div class="box-header">
            <i class="fa fa-envelope"></i>
            <h3 class="box-title">Best Selling Product</h3>
            <!-- tools box -->
            
          </div>
          <div class="box-body">
              
              <?php   
              if(count($best_seller))
              {
                $product = DB::table('products')->where('product_code', $best_seller[0])
                                                   ->first();
              }
              ?>
              @if(count($best_seller))
             <b> Product Name : {{$product->product_name}}</b><br><br>
             <p align="center">
             @if($product->image)
             <img src="{{URL::to('public/images/product_photos', $product->image)}}">
             <br><br>
             @endif
              <a href = "{{route('product-view', $product->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-primary btn-flat" type="button" data-original-title="View"> View  <i class="fa fa-fw fa-file"></i></button></a></p>
              @else
              No Product available right now
              @endif
          </div>
         
        </div>
        <!-- quick email ends -->
        <!-- modal starts -->       
        <!-- modal ends -->
      </section>
    </div><!-- row ends -->

  </section><!-- /.content -->
@endsection
@section('custom-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
@endsection       

