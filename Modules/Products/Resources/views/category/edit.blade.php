@extends('backend.layouts.main')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box"> 
			<div class="box-body">
				<a href="{{route('category-list')}}" type="button" class="btn btn-danger">Go Back</a>
				<h4><b>Edit Category</b></h4>
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
				<form action="{{route('edit-category-post', $category->id)}}" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
						<b>Category Name:</b> <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}" placeholder="Category Name">
						<br>
						<div class="form-group">
						<b>Description:</b> <textarea type="text" name="description" class="form-control" placeholder="Description" rows="6">{{ $category->description}}</textarea>
						<br>
						<input type="submit" value="Edit" class="btn btn-success">
					</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection