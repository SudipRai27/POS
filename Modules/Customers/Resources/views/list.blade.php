@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Customers</b></h4>
	 <div class="box"> 
	   <div class="box-body">
	   <div class="row">
	   		<div class="col-sm-4">
	   		<a href="{{route('add-customers')}}" type="button" class="btn btn-primary">Add Customers</a><br>
	   		</div>
	   		<div class="col-sm-6">
	   		<input type="text" name="search-bar" id="search-bar" class="form-control" placeholder="Enter Customer Code or Customer Name">
	   		</div>
	   </div>
	   <br>
	      <table id="customer-list" class="table table-bordered table-hover">
	        <thead>
	        <tr>
	          <th>SN</th>
	          <th>Customer Code</th>
	          <th>Customer Name</th>
	          <th>Action</th>
	        </tr>
	        </thead>
	        <tbody>
	        @if(count($customers))
	        <?php
	         $i =1;
	        ?>
	        @foreach($customers as $index => $d)
	        <tr>
	          <td>{{ $i++}}</td>
	          <td>{{ $d->customer_code }}</td>
	          <td>{{ $d->customer_name}}</td>
	          <td>
	          	<a href="{{route('view-customers', $d->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-primary btn-flat" type="button" data-original-title="View"><i class="fa fa-fw fa-file"></i></button></a>
	          	<a href = "{{route('edit-customers', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
				<a class="btn btn-danger btn-flat"  data-toggle="modal" data-target="#confirmDelete{{$d->id}}" data-title="Delete Slider" data-message="Are you sure you want to delete ?">
     			<i class="glyphicon glyphicon-trash"></i></a>
     			@include('customers::modal.modal')
	          </td>
	        </tr>
	        @endforeach
	        @else
	        <div style="color:red; text-align:center">No data found</div>
	        @endif
	        </tbody>
	       </table>
	       {{ $customers->render() }}
	    </div>
	  </div>
  </div>
</div>  
@endsection
@section('custom-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
<script type="text/javascript">
 
    $('#search-bar').on('keyup',function(){
     
      var search_term = $('#search-bar').val();
      var table_to_search = 'customers';
      $('#customer-list').html('<p align="center"><img src = "{{ asset('public/images/giphy.gif')}}"></p>');
          $.ajax({
           
          type : 'get',
           
          url : '{{URL::route('ajax-get-table-search')}}',
           
          data:{'search_term':search_term, 
      			'table_to_search': table_to_search
      			},
           
          success:function(data){
           
          $('#customer-list').html(data);
           
          }
           
        });
 
    
    });
 
</script>
@stop