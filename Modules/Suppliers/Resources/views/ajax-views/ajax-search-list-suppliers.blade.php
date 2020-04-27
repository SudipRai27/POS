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