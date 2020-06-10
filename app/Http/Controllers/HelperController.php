<?php
namespace App\Http\Controllers;
use Modules\Purchase\Entities\Invoice;
use Modules\Sales\Entities\SalesInvoice;
use Modules\Sales\Entities\Sales;
use Modules\Purchase\Entities\Purchase;
use NumberToWords\NumberToWords;
use DB;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class HelperController extends Controller
{

    public function removeGlobal($type)
    {
        if(Session::has($type))
            Session::forget($type);
    }
	   
    public function checkUserType()
    {
        if(auth()->guard('superadmin')->check())
        {
            $user_type = 'superadmin';
        }
        else
        {
            $user_type = 'user';
        }

        return $user_type;

    }

    public function getUserRoleId()
    {
        if(auth()->guard('user')->check())
        {
            $user_id = auth()->guard('user')->id();
            $role_id = DB::table('user_roles')
                        ->where('user_id', $user_id)
                        ->pluck('role_id')[0];
            
        }

        return $role_id;
    }


    public function getLatestInvoiceNumber()
    {
        $latest_record = Invoice::latest()->first();
        
        if(count($latest_record))
        {
            $nextInvoiceNumber = $latest_record->invoice_number;
            $nextInvoiceNumber = $nextInvoiceNumber + 1;
        }
        else
        {
            $nextInvoiceNumber = 1;    

        }
        
        return $nextInvoiceNumber;

    }

    public function getLatestInvoiceNumberForSales()
    {
        $latest_record = SalesInvoice::latest()->first();
        
        if(count($latest_record))
        {
            $nextInvoiceNumber = $latest_record->invoice_number;
            $nextInvoiceNumber = $nextInvoiceNumber + 1;
        }
        else
        {
            $nextInvoiceNumber = 1;    

        }
        
        return $nextInvoiceNumber;

    }

    public function changeAmountToWords($amount)
    {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $amount_in_words = $numberTransformer->toWords($amount);
        $amount_in_words = strtoupper($amount_in_words);
        return $amount_in_words;
    }


    public function getTopTenSales()
    {
        $sales_list = DB::table('sales')
                    ->join('products', 'products.product_code','=','sales.product_code')
                    ->get();
        $temp = [];
        foreach($sales_list as $index => $d)
        {
            $temp[DB::table('sales')->where('product_code', $d->product_code)->pluck('product_code')[0] .' - '. DB::table('sales')
                    ->join('products', 'products.product_code','=','sales.product_code')
                    ->pluck('product_name')[0]] = 
                    DB::table('sales')->where('product_code', $d->product_code)->sum('quantity');
        }        
        arsort($temp);        

        $toptenProduct = array_slice($temp,0,10, true);
        
        
        return $toptenProduct;
                
    }

    public function getBestSellingProduct()
    {
        $sales_list = DB::table('sales')->get();
        
        $temp = [];
        foreach($sales_list as $index => $d)
        {
            $temp[DB::table('sales')->where('product_code', $d->product_code)->pluck('product_code')[0]] = DB::table('sales')->where('product_code', $d->product_code)->sum('quantity');
        }
        
        if(count($temp))
        {
             
            return array_keys($temp, max($temp));
        }
        else
        {
            return $bestSellingProduct = [];
        }
     
    }

    public function getTotalPurchaseDues()
    {
        $total_dues = DB::table('purchase_invoice')
                          ->where('dues', '!=' , 0)
                          ->sum('dues');
                        
        return $total_dues;
    }

    public function getTodaysSales()
    {
        $todays_sales = Sales::where('created_at', '>=', Carbon::today()->toDateString())->sum('quantity');
        return $todays_sales;                            
        
    }         

    public function getTodaysPurchase()
    {
        $todays_purchase = Purchase::where('created_at', '>=', Carbon::today()->toDateString())->sum('quantity');
        return $todays_purchase;                               
    }      
}

