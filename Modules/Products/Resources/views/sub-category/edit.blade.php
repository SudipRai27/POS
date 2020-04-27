@extends('backend.layouts.main')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box"> 
			<div class="box-body">
				<a href="{{route('sub-category-list')}}" type="button" class="btn btn-danger">Go Back</a>
				<h4><b>Edit Sub Category</b></h4>
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
				<form action="{{route('edit-sub-category-post', $subcategory->id)}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
						<b>Sub Category Name:</b> <input type="text" name="subcategory_name" class="form-control" value="{{$subcategory->subcategory_name}}" placeholder="Category Name">
						<br>
						<div class="form-group">
						<b>Category Name:</b> <select class="form-control" name="category_id">
							<option value="">Select</option>
							@foreach($category as $index => $d)
							<option value="{{$index}}" @if($index == $subcategory->category_id) selected @endif>{{$d}}</option>
							@endforeach
						</select>
						</div>
						
						<input type="submit" value="Edit" class="btn btn-success">
					</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection