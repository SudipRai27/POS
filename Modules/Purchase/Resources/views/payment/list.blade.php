@extends('backend.layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/table.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/sms/assets/css/dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.css">
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12">
	<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;Payment List</b></h4>	
		<div class="box">
			<div class="box-body">
				<div class="panel panel-success">
					<div class="panel-primary"><br>	
					&nbsp;&nbsp;<a href="{{route('payment-invoice-report-excel')}}" class="btn btn-danger" type="button">Generate Excel</a>			
					</div>
					<div class="panel-body">
						<div class="table-responsive">
					       <table id="example" class="display" cellspacing="0" width="100%">
							    <thead>
							        <tr>
							            <th>Invoice Number</th>
							            <th>Supplier</th>
							            <th>Invoice Date</th>
							            <th>Grand Total</th>
							            <th>Status</th>
							            <th>Actions</th>
							        </tr>
							    </thead>
							    <tfoot>
							        <tr>
							            <th>Invoice Number</th>
							            <th>Supplier</th>
							            <th>Invoice Date</th>
							            <th>Grand Total</th>
							            <th>Status</th>
							            <th></th>
							        </tr>
							    </tfoot>
							    <tbody>
							    @foreach($invoice as $index => $d)
								<tr>
									<td><a href="{{route('view-payment-invoice', $d->invoice_number)}}" data-lity>{{$d->invoice_number}}</a></td>
									<td>{{$d->supplier_name}}</td>
									<td>{{ date('M j Y ', strtotime($d->invoice_generated_date)) }}</td>
									<td>{{$d->grand_total}}</td>
									<td>{{$d->is_paid}}</td>
									<td>
									@if($d->is_paid=='unpaid')
									<a href = "{{ route('create-payment', $d->invoice_number) }}"><button data-toggle="tooltip" title="Make Payment" class="btn btn-success btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
									@elseif($d->is_paid=='partially paid')
									<a href = "{{ route('clear-purchase-dues', $d->invoice_number)}}"><button data-toggle="tooltip" title="Clear Dues" class="btn btn-info btn-flat" type="button" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></button></a>
									@endif
									<a href="{{route('print-invoice-for-payment', $d->invoice_number)}}" target="blank" class="btn btn-warning" type="button">Print</a>
									@if($d->is_paid == 'paid')
									<a href = "{{ route('delete-purchase-payment-invoice', $d->invoice_number)}}" onclick="return myconfirm()"><button data-toggle="tooltip" title="Delete" class="btn btn-danger btn-flat" type="button" data-original-title="Delete"><i class="fa fa-fw fa-trash"></i></button></a>
     								@endif
     								</td>
								</tr>
								@endforeach
							        
							    </tbody>
							</table>				       
        				</div>		 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endsection
@section('custom-js')
<script type="text/javascript" src="{{asset('public/sms/assets/js/dataTables.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js"></script>
<script type="text/javascript" src="{{asset('public/sms/assets/js/date-time-picker.min.js')}}"></script>

<script>
function myconfirm()
{
    if(confirm('Confirm with the delete process ?'))
        return true;
    return false;
}
</script>

<script type="text/javascript">
	$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
@endsection
