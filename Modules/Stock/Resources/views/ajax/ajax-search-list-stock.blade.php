<table class="table table-bordered table-hover" id="stock-list">        
	<thead>
		<tr>
		<th>SN</th>
		<th>Product Code</th>
		<th>Product Name</th>
		<th>Quantity</th>
		</tr>
	</thead>
	<tbody>
	<?php  $i =1; ?>
	@foreach($stock as $index => $d)
		<tr>
		<td>{{$i++}}</td>
		<td>{{$d->product_code}}</td>
		<td>{{Modules\Products\Entities\Products::where('product_code', $d->product_code)->pluck('product_name')[0]}}</td>
		<td>{{$d->quantity}}</td>
		</tr>
	@endforeach
	</tbody>       								
</table>