@extends('backend.layouts.main')
@section('content')
@include('products::tabs')
<div class="row">
	<div class="col-xs-12">
		<div class="box"> 
			<div class="box-body">
				<a href="{{route('add-category')}}" type="button" class="btn btn-primary">Add Category</a>
					<table class="table table-sm table-hover">
						<thead>
						<tr>
							<th scope="col">SN</th>
							<th scope="col">Category Name</th>
							<th scope="col">Description</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody>
						@if(count($category))
						<?php
						$i = 1;
						?>
						@foreach($category as $cat)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$cat->category_name}}</td>
							<td>@if(!$cat->description) No Description Entered @endif{{$cat->description}}</td>
							<td>
							<a href ="{{ route('edit-category', $cat->id) }}"><button data-toggle="tooltip" title="" class="btn btn-success btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
							<a class="btn btn-danger btn-flat"  data-toggle="modal" data-target="#confirmDelete{{$cat->id}}" data-title="Delete Slider" data-message="Are you sure you want to delete ?">
							<i class="glyphicon glyphicon-trash"></i></a></td>
							@include('products::category.modal.modal')
							</tr>
						@endforeach
						@else
						<div style="color:red; text-align:center">No data found</div>
						@endif
						</tbody>
					</table>
				{{ $category->render() }}
			</div>
		</div>
	</div>
</div>  

@endsection