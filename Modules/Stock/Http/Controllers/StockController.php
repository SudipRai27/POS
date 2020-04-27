<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Stock\Entities\Stock;
use Modules\Products\Entities\Products;
use Excel;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
   public function getList()
   {
        $stock = Stock::orderBy('created_at', 'DESC')->paginate(7);
        
        return view('stock::list')->with('stock', $stock);
   }

   public function getStockExcel()
   {
   		$stock = Stock::all();
   		if(!$stock)
   		{
   			Session::flash('error-msg', 'No Stock Available');
   			return redirect()->back();
   		}

   		Excel::create('Stock Details', function($excel) use ($stock) {
            $excel->sheet('Stock sheet', function($sheet) use ($stock)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Product Code');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Name');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Quantity');   });
                if (!empty($stock)) {
                    foreach ($stock as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->product_code); 
                        $sheet->cell('B'.$i, Products::where('product_code', $value->product_code)->pluck('product_name')[0]);
                        $sheet->cell('C'.$i, $value->quantity); 
                        
                      
                    }
                }
            });
        })->download();

    }
}
