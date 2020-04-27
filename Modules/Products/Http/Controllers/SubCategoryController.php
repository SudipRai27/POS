<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\Products\Entities\SubCategory;
use Modules\Products\Entities\Category;
use DB;
use Illuminate\Support\Facades\Input;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
   	public function getListSubCategory()
   	{
   		$subcategory = SubCategory::orderBy('created_at', 'DESC')->paginate(6);
   		return view('products::sub-category.list')->with('subcategory', $subcategory);
   	}

   	public function getCreateSubCategory()
   	{
   		$category = Category::pluck('category_name','id');
   		return view('products::sub-category.create')->with('category', $category);
   	}	

   	public function postCreateSubCategory(Request $request)
   	{
   		$request->validate([
   			'subcategory_name' => 'required'
   			
   			]);

   		$input = request()->all();
   		if(!$input['category_id'])
   		{
   			Session::flash('error-msg', 'Please select category name');
   			return redirect()->back()->withInput($request->input());
   		}
   		SubCategory::create($input);
   		Session::flash('success-msg','Category Created Successfully');
   		return redirect()->back();
   		
   	}

   	public function getEditSubCategory($id)
   	{
   		$subcategory = SubCategory::findorFail($id);
   		$category = Category::pluck('category_name','id');
   		return view('products::sub-category.edit')->with('subcategory', $subcategory)
   												  ->with('category', $category);
   	}	

   	public function postEditSubCategory(Request $request, $id)
   	{
   		$request->validate([
   			'subcategory_name' => 'required'
   			
   			]);

   		$input = request()->all();
   		if(!$input['category_id'])
   		{
   			Session::flash('error-msg', 'Please select category name');
   			return redirect()->back()->withInput($request->input());
   		}
   		$subcategory = SubCategory::findorFail($id);
   		$subcategory->update($input);
   		Session::flash('success-msg', 'Sub Category Updated Successfully');
   		return redirect()->route('sub-category-list');
   	}

   	public function postDeleteSubCategory(Request $request, $id)
   	{
   		$subcategory = SubCategory::findorFail($id);
   		$subcategory->delete();
   		Session::flash('success-msg', 'Sub Category Deleted Successfully');
   		return redirect()->back();
   	}
}

