<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Modules\Products\Entities\Products;
use Modules\Suppliers\Entities\Suppliers;
use Modules\Customers\Entities\Customers;
use Modules\Stock\Entities\Stock;
use Modules\Sales\Entities\SalesInvoice;
use Modules\Purchase\Entities\Invoice;
use Carbon\Carbon;

class AjaxController extends Controller
{
	public function getAjaxgetSubCategoryIdfromCategoryId(Request $request)
    {
    	$category_id = $request->category_id;
    	$sub_category = DB::table('product_subcategory')
    						->where('category_id', $category_id)
    						->pluck('subcategory_name', 'id');

    	
      	$select = '';
    	$select .= '<option> Select  </option>';

    	foreach($sub_category as $index => $d)
    	{

    		$select.= '<option value = '.$index.'>'.$d.'</option>';
    	}
    	$select.= '</select>';
    	return $select;

    }

    public function getAjaxProductsListFromCategoryIdSubCategoryId(Request $requests)
    {   
        $input = request()->all();
        $product_list = Products::where('category_id', $input['category_id'])
                                ->where('subcategory_id', $input['subcategory_id'])
                                ->orderBy('created_at', 'DESC')
                                ->get();
        
        return view('products::products.ajax-views.ajax-products-list')
                        ->with('product_list', $product_list);
    
    }

    public function getSearchValuesfromSearchFields(Request $request)
    {
        $search_term = $request->search_term;
        $table_to_search = $request->table_to_search;
     
        if($table_to_search == 'suppliers')
        {
            $suppliers =  Suppliers::where('supplier_name','LIKE','%'.$request->search_term."%")
                ->orWhere('supplier_code','LIKE','%'.$request->search_term."%")
                ->get();

            return view('suppliers::ajax-views.ajax-search-list-suppliers')
                            ->with('suppliers', $suppliers);
        }
        elseif($table_to_search == 'customers')
        {
            $customers =  Customers::where('customer_name','LIKE','%'.$request->search_term."%")
                ->orWhere('customer_code','LIKE','%'.$request->search_term."%")
                ->get();

            return view('customers::ajax-views.ajax-search-list-customers')
                            ->with('customers', $customers);
        }
        elseif($table_to_search == 'stock')
        {
            $stock =  Stock::where('product_code','LIKE','%'.$request->search_term."%")
                ->get();

            return view('stock::ajax.ajax-search-list-stock')
                            ->with('stock', $stock);
        }
        else
        {
            $search_term = $request->search_term;
            $products =  Products::where('product_name','LIKE','%'.$request->search_term."%")
                ->orWhere('product_code','LIKE','%'.$request->search_term."%")
                ->get();

            return view('products::products.ajax-views.ajax-search-product-list')
                            ->with('products', $products);
        }

    }

    public function getProductAutoComplete(Request $request)
    {
        $term = $request->term;
    
        $results = array();
        
        $queries = Products::where('product_code','LIKE','%'.$term."%")
                ->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->product_code ];
        }

        return response()->json($results);

    }

    public function getSellingPriceFromProductCode(Request $request)
    {
        $product_code = $request->product_code;
        $selling_price = Products::where('product_code', $product_code)->pluck('sales_price')[0];
        $current_stock = Stock::where('product_code', $product_code)->pluck('quantity')[0];
        
        $data = [];
        $data[0] = $selling_price; 
        $data[1] = $current_stock;
        return $data;

    }

    public function getAjaxSearchSalesHistory(Request $request)
    {
        $date_range = $request->date_range;
        $dates = explode('-',$date_range);
        $from = $dates[0];
        $to = $dates[1];
        $start = Carbon::parse(date('Y-m-d', strtotime($from)))->startofDay();
        $end = Carbon::parse(date('Y-m-d', strtotime($to)))->endofDay();
        
        if($start == $end)
        {   
            
            $results = SalesInvoice::whereRaw('date(created_at) = ?', $start)->get();
                                 
        }
        else
        {
        
            $results = SalesInvoice::whereBetween('created_at', [$start, $end])->get();
                                  
        }
        
                                                                  
        return view('report::sales.ajax-sales-report')->with('results', $results)
                                                      ->with('start', $start)
                                                      ->with('end', $end);
        
    }

    public function getAjaxPurchaseHistory(Request $request)
    {
        $date_range = $request->date_range;
        $dates = explode('-',$date_range);
        $from = $dates[0];
        $to = $dates[1];
        $start = Carbon::parse(date('Y-m-d', strtotime($from)))->startofDay();
        $end = Carbon::parse(date('Y-m-d', strtotime($to)))->endofDay();

        if($start == $end)
        {
           $results =  DB::table('purchase_invoice')
                        ->join('suppliers', 'suppliers.id', '=', 'purchase_invoice.supplier_id')
                        ->select('supplier_name', 'purchase_invoice.*')
                        ->whereRaw('purchase_invoice.date(created_at) = ?', $start)
                        ->get();

            //$results = Invoice::whereRaw('date(created_at) = ?', $start)->get();
        }
        else
        {
            $results =  DB::table('purchase_invoice')
                        ->join('suppliers', 'suppliers.id', '=', 'purchase_invoice.supplier_id')
                        ->select('suppliers.supplier_name', 'purchase_invoice.*')
                        ->whereBetween('purchase_invoice.created_at', [$start, $end])
                        ->get();
             //$results = Invoice::whereBetween('created_at', [$start, $end])->get();
        }
       
                                                           
        return view('report::purchase.ajax-purchase-report')->with('results', $results)
                                                            ->with('start', $start)
                                                            ->with('end', $end);
    }

    public function getAjaxDuesHistory(Request $request)
    {
        $date_range = $request->date_range;
        $dates = explode('-',$date_range);
        $from = $dates[0];
        $to = $dates[1];
        $start = Carbon::parse(date('Y-m-d', strtotime($from)))->startofDay();
        $end = Carbon::parse(date('Y-m-d', strtotime($to)))->endofDay();

        if($start == $end)
        {
            $results =  DB::table('purchase_invoice')
                        ->join('suppliers', 'suppliers.id', '=', 'purchase_invoice.supplier_id')
                        ->select('supplier_name', 'purchase_invoice.*')
                        ->whereRaw('purchase_invoice.date(created_at) = ?', $start)
                        ->where('dues', '!=' , 0)
                        ->get();


            //Invoice::whereRaw('date(created_at) = ?', $start)->where('dues', '!=' , 0)->get();
        }
        else
        {
            $results =  DB::table('purchase_invoice')
                        ->join('suppliers', 'suppliers.id', '=', 'purchase_invoice.supplier_id')
                        ->select('suppliers.supplier_name', 'purchase_invoice.*')
                        ->whereBetween('purchase_invoice.created_at', [$start, $end])
                        ->where('dues', '!=' , 0)
                        ->get();
             //$results = Invoice::whereBetween('created_at', [$start, $end])->where('dues', '!=' , 0)->get();
        }
       
                                                           
        return view('report::dues.ajax-dues-report')->with('results', $results)
                                                            ->with('start', $start)
                                                            ->with('end', $end);
    }

}

