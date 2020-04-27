<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use File; 
use Modules\Products\Entities\Products;
use Modules\Products\Entities\Category;
use Modules\Products\Entities\SubCategory;
use Modules\Stock\Entities\Stock;
use DB;
use Image;
use Excel;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function getListProduct()
    {
    	$products = Products::orderBy('created_at', 'DESC')->paginate(6);
        $category = Category::pluck('category_name', 'id');

    	return view('products::products.list')->with('products', $products)
                                              ->with('category', $category);
    }

    public function getCreateProduct()
    {	
    	$category = Category::pluck('category_name', 'id');
    	return view('products::products.create')->with('category', $category);
    }


    public function postCreateProduct(Request $request)
    {	   		
    	$request->validate([
    		'product_code' => 'required|unique:products,product_code',
    		'product_name' => 'required', 
    		'sales_price'  => 'required|numeric', 
    		]);
	
        $input = request()->all();

    	$category_id= $request->category_id;
    	$subcategory_id = $request->subcategory_id;

    	if($category_id == 0 )
    	{
    		Session::flash('error-msg','Please select Category');
    		return redirect()->back()->withInput($request->input());
    	}
    	if($subcategory_id == 0 )
    	{
    		Session::flash('error-msg','Please select sub-category');
    		return redirect()->back()->withInput($request->input());
    	}

    	
        if($request->hasFile('image')) 
        {
            $image= $request->file('image');
            $filename  = uniqid() . $image->getClientOriginalName();
            $path = public_path('images/product_photos/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $input['image'] = $filename;
        }
      
        Products::create($input);
        Session::flash('success-msg', 'Product Created Successfully');
        return redirect()->back();   

    }

    public function getViewProduct($id)
    {
        $product = Products::findorFail($id);
        return view('products::products.view')->with('product', $product);
    }


    public function getProductDelete($id)
    {
        $product = Products::findorFail($id);
        $stock_count = Stock::where('product_code', $product->product_code)->pluck('quantity')[0];
        if($stock_count != 0)
        {
            Session::flash('error-msg', 'You have stock remaininig for this product. Please empty the stock and try again');
            return redirect()->back();
        }

        Stock::where('product_code', $product->product_code)->delete();
        $image_path = public_path().'/images/product_photos/'. $product->image;   
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        Session::flash('success-msg', 'Product Deleted Successfully');
        return redirect()->back();
    
    }

    public function getProductEdit($id)
    {
        $product = Products::findorFail($id);
        $category = Category::select('category_name', 'id')->get();
        
        $subcategory = SubCategory::where('category_id',$product->category_id)->get();
        
        return view('products::products.edit')->with('product', $product)
                                              ->with('category', $category)
                                              ->with('subcategory', $subcategory);
    }

    public function postEditProduct(Request $request, $id)
    {   
        $request->validate([
            'product_code' => 'required|unique:products,product_code,'.$id,
            'product_name' => 'required', 
            'sales_price'  => 'required|numeric', 
            ]);
    
        $input = request()->all();
        $category_id= $request->category_id;
        $subcategory_id = $request->subcategory_id;

        if($category_id == 0 )
        {
            Session::flash('error-msg','Please select Category');
            return redirect()->back()->withInput($request->input());
        }
        if($subcategory_id == 0 )
        {
            Session::flash('error-msg','Please select sub-category');
            return redirect()->back()->withInput($request->input());
        } 

        $product = Products::findorFail($id);
        if($request->hasFile('image'))
        {
            $image_path = public_path().'/images/product_photos/'.$product->image;
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
            $image= $request->file('image');
            $filename  = uniqid() . $image->getClientOriginalName();
            $path = public_path('images/product_photos/' . $filename);
            Image::make($image->getRealPath())->resize(150, 150)->save($path);
            $input['image'] = $filename;
        } 

        $product->update($input);
        Session::flash('success-msg', 'Product Edited Successfully');
        return redirect()->route('product-list');

    }

    public function getExcelReportProducts() 
    {
        

        $products = DB::table('products')
                    ->join('product_category', 'product_category.id', '=', 'products.category_id')
                    ->join('product_subcategory', 'product_subcategory.id', '=', 'products.subcategory_id')
                    ->select('product_code', 'product_name', 'products.description', 'sales_price', 'category_name', 'subcategory_name')
                    ->get();
        
        if(!$products)
        {
            Session::flash('error-msg', 'No Products Available');
            return redirect()->back();
        }
                
       Excel::create('Product Details', function($excel) use ($products) {
            $excel->sheet('Product sheet', function($sheet) use ($products)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Product Code');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Name');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Description');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Sales Price');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Category');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('Sub Category');   });
                if (!empty($products)) {
                    foreach ($products as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->product_code); 
                        $sheet->cell('B'.$i, $value->product_name); 
                        $sheet->cell('C'.$i, $value->description); 
                        $sheet->cell('D'.$i, $value->sales_price); 
                        $sheet->cell('E'.$i, $value->category_name); 
                        $sheet->cell('F'.$i, $value->subcategory_name); 
                    }
                }
            });
        })->download();

        
    }
   
}
