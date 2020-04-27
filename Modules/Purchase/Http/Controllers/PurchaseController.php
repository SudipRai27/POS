<?php

namespace Modules\Purchase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Products;
use Modules\Suppliers\Entities\Suppliers;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\Invoice;
use Modules\Stock\Entities\Stock;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getCreatePurchase()
    {        
        $suppliers = Suppliers::pluck('supplier_name', 'id');
        return view('purchase::purchase.add-purchase')->with('suppliers', $suppliers);
    }

    public function postPurchaseProducts(Request $request)
    {   

        $product_codeArr = json_decode($request->product_code);
        $quantityArr = json_decode($request->quantity);
        $priceArr = json_decode($request->price);
        $total_priceArr = json_decode($request->total_price);


        for ($i = 0; $i < count($product_codeArr); $i++) 
        {
            if(($product_codeArr[$i] != ""))
            { //not allowing empty values and the row which has been removed.
                
                $purchase = new Purchase;
                $purchase->product_code = $product_codeArr[$i];
                $purchase->product_name = Products::where('product_code', $product_codeArr[$i])->pluck('product_name')[0];
                $purchase->quantity = $quantityArr[$i];
                $purchase->price = $priceArr[$i];
                $purchase->total_price = $total_priceArr[$i];
                $purchase->invoice_number= $request->invoice_number;
                $purchase->save();
           
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
                    $quantity_to_add = $quantityArr[$i];
                    $total_quantity = $current_quantity + $quantity_to_add;
                    $stock->quantity = $total_quantity;
                    $stock->save();

                }   
                else
                {
                    $stock = new Stock;
                    $stock->product_code = $product_codeArr[$i];
                    $stock->quantity = $quantityArr[$i];
                    $stock->save();
                }
           
            }
        } 

        $invoice = new Invoice;
        $invoice->grand_total = $request->grand_total_price;
        $invoice->dues = $request->grand_total_price;
        $invoice->invoice_number = $request->invoice_number; 
        $invoice->supplier_id = $request->supplier_id; 
        $invoice->invoice_generated_date = $request->date;
        $invoice->notes = $request->notes;
        $invoice->save();


    }
}
