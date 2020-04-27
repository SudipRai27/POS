<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\Products\Entities\Category;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function getListCategory()
    {
    	$category = Category::orderBy('created_at','DESC')->paginate(6);
    	return view('products::category.list')->with('category', $category);
    }

    public function getCreateCategory()
    {
    	return view('products::category.create');
    }

    public function postCreateCategory(Request $request)
    {
    	$request->validate([
    		'category_name' => 'required', 
    			]);

    	$input = request()->all();
    	Category::create($input);
    	Session::flash('success-msg', 'Category Created Successfully');
    	return redirect()->back();
    }

    public function getEditCategory($id)
    {
    	$category = Category::findorFail($id);
    	return view('products::category.edit')->with('category', $category);
    }

    public function postEditCategory(Request $request, $id)
    {	
    	$request->validate([
    		'category_name' => 'required', 
    			]);

    	$input = request()->all();
    	$category = Category::findorFail($id);
    	$category->update($input);
    	Session::flash('success-msg', 'Category Updated Successfully');
    	return redirect()->route('category-list');

    }

    public function postDeleteCategory(Request $request, $id)
    {
    	$category = Category::findorFail($id);
    	$category->delete();
    	Session::flash('success-msg', 'Category Deleted Successfully');
    	return redirect()->back();
    }
   
}
