@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Stock</b></h4>	
		<div class="box"> 
			<div class="box-body">
								
				<div class="panel panel-warning">
					<div class="panel-title"><br>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Stock</b><br>
						<div class="row">
						 	<div class="col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{route('excel-report-stock')}}" type="button" class="btn btn-success">Generate Excel </a><br>
						 	</div>
						 	<div class="col-sm-8">
						 		<input type="text" name="search-bar" id="search-bar" class="form-control" placeholder="Enter Product Code">
						 	</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
					        <table class="table table-bordered table-hover" id="stock-list">        
								<thead>
									<tr>
									<th>SN</th>
									<th>Product Code</th>
									<th>Product Name</th>
									<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
								<?php  $i =1; ?>
								@foreach($stock as $index => $d)
									<tr>
									<td>{{$i++}}</td>
									<td>{{$d->product_code}}</td>
									<td>{{Modules\Products\Entities\Products::where('product_code', $d->product_code)->pluck('product_name')[0]}}</td>
									<td>{{$d->quantity}}</td>
									</tr>
								@endforeach
								</tbody>       								
					        </table>
        				</div>
        				{{$stock->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript">
 
    $('#search-bar').on('keyup',function(){
     
      var search_term = $('#search-bar').val();
      var table_to_search = 'stock';
      $('#stock-list').html('<p align="center"><img src = "{{ asset('public/images/giphy.gif')}}"></p>');
          $.ajax({
           
          type : 'get',
           
          url : '{{URL::route('ajax-get-table-search')}}',
           
          data:{'search_term':search_term, 
      			'table_to_search': table_to_search
      			},
           
          success:function(data){
           
          $('#stock-list').html(data);
           
          }
           
        });
 
    
    });
 
</script>
@endsection