<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Customers;
use Session;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getListView()
    {
        $customers = Customers::orderBy('created_at', 'DESC')->paginate(10);
        return view('customers::list')->with('customers', $customers);
    }

    public function getCreateCustomers()
    {
        return view('customers::create');
    }

    public function postCreateCustomers(Request $request)
    {
        $request->validate([
            'customer_code' => 'required|unique:customers,customer_code', 
            'customer_name' => 'required', 
            'address'       => 'required'
            ]);

        $input = request()->all();
        $customers = Customers::create($input);
        Session::flash('success-msg', 'Customers Created Successfully'); 
        return redirect()->back();
    }

    public function getViewCustomers($id)
    {
        $customer = Customers::findorFail($id);
        return view('customers::view')->with('customer', $customer);
    }

    public function getEditCustomers($id)
    {
        $customer = Customers::findorFail($id);
        return view('customers::edit')->with('customer', $customer);
    }

    public function postEditCustomers(Request $request, $id)
    {
        $request->validate([
            'customer_code' => 'required|unique:customers,customer_code,'.$id, 
            'customer_name' => 'required', 
            'address'       => 'required'
            ]);   
        $input = request()->all();
        $customer = Customers::findorFail($id);
        $customer->update($input);
        Session::flash('success-msg', 'Customer Updated Successfully');
        return redirect()->route('customer-list');
    }

    public function postDeleteCustomers(Request $request, $id)
    {
        $customer = Customers::findorFail($id); 
        $customer->delete();
        Session::flash('success-msg', 'Customer Deleted Successfully'); 
        return redirect()->back();
    }
}
