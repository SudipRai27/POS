@extends('backend.layouts.submain')
@section('content')
<?php
$settings = Modules\Settings\Entities\Settings::first();
$helper_controller = new App\Http\Controllers\HelperController;
$number_to_words = $helper_controller->changeAmountToWords($invoice_details->grand_total);

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-3">
                    <img src="{{URL::to('public/images/settings/'.$settings->logo)}}" width="200" height="100">
                </div>
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-3">
                    <h2>Invoice No : {{$invoice_details->invoice_number}}</h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <h4>Bill To : <br>
                    {{Modules\Suppliers\Entities\Suppliers::where('id', $invoice_details->supplier_id)->pluck('supplier_name')[0]}}</h4>
                </div>
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-3">
                    Invoice Generated Date: {{ date('M j Y ', strtotime($invoice_details->invoice_generated_date)) }}<br>
                    Payment Date: {{$invoice_details->payment_date}}<br>
                    @if($invoice_details->due_payment_date)
                    Dues Payment Date : {{$invoice_details->due_payment_date}}
                    @else
                    <div style = "background-color:#DED6D7;">Dues: {{$invoice_details->dues}}</div>
                    @endif
                </div>

            </div>
            <hr>
          
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="text-center"><strong></strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                    <td><strong>Quantity</strong></td>
                                    <td><strong>Price</strong></td>
                                    <td><strong>Amount</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase_details as $index => $d)
                                <tr>                    
                                    <td>{{$d->product_name}} / {{$d->product_code}} </td>
                                    <td>{{$d->quantity}}</td>
                                    <td>{{$d->price}}</td>
                                    <td>{{$d->total_price}}</td>
                                </tr>
                                @endforeach
                                
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong></strong></td>
                                    <td class="highrow text-right"></td>
                                </tr>
                                
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"><strong>Total</strong></td>
                                    <td class="emptyrow">{{$invoice_details->grand_total}}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"><strong>Paid Amount</strong></td>
                                    <td class="emptyrow">{{$invoice_details->paid_amount}}</td>
                                </tr>
                               
                                @if($invoice_details->due_payment_date)
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"><strong>Dues Paid</strong></td>
                                    <td class="emptyrow">{{$invoice_details->grand_total - $invoice_details->paid_amount}}.00</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        Total Amount in Words : <p style="color:red;">{{$number_to_words}}</p><br>
                        Notes: {{$invoice_details->notes}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}


.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>

@endsection
