@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>Suppliers</b></h4>
	 <div class="box"> 
	   <div class="box-body">
	   <div class="row">
	   		<div class="col-sm-4">
	   		<a href="{{route('add-suppliers')}}" type="button" class="btn btn-primary">Add Suppliers</a>
	   		<a href="{{route('suppliers-report-excel')}}" type="button" class="btn btn-warning">Generate Excel</a><br>
	   		</div>
	   		<div class="col-sm-6">
	   		<input type="text" name="search-bar" id="search-bar" class="form-control" placeholder="Enter Supplier Code or Supplier Name">
	   		</div>
	   </div>
	   <br>
	      <table id="supplier-list" class="table table-bordered table-hover">
	        <thead>
	        <tr>
	          <th>SN</th>
	          <th>Supplier Code</th>
	          <th>Supplier Name</th>
	          <th>Action</th>
	        </tr>
	        </thead>
	        <tbody>
	        @if(count($suppliers))
	        <?php
	         $i =1;
	        ?>
	        @foreach($suppliers as $index => $d)
	        <tr>
	          <td>{{ $i++}}</td>
	          <td>{{ $d->supplier_code }}</td>
	          <td>{{ $d->supplier_name}}</td>
	          <td>
	          	<a href="{{route('view-suppliers', $d->id)}}" data-lity><button data-toggle="tooltip" title="" class="btn btn-primary btn-flat" type="button" data-original-title="View"><i class="fa fa-fw fa-file"></i></button></a>
	          	<a href = "{{route('edit-supplier', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
				<a class="btn btn-danger btn-flat"  data-toggle="modal" data-target="#confirmDelete{{$d->id}}" data-title="Delete Slider" data-message="Are you sure you want to delete ?">
     			<i class="glyphicon glyphicon-trash"></i></a>
     			@include('suppliers::modal.modal')
	          </td>
	        </tr>
	        @endforeach
	        @else
	        <div style="color:red; text-align:center">No data found</div>
	        @endif
	        </tbody>
	       </table>
	       {{ $suppliers->render() }}
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
      var table_to_search = 'suppliers';
      $('#supplier-list').html('<p align="center"><img src = "{{ asset('public/images/giphy.gif')}}"></p>');
          $.ajax({
           
          type : 'get',
           
          url : '{{URL::route('ajax-get-table-search')}}',
           
          data:{'search_term':search_term, 
      			'table_to_search': table_to_search
      			},
           
          success:function(data){
           
          $('#supplier-list').html(data);
           
          }
           
        });
 
    
    });
 
</script>
@stop