@extends('backend.layouts.main')
@section('content')
@include('products::tabs')
<div class="row">
	<div class="col-xs-12">
	 <div class="box"> 
	   <div class="box-body">
	   <a href="{{route('add-sub-category')}}" type="button" class="btn btn-primary">Add Sub Category</a>
	      <table id="example2" class="table table-bordered table-hover">
	        <thead>
	        <tr>
	          <th>SN</th>
	          <th>Sub Category Name</th>
	          <th>Category</th>
	          <th>Action</th>       
	        </tr>
	        </thead>
	        <tbody>
	        @if(count($subcategory))
	        <?php
	         $i =1;
	        ?>
	        @foreach($subcategory as $index => $d)
	        <tr>
	          <td>{{ $i++}}</td>
	          <td>{{ $d->subcategory_name }}</td>
	          <td>{{Modules\Products\Entities\Category::where('id', $d->category_id)->pluck('category_name')[0]}}</td>
	          <td>
	          	<a href = "{{route('edit-sub-category', $d->id)}}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
				<a class="btn btn-danger btn-flat"  data-toggle="modal" data-target="#confirmDelete{{$d->id}}" data-title="Delete Slider" data-message="Are you sure you want to delete ?">
     			<i class="glyphicon glyphicon-trash"></i></a>
     			@include('products::.sub-category.modal.modal')
	          </td>
	        </tr>
	        @endforeach
	        @else
	        <div style="color:red; text-align:center">No data found</div>
	        @endif
	        </tbody>
	       </table>
	       {{ $subcategory->render() }}
	    </div>
	  </div>
  </div>
</div>  

@endsection