@extends('backend.layouts.main')
@section('content')
<h4><b>Customers Detail</b></h4>
<div class="row">
	<div class="col-sm-12">
		<div class="box"> 
			<div class="box-body">  
				<div class="row">
					<div class="col-sm-12">       
					<p align="center">
					<div class="caption">
					<b><p>Customer Code: {{ $customer->customer_code }}</p>
					<p>Customer Name:{{ $customer->customer_name }}</p>
					<p>Address: {{ $customer->address }}</p>
					<p>Phone No: {{$customer->phone_no}}</p>
					<p>Customer Note: {{$customer->customer_note}}</p>
					<p>Status: {{ $customer->status }}</p>
					</b>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>  
@endsection
