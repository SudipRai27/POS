<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sales\Entities\Sales;
use Modules\Sales\Entities\SalesInvoice;
use Modules\Stock\Entities\Stock;
use Modules\Products\Entities\Products;
use Session;
use Excel;
use DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getCreateSales()
    {
        return view('sales::make-sales');
    }

    public function postMakeQuickSales(Request $request)
    {
        $product_codeArr = json_decode($request->product_code);
        $quantityArr = json_decode($request->quantity);
        $priceArr = json_decode($request->price);
        $total_priceArr = json_decode($request->total_price);


        for ($i = 0; $i < count($product_codeArr); $i++) 
        {
            if(($product_codeArr[$i] != ""))
            { //not allowing empty values and the row which has been removed.
                
                $sales = new Sales;
                $sales->product_code = $product_codeArr[$i];
                $sales->product_name = Products::where('product_code', $product_codeArr[$i])->pluck('product_name')[0];
                $sales->quantity = $quantityArr[$i];
                $sales->price = $priceArr[$i];
                $sales->total_price = $total_priceArr[$i];
                $sales->invoice_number= $request->invoice_number;
                $sales->save();
           
            }
        }       

        for ($i = 0; $i < count($product_codeArr); $i++) 
        {
            if(($product_codeArr[$i] != ""))
            { //not allowing empty values and the row which has been removed.
                

                $stock = Stock::where('product_code', $product_codeArr[$i])->first();
                
                if(count($stock))
                {
                   
                    $current_quantity = $stock->quantity;
                    $quantity_to_subtract = $quantityArr[$i];
                    $total_quantity = $current_quantity - $quantity_to_subtract;
                    $stock->quantity = $total_quantity;
                    $stock->save();

                }   
           
            }
        } 

        $invoice = new SalesInvoice;
        $invoice->grand_total = $request->grand_total_price;
        $invoice->grand_total_with_vat = $request->grand_total_with_vat;
        $invoice->invoice_number = $request->invoice_number; 
        $invoice->invoice_generated_date = $request->date;
        $invoice->paid_amount = $request->amount;
        $invoice->return_amount = $request->return_amount;
        $invoice->vat_percent = $request->vat;
        $invoice->notes = $request->notes;
        $invoice->save();

    }


    public function getPrintSales()
    {
        return view('sales::print-sales');
    }

    public function getSalesList()
    {
        $invoice = SalesInvoice::all();
        return view('sales::list')->with('invoice', $invoice);
    }

    public function getViewSalesInvoice($invoice_number)
    {
        $invoice_details = SalesInvoice::findorFail($invoice_number); 
        
        $sales_details = Sales::where('invoice_number', $invoice_details->invoice_number)->get();
        return view('sales::view-sales-invoice')->with('invoice_details', $invoice_details)
                                                ->with('sales_details', $sales_details);
    }

    public function getPrintSalesInvoice($invoice_number)
    {

        $invoice_details = SalesInvoice::where('invoice_number', $invoice_number)->first();


        $sales_details = Sales::where('invoice_number', $invoice_details->invoice_number)->get();
        
        
        return view('sales::print-sales-invoice')->with('invoice_details', $invoice_details)
                                                ->with('sales_details', $sales_details);
    }

    public function getDeleteSalesInvoice($invoice_number)
    {
        $sales_delete = Sales::where('invoice_number', $invoice_number)->delete();
        $sales_invoice = SalesInvoice::where('invoice_number', $invoice_number)->delete();
        Session::flash('success-msg', 'Invoice Sales Deleted Successfully');
        return redirect()->back();
    }

    public function getSalesExcelReport()
    {
        $sales_invoice = SalesInvoice::all();
        if(!$sales_invoice)
        {
            Session::flash('error-msg', 'No Sales Found'); 
            return redirect()->back();
        }

        Excel::create('Sales Details', function($excel) use ($sales_invoice) {
            $excel->sheet('Sales sheet', function($sheet) use ($sales_invoice)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Invoice Number');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Invoice Generated Date');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Sub Total');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('VAT %');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Total');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('Paid Amount');   });
                $sheet->cell('G1', function($cell) {$cell->setValue('Return Amount');   });
                $sheet->cell('H1', function($cell) {$cell->setValue('Sales Report');   });
                if (!empty($sales_invoice)) {
                    foreach ($sales_invoice as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->invoice_number); 
                        $sheet->cell('B'.$i, $value->invoice_generated_date); 
                        $sheet->cell('C'.$i, $value->grand_total); 
                        $sheet->cell('D'.$i, $value->vat_percent); 
                        $sheet->cell('E'.$i, $value->grand_total_with_vat); 
                        $sheet->cell('F'.$i, $value->paid_amount); 
                        $sheet->cell('G'.$i, $value->return_amount); 
                        $sheet->cell('H'.$i, Sales::where('invoice_number', $value->invoice_number)->select('product_code', 'quantity', 'price', 'total_price')->get()); 
                    }
                }
            });
        })->download();

    }
}
