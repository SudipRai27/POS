<?php

namespace Modules\Purchase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Purchase\Entities\Invoice;
use Modules\Purchase\Entities\Purchase;
use Modules\Suppliers\Entities\Suppliers;
use Session;
use Excel;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function getPaymentList()
    {
        $invoice = DB::table('purchase_invoice')
                        ->join('suppliers', 'suppliers.id',  '=', 'purchase_invoice.supplier_id')
                        ->select('suppliers.supplier_name', 'purchase_invoice.*')
                        ->get();
        return view('purchase::payment.list')->with('invoice', $invoice);
    }

    public function getViewPaymentFromInvoice($invoice_number)
    {
		$invoice_details = Invoice::findorFail($invoice_number);
		$purchase_details = Purchase::where('invoice_number', $invoice_number)->get();
                                 
		return view('purchase::payment.invoice-view')->with('invoice_details', $invoice_details)
													 ->with('purchase_details', $purchase_details);
    }

    public function getCreatePayment($invoice_number)
    {
        $invoice = Invoice::findorFail($invoice_number); 
        $purchase_details = Purchase::where('invoice_number', $invoice_number)->get();
        return view('purchase::payment.create-payment-view')->with('invoice', $invoice)
                                                            ->with('purchase_details', $purchase_details);
    }

    public function postCreatePayment(Request $request, $invoice_number)
    {
        $amount = $request->amount;
        $grand_total = $request->grand_total;

        if($amount >= $grand_total)
        {
            $dues = 0;
            

        }
        if($amount < $grand_total)
        {
            $dues = $grand_total - $amount;
            
        }

        $invoice = Invoice::find($invoice_number);
        $invoice->paid_amount = $request->amount;
        $invoice->payment_date = date('Y-m-d');
        $invoice->dues = $dues;
        if($dues == 0)
        {
            $invoice->is_paid = 'paid';
        }
        else
        {
            $invoice->is_paid = 'partially paid';
        }
        $invoice->save();
        Session::flash('success-msg', 'Payment Completed');
        return redirect()->route('payment-list');       

    }

    public function getInvoicePrintforPayment($invoice_number)
    {
        $invoice_details = Invoice::findorFail($invoice_number); 
        $purchase_details = Purchase::where('invoice_number', $invoice_number)->get();
        return view('purchase::payment.print-payment')->with('invoice_details', $invoice_details)
                                                      ->with('purchase_details', $purchase_details);
    }

    public function getPaymentClearDues($invoice_number)
    {
        $invoice = Invoice::findorFail($invoice_number); 
        $purchase_details = Purchase::where('invoice_number', $invoice_number)->get();
        return view('purchase::payment.clear-dues')->with('invoice', $invoice)
                                                   ->with('purchase_details', $purchase_details);
    }

    public function postPaymentClearDues(Request $request, $invoice_number)
    {
        $invoice = Invoice::findorFail($invoice_number);
        $invoice->dues = 0;
        $invoice->is_paid = 'paid';
        $invoice->due_payment_date = date('Y-m-d');
        $invoice->save();
        Session::flash('success-msg','Due Cleared Successfully');
        return redirect()->route('payment-list');
    }

    public function getDeletePurchasePaymentInvoice($invoice_number)
    {
        $purchase_details = Purchase::where('invoice_number', $invoice_number)->delete();
        $invoice = Invoice::findorFail($invoice_number);
        $invoice->delete();
        Session::flash('success-msg', 'Invoice Deleted Successfully');
        return redirect()->back();
    }


    public function getPaymentExcelReport()
    {
        $purchase_invoice = Invoice::all();
        if(!$purchase_invoice)
        {
            Session::flash('error-msg', 'Purchase Invoice Not found');
            return redirect()->back();
        }

        Excel::create('Purchase Details', function($excel) use ($purchase_invoice) {
            $excel->sheet('Purchase sheet', function($sheet) use ($purchase_invoice)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Invoice Number');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Invoice Generated');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Supplier');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Total');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Paid Amount');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('Payment Date');   });
                $sheet->cell('G1', function($cell) {$cell->setValue('Dues');   });
                $sheet->cell('H1', function($cell) {$cell->setValue('Status');   });
                $sheet->cell('I1', function($cell) {$cell->setValue('Due Payment Date');   });
                $sheet->cell('J1', function($cell) {$cell->setValue('Purchase Details');   });
                if (!empty($purchase_invoice)) {
                    foreach ($purchase_invoice as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->invoice_number); 
                        $sheet->cell('B'.$i, $value->invoice_generated_date); 
                        $sheet->cell('C'.$i, Suppliers::where('id', $value->supplier_id)->pluck('supplier_name')[0]); 
                        $sheet->cell('D'.$i, $value->grand_total); 
                        $sheet->cell('E'.$i, $value->paid_amount); 
                        $sheet->cell('F'.$i, $value->payment_date); 
                        $sheet->cell('G'.$i, $value->dues); 
                        $sheet->cell('H'.$i, $value->is_paid); 
                        $sheet->cell('I'.$i, $value->due_payment_date); 
                        $sheet->cell('J'.$i, Purchase::where('invoice_number', $value->invoice_number)->select('product_code', 'quantity', 'price', 'total_price')->get()); 
                    }
                }
            });
        })->download();

    }

}
