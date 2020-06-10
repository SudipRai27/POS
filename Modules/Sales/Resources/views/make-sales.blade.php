@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<?php
$helper_controller = new \App\Http\Controllers\HelperController;
$invoice_number = $helper_controller->getLatestInvoiceNumberForSales();
?>
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Quick Sales Form</b></h4>	
		<div class="box"> 
			<div class="box-body">
				<div class="row">
				 	<div class="col-sm-6">
				 		<div class="panel panel-primary">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="invoice_number">Invoice No :</label>
											<input type="text" name="invoice_number" id="invoice_number" class="form-control" value="{{$invoice_number}}" readonly="">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="date">Date :</label>
											<input type="text" name="date" id="date" class="form-control" style=" background: #ffffff;" placeholder="Select Date">
										</div>
									</div>	
									<div class="col-sm-4">
										<div class="form-group">
											<label for="product_code">Product Code:</label>
											<input type="text" class="typehead form-control" name="product_code" id="product_code" placeholder="Enter Product Code">
											<p style="color:red;">Enter the first letter of product code</p>
										</div>
									</div>			
								</div>
								<div class="row">	
									<div class="col-sm-4">
										<div class="form-group">
											<label for="price">Selling Price :</label>
											<input type="text" name="price" id="price" class="form-control" readonly>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="stock">Current Stock :</label>
											<input type="text" name="stock" id="stock" class="form-control" readonly>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="quantity">Quantity :</label>
											<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Quantity">
										</div>
									</div>
									
								</div>		
								<p align="center"><button id="add-products" class="btn btn-primary">Add</button></p>				
							</div>
						</div>
					   	<div class="row">
					   		<div class="col-sm-6">
					   		<p style = "color:#D61224;">Grand Total:</p>
					   			<input type="text" name="grand_total_price" class="form-control" id="grand_total_price" readonly="">
					   		</div>
					   		<div class="col-sm-6">
					   		<p style = "color:#D61224;">Grand Total With Vat:</p>
					   		 	<input type="text" name="grand_total_with_vat" id = "grand_total_with_vat" class="form-control" readonly="">
					   		</div>
					   	</div>
					   	<div class="row">
					   		<div class="col-sm-6">
					   		<p style = "color:#D61224;">VAT %:</p>
					   			<input type="text" name="vat" class="form-control" id="vat" value="13" readonly="">
					   		</div>
					   		<div class="col-sm-6">
					   		<p style = "color:#D61224;">Enter Amount To Pay:</p>
					   		 	<input type="text" name="amount" class="form-control" id="amount" onfocusout="calculate()">
					   		</div>
					   	</div>
					   	<br>
					   	<div class="row">
					   		<div class="col-sm-6">
					   			<p style = "color:#D61224;">Return Amount:</p>
					        	<input type="text" name="return_amount" id="return_amount" readonly class="form-control">
					        </div>
					        <div class="col-sm-6">
					        <br>
					            <button class="btn btn-warning" id="confirm-sales-button">Confirm Sales</button>	
					                  
					        </div>
					     </div>
				 	</div>
				 	<div class="col-sm-6">
					 	<div class="panel panel-primary">
							<div class="panel-title"><br>
								<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales List</b>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
							        <table class="table table-bordered table-hover" id="sales-table" name="sales-table">        
										<thead>
											<tr>
											<th>SN</th>									
											<th>Product Code</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<th>Total Price</th>
											<th>Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>       								
							        </table>
		        				</div>
							</div>
						</div>
						<textarea class="form-control" placeholder="NOTES" rows="5" id="notes"></textarea>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@endsection
@section('custom-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{asset('public/sms/assets/js/date-time-picker.min.js')}}"></script>
<script>
function myconfirm()
{
    if(confirm('Confirm with the sales process ?'))
        return true;
    return false;
}

function calculate()
{
	var grand_total_price = parseInt($('#grand_total_price').val());
	var grand_total_with_vat = parseInt($('#grand_total_with_vat').val());
	var amount = parseInt($('#amount').val());

	if(amount < grand_total_with_vat)
	{
		alert('Insufficient payment amount, You cannot proceed further');
		$('#amount').val('');
		$('#amount').css({'border-color' : 'red'});
		return false;
	}
	else
	{
		$('#amount').css({'border-color' : 'green'});
	}

	var return_amount = amount - grand_total_with_vat; 
	$('#return_amount').val(return_amount);


}
</script>
<script type="text/javascript">
    $('#date').dateTimePicker({
    	mode: 'dateTime'
    });
</script>
<script type="text/javascript">

$(function()
{
	$("#product_code").autocomplete({
	source: "{{route('product-autocomplete')}}",
	minLength: 1,
	select: function(event, ui) {
		$('#product_code').val(ui.item.value);
		var product_code = ui.item.value;
		$.ajax({
			'data' : {'product_code': product_code},
			'url' : '{{route('get-selling-price-from-product-code')}}',
			'method' : 'get', 
		}).done(function(data){
			$('#price').val(data[0]); 
			$('#stock').val(data[1]);
		});

		}
	});
});
</script>

 
<script type="text/javascript">

$(document).ready(function(){
	
	var id = 1;
	sessionStorage.clear();

	$('#add-products').on('click', function(){
		var invoice_number = $('#invoice_number').val();
		var date = $('#date').val();
		var product_code = $('#product_code').val();
		var price = $('#price').val();
		var stock = $('#stock').val();
		var quantity = $('#quantity').val();
		var newid = id++;
			

		//Do validation

		if(date == '')
		{
			alert('Please Enter date');
			$('#date').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#date').css({'border-color' : 'green'});
		}

		if(product_code == '')
		{
			alert('Please Enter Product');
			$('#product_code').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#product_code').css({'border-color' : 'green'});
		}


		if(stock == '')
		{
			alert('You are out of stock, Please Check stock');
			$('#stock').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#stock').css({'border-color' : 'green'});
		}


		if(quantity == '')
		{
			alert('Please Enter quantity');
			$('#quantity').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#quantity').css({'border-color' : 'green'});
		}

		if((quantity.match(/[a-zA-Z\-`!@#$%^&*]/)) != null)
		{
			alert("Enter only positive number for quantity");
			$('#quantity').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#quantity').css({'border-color' : 'green'});	
		}

		
		if(parseInt(quantity) > parseInt(stock))
		{
			alert("You have insufficient stock right now"); 
			$('#quantity').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#quantity').css({'border-color' : 'green'});	
		}

		updateProductListTableRows(invoice_number, date, product_code, quantity, price, newid)

	});


	function updateProductListTableRows(invoice_number, date, product_code, quantity, price, newid)
	{

		var total_price = quantity * price;
				
		if(sessionStorage.getItem(grand_total_price) == null)
		{
			var grand_total_price;
			sessionStorage.setItem(grand_total_price, total_price);
		}
		else if($('#grand_total_price').val != 0 )
		{
			var amount = $('#grand_total_price').val();
			sessionStorage.setItem(grand_total_price, parseInt(amount) + parseInt(total_price));

		}

		else
		{
		
			sessionStorage.setItem(grand_total_price, parseInt(sessionStorage.getItem(grand_total_price)) + parseInt(total_price));	
			
		}

		
		
		$("#sales-table").append('<tr valign="top" id="'+newid+'">\n\
			<td>' + newid + '</td>\n\
			<td class="product_code'+newid+'">' + product_code + '</td>\n\
			<td class="quantity'+newid+'">' + quantity + '</td>\n\
			<td class="price'+newid+'">' + price + '</td>\n\
			<td class="total_price'+newid+'">' + price * quantity + '</td>\n\
			<td><a class="btn btn-danger" id="remove-btn'+newid+'">Remove</a></td>\n\ </tr>');	

		
		$('#product_code').val('');
		$('#quantity').val('');
		$('#price').val('');
		$('#stock').val('');
		$('#product_code').css({'border-color': '#d2d6de'});
		$('#date').css({'border-color': '#d2d6de'});
		$('#quantity').css({'border-color': '#d2d6de'});
		$('#stock').css({'border-color': '#d2d6de'});
		//set value in total grand input field
		
		$('#grand_total_price').val(sessionStorage.getItem(grand_total_price));
		
		var grand_total_price_2 = parseInt($('#grand_total_price').val());
		var vat = parseInt($('#vat').val());
		var vat_amount = (vat/100);
		
		var grand_total_price_with_vat = vat_amount * grand_total_price_2;
		var grand_total_price_with_vat = parseInt(grand_total_price_with_vat) + grand_total_price_2;
		//set value in grand total with vat
		$('#grand_total_with_vat').val(grand_total_price_with_vat);

		//on clicking remove button
		$('#sales-table').on('click', '#remove-btn'+newid+'', function(){
			$(this).parent().parent().remove();

			var amount_to_deduct = $(this).parents('tr').find("td:eq(4)").text();

			var grand_total_price = $('#grand_total_price').val();

			var deducted_amount = parseInt(grand_total_price) - parseInt(amount_to_deduct);
			

			if(deducted_amount == 0)
			{
				sessionStorage.clear();
			}

			$('#grand_total_price').val(deducted_amount);
			var grand_total_price_2 = parseInt($('#grand_total_price').val());
			var vat = parseInt($('#vat').val());
			var vat_amount = (vat/100);
			var grand_total_price_with_vat = vat_amount * grand_total_price_2;
			var grand_total_price_with_vat = parseInt(grand_total_price_with_vat) + grand_total_price_2;
			//set value in grand total with vat
			$('#grand_total_with_vat').val(grand_total_price_with_vat);
			
		});
				
		
	}


});	

	//on clicking confirm sales button

	$('#confirm-sales-button').unbind().click(function(){

		var rowCount = $('#sales-table >tbody >tr').length;
		if(rowCount == 0)
		{
			alert('Please Enter products before sales'); 
			return false;
		}


		var length_amount = $('#amount').val().length;
		if(length_amount == 0)
		{
			alert('Please Enter the amount to pay');
			$('#amount').css({'border-color' : 'red'});
			return false;
		}
		else
		{
			$('#amount').css({'border-color' : 'green'});
		}

		var lastRowId = $('#sales-table tr:last').attr('id');
		
		var product_code = new Array(); 
		var quantity = new Array(); 
		var price = new Array(); 
		var total_price = new Array();
		var grand_total_price = $('#grand_total_price').val();

		for ( var i = 1; i <= lastRowId; i++) 
		{
			product_code.push($("#"+i+" .product_code"+i).html());
			price.push($("#"+i+" .price"+i).html()); 
			quantity.push($("#"+i+" .quantity"+i).html()); 
			total_price.push($("#"+i+" .total_price"+i).html()); 
			
		}
		
		var product_code = JSON.stringify(product_code); 
		var quantity = JSON.stringify(quantity);
		var price = JSON.stringify(price);
		var total_price = JSON.stringify(total_price);
		
		var invoice_number = $('#invoice_number').val();
		var date = $('#date').val();
		var grand_total_price = $('#grand_total_price').val();
		var grand_total_with_vat = $('#grand_total_with_vat').val();
		var vat = $('#vat').val();
		var amount = $('#amount').val();
		var return_amount = $('#return_amount').val();
		var notes = $('#notes').val();
		

		$.ajax({
			url: "{{route('ajax-make-quick-sales')}}",
			type: "post",
			data: { product_code : product_code , 
				    quantity : quantity,
				    price: price,
				    total_price : total_price, 
				    invoice_number:invoice_number, 
				    date : date,
				    grand_total_price : grand_total_price, 
				    grand_total_with_vat : grand_total_with_vat, 
				    vat : vat,
				    amount : amount, 
				    return_amount : return_amount, 
				    notes : notes, 
				    _token : $('input[name=_token]').val()
				    
				   },
			success : function(data){
				$('#grand_total_price').val('');
				$('#grand_total_with_vat').val('');
				$('#amount').val('');
				$('#return_amount').val('');
				$('#date').val('');				
				location.reload();			
				window.open('{{route('print-sales')}}');

				}
			
			});

	});

</script>
@endsection
