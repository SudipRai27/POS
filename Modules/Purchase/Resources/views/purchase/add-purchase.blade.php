@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
@stop
@section('content')
<?php
$helper_controller = new \App\Http\Controllers\HelperController;
$invoice_number = $helper_controller->getLatestInvoiceNumber();
?>
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Purchase Form</b></h4>	
		<div class="box"> 
			<div class="box-body">
				<div class="panel panel-danger">
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
									<label for="supplier_id">Supplier Name :</label>
									<select class="form-control" id="supplier_id">
									@foreach($suppliers as $index=>$d)
									<option value="{{$index}}">{{$d}}</option>
									@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="product_code">Product Code:</label>
									<input type="text" class="typehead form-control" name="product_code" id="product_code" placeholder="Enter Product Code">
									<p style="color:red;">Enter the first letter and the product code will appear automatically</p>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="quantity">Quantity :</label>
									<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Quantity">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="subcategory_id">Unit Price :</label>
									<input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
								</div>
							</div>
						</div>		
						<p align="center"><button id="add-products" class="btn btn-primary">Add</button></p>
									
					</div>
				</div>					
				<div class="panel panel-info">
					<div class="panel-title"><br>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Purchase List</b>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
					        <table class="table table-bordered table-hover" id="purchase-table" name="purchase-table">        
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
					        <p style = "color:#D61224;">Grand Total:</p>

					        <input type="text" name="invoice_number" class="form-control" id="grand_total_price" readonly=""><br>
					        <div class="form-group">
					        <p style="color:red;">NOTES:</p>
					        <textarea class="form-control" placeholder="NOTES" id ='notes'></textarea>
					        </div>
					       <br><p align="right"><button class="btn btn-success" id="confirm-purchase-button">Confirm Purchase</button></p>
        				</div>
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

<script type="text/javascript">
    $('#date').dateTimePicker({
    	mode: 'dateTime'
    });
</script>
<script type="text/javascript">
$(function()
{
	$( "#product_code").autocomplete({
	source: "{{route('product-autocomplete')}}",
	minLength: 1,
	select: function(event, ui) {
		$('#product_code').val(ui.item.value);
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
		var supplier_id = $('#supplier_id').val();
		var product_code = $('#product_code').val();
		var quantity = $('#quantity').val();
		var price = $('#price').val();
		var newid = id++;
			
	//Do validation

		if(date == '')
		{
			alert('Please Enter date');
			return false;
		}

		if(product_code == '')
		{
			alert('Please Enter Product');
			return false;
		}

		if(quantity == '')
		{
			alert('Please Enter quantity'); 
			return false;
		}

		if((quantity.match(/[a-zA-Z\-`!@#$%^&*]/)) != null)
		{
			alert("Enter only positive number for quantity");
			return false;
		}

		if(price == '')
		{
			alert('Please Enter Price'); 
			return false; 
		}

		if((price.match(/[a-zA-Z\-`!@#$%^&*]/)) != null)
		{
			alert("Enter only positive number for price");
			return false;
		}

		updateProductListTableRows(invoice_number, date, supplier_id, product_code, quantity, price, newid)

	});


	function updateProductListTableRows(invoice_number, date, supplier_id, product_code, quantity, price, newid)
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
		
		$("#purchase-table").append('<tr valign="top" id="'+newid+'">\n\
			<td>' + newid + '</td>\n\
			<td class="product_code'+newid+'">' + product_code + '</td>\n\
			<td class="quantity'+newid+'">' + quantity + '</td>\n\
			<td class="price'+newid+'">' + price + '</td>\n\
			<td class="total_price'+newid+'">' + price * quantity + '</td>\n\
			<td><a class="btn btn-danger" id="remove-btn'+newid+'">Remove</a></td>\n\ </tr>');	

		
		$('#product_code').val('');
		$('#quantity').val('');
		$('#price').val('');
		
		//set value in total grand input field
		
		$('#grand_total_price').val(sessionStorage.getItem(grand_total_price));
		
		$('#purchase-table').on('click', '#remove-btn'+newid+'', function(){
			$(this).parent().parent().remove();

			var amount_to_deduct = $(this).parents('tr').find("td:eq(4)").text();

			var grand_total_price = $('#grand_total_price').val();

			var deducted_amount = parseInt(grand_total_price) - parseInt(amount_to_deduct);
			

			if(deducted_amount == 0)
			{
				sessionStorage.clear();
			}
			$('#grand_total_price').val(deducted_amount);
			
		});
				
		


	}


});	
		//on clicking confirm save button

	$('#confirm-purchase-button').unbind().click(function(){
		var rowCount = $('#purchase-table >tbody >tr').length;
		if(rowCount == 0)
		{
			alert('Please Enter products before purchase'); 
			return false;
		}
		var lastRowId = $('#purchase-table tr:last').attr('id');
		
		var product_code = new Array(); 
		var quantity = new Array(); 
		var price = new Array(); 
		var total_price = new Array();
		var grand_total_price = $('#grand_total_price').val();

		for ( var i = 1; i <= lastRowId; i++) 
		{
			product_code.push($("#"+i+" .product_code"+i).html());
			quantity.push($("#"+i+" .quantity"+i).html()); 
			price.push($("#"+i+" .price"+i).html()); 
			total_price.push($("#"+i+" .total_price"+i).html()); 
			
		}
		
		var product_code = JSON.stringify(product_code); 
		var quantity = JSON.stringify(quantity);
		var price = JSON.stringify(price);
		var total_price = JSON.stringify(total_price);
		
		var date = $('#date').val();
		var invoice_number = $('#invoice_number').val();
		var supplier_id = $('#supplier_id').val();
		var grand_total_price = $('#grand_total_price').val();
		var notes = $('#notes').val();
		$.ajax({
			url: "{{route('ajax-purchase-products-post')}}",
			type: "POST",
			data: { product_code : product_code , 
				    quantity : quantity,
				    price: price,
				    total_price : total_price, 
				    invoice_number:invoice_number, 
				    grand_total_price : grand_total_price, 
				    supplier_id : supplier_id,
				    date : date, 
				    notes : notes,
				    _token : $('input[name=_token]').val()
				    
				   },
			success : function(data){
				alert('Purchased Successfully. Head over to the payment section');
				location.reload();

				}
			
			});

	});
</script>
@endsection
