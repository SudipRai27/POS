@extends('backend.layouts.submain')
@section('content')
<h4><b>Supplier Detail</b></h4>
<div class="row">
	<div class="col-sm-12">
		<div class="box"> 
			<div class="box-body">  
				<div class="row">
					<div class="col-sm-12">       
					<p align="center">
					<div class="caption">
					<b><p>Supplier Code: {{ $supplier->supplier_code }}</p>
					<p>Supplier Name:{{ $supplier->supplier_name }}</p>
					<p>Address: {{ $supplier->address }}</p>
					<p>Contact Person: {{ $supplier->contact_person }}</p>
					<p>Phone No: {{$supplier->phone_no}}</p>
					<p>Supplier Note: {{$supplier->supplier_note}}</p>
					<p>Status: {{ $supplier->status }}</p>
					</b>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>  
@endsection
