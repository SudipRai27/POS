@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
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
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;Make Payment </b></h4>
		<div class="box"> 
			<div class="box-body">		
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-warning">
							<div class="panel-title"><br>
								<div class="row">
									<div class="col-sm-5"> 
									<b>&nbsp;&nbsp;&nbsp;&nbsp;Invoice Number : {{$invoice->invoice_number}}</b>
									</div>
									<div class="col-sm-7">
									<b>&nbsp;&nbsp;&nbsp;&nbsp;Generated Date : {{ date('M j Y ', strtotime($invoice->invoice_generated_date)) }}</b>
									</div>
								</div>
							</div>
							<div class="panel-body">
							<div class="table-responsive">
								<b>Purchase Details</b>
								<table class="table table-bordered table-hover">        
								<thead>
									<tr>
									<th>SN</th>
									<th>Product Code</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Total Price</th>
									
									</tr>
								</thead>
								<tbody>
								<?php
								$i = 1;
								?>
								@foreach($purchase_details as $index => $d)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$d->product_code}}</td>
									<td>{{$d->quantity}}</td>
									<td>{{$d->price}}</td>
									<td>{{$d->total_price}}</td>
								</tr>
								@endforeach
								</tbody>       								
								</table>
							</div>
							<p style="color:red;">Grand Total</p>
							<input type ="text" name = "grand_total" id ="grand_total" class="form-control" readonly value="{{$invoice->grand_total}}">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-success">
							<div class="panel-title"><br>
								<b>&nbsp;&nbsp;&nbsp;&nbsp;Payables </b>
							</div>
							<div class="panel-body">
								<form method="POST" action="{{route('create-payment-post', $invoice->invoice_number)}}" id="payment-form">
									<div class="form-group">
										<label for="amount">Enter amount to pay:</label>
										<input type="text" name="amount" id = "amount" class="form-control" placeholder="Amount">
									</div>
									<input type="hidden" name="grand_total" value="{{$invoice->grand_total}}">
									<input type="submit" name="calculate" id = "calculate" value="Calculate" class="btn btn-success">
									<input type="submit" name="confirm-payment" id="confirm-payment" value="Pay" class="btn btn-warning">
									{{csrf_field()}}
								</form>
							</div>
							<div class="container" id="calculated-amount"></div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#calculate').on('click', function(e){
			e.preventDefault();
			if($('#amount').val() == '')
			{
				alert('Please Enter amount');
				$('#amount').css({'border-color':'red'});
				return false;
			}
			else
			{
				$('#amount').css({'border-color':'green'});
			}

			var amount = $('#amount').val();
			if(amount.match(/[a-zA-Z\-`!@#$%^&*]/) != null)
			{
				alert('Please Enter postive number');
				$('#amount').css({'border-color' : 'red'});
				return false;
			}
			else
			{
				$('#amount').css({'border-color' : 'green'});
			}

			var grand_total = parseInt($('#grand_total').val());
			var amount = parseInt($('#amount').val());

			if(amount >= grand_total)
			{
				var dues = 0;
				var return_amount = amount - grand_total;

			}
			if(amount < grand_total)
			{
				var dues = grand_total - amount;
				var return_amount = 0;
			}

			$('#calculated-amount').html('<p>Amount Paid :' + amount + '<br>\n\
										    Return Amount:' + return_amount + '<br>\n\
										    Dues: ' + dues + '</p>');
		});

		$('#confirm-payment').on('click', function(e){
			e.preventDefault();
			if($('#amount').val() == '')
			{
				alert('Please Enter amount');
				$('#amount').css({'border-color':'red'});
				return false;
			}
			else
			{
				$('#amount').css({'border-color':'green'});
			}

			var amount = $('#amount').val();
			if(amount.match(/[a-zA-Z\-`!@#$%^&*]/) != null)
			{
				alert('Please Enter postive number');
				$('#amount').css({'border-color' : 'red'});
				return false;
			}
			else
			{
				$('#amount').css({'border-color' : 'green'});
			}
			$('#payment-form').submit();

		});
	});
</script>
@endsection

