@extends('backend.layouts.submain')
@section('content')
<div style="background-color:#FABAC2;"> Results from : {{$start}} to {{$end}}
</div><br>

<div class="table-responsive">
    <table class="table table-bordered table-hover" id="purchase-table" name="purchase-table">        
		<thead>
			<tr>
			<th>SN</th>
			<th>Invoice Number</th>
			<th>Invoice Generated At</th>
			<th>Sub Total</th>
			<th>VAT</th>
			<th>Total</th>
			<th>Paid Amount</th>
			<th>Return Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php  $i = 1; ?>
		@if(count($results))
		@foreach($results as $index => $d)
			<tr>
			<td>{{$i++}}</td>
			<td><a href="{{route('view-sales-invoice', $d->invoice_number)}}" data-lity>{{$d->invoice_number}}</a></td>
			<td>{{$d->invoice_generated_date}}</td>
			<td>{{$d->grand_total}}</td>
			<td>{{$d->vat_percent}}</td>
			<td>{{$d->grand_total_with_vat}}</td>
			<td>{{$d->paid_amount}}</td>
			<td>{{$d->return_amount}}</td>
			</tr>
		@endforeach
		@else
			<p style = "color:red; text-align:center;">No data found</p>
		@endif
		</tbody>       								
    </table>
</div>

@endsection

