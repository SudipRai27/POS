@extends('backend.layouts.submain')
@section('content')
<div style="background-color:#FABAC2;"> Results from : {{$start}} to {{$end}}</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="purchase-table" name="purchase-table">        
		<thead>
			<tr>
			<th>SN</th>
			<th>Invoice Number</th>
			<th>Supplier</th>
			<th>Invoice Generated At</th>
			<th>Grand Total</th>
			<th>Status</th>
			</tr>
		</thead>
		<tbody>
		
		<?php  $i = 1; ?>
		@if(count($results))
		@foreach($results as $index => $d)
			<tr>
			<td>{{$i++}}</td>
			<td><a href="{{route('view-payment-invoice', $d->invoice_number)}}" data-lity>{{$d->invoice_number}}</a></td>
			<td>{{$d->supplier_name}}</td>
			<td>{{ date('M j Y ', strtotime($d->invoice_generated_date)) }}</td>
			<td>{{$d->grand_total}}</td>
			<td>{{$d->is_paid}}</td>
			</tr>
		@endforeach
		@else
		<p style = "color:red; text-align:center;">No data found</p>
		@endif	
		</tbody>       								
    </table>
</div>

@endsection

