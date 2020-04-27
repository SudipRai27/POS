<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Suppliers\Entities\Suppliers;
use App\Http\Controllers\HelperController;
use Session;
use Excel;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function getListSuppliers()
    {
        $suppliers = Suppliers::orderBy('created_at', 'DESC')->paginate(10);
        return view('suppliers::list')->with('suppliers', $suppliers);
    }

    public function getCreateSuppliers()
    {
        return view('suppliers::create');
    }

    public function postCreateSuppliers(Request $request)
    {
        $request->validate([
            'supplier_code' => 'required|unique:suppliers,supplier_code', 
            'supplier_name' => 'required', 
            'address' => 'required', 
            'contact_person' => 'required', 
            'phone_no' => 'required'
            ]);
        $input = request()->all();
        Suppliers::create($input);
        Session::flash('success-msg', 'Suppliers Created Successfully'); 
        return redirect()->back();

    }

    public function getViewSuppliers($id)
    {
        $supplier = Suppliers::findorFail($id);
        return view('suppliers::view')->with('supplier', $supplier);
    }

    public function getEditSuppliers($id)
    {
        $supplier = Suppliers::findorFail($id);
        return view('suppliers::edit')->with('supplier', $supplier);
    }

    public function postEditSuppliers(Request $request, $id)
    {
         $request->validate([
            'supplier_code' => 'required|unique:suppliers,supplier_code,'.$id, 
            'supplier_name' => 'required', 
            'address' => 'required', 
            'contact_person' => 'required', 
            'phone_no' => 'required'
            ]);
        $input = request()->all();
        $data = Suppliers::findorFail($id);
        $data->update($input);
        Session::flash('success-msg', 'Supplier Updated Successfully');
        return redirect()->back();
    }

    public function postDeleteSuppliers(Request $request, $id)
    {   
        $supplier = Suppliers::find($id);
        $supplier->delete();
        Session::flash('success-msg', 'Delete Successfully'); 
        return redirect()->back();
    }

    public function getSuppliersExcel()
    {
        $suppliers = Suppliers::all();
        if(!$suppliers)
        {
            Session::flash('error-msg', 'No suppliers available');
            return redirect()->back();
        }

        Excel::create('Suppliers Details', function($excel) use ($suppliers) {
            $excel->sheet('Suppliers sheet', function($sheet) use ($suppliers)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Supplier Code');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Name');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Address');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Contact Person');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Phone');   });
                
                if (!empty($suppliers)) {
                    foreach ($suppliers as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->supplier_code); 
                        $sheet->cell('B'.$i, $value->supplier_name); 
                        $sheet->cell('C'.$i, $value->address); 
                        $sheet->cell('D'.$i, $value->contact_person); 
                        $sheet->cell('E'.$i, $value->phone_no); 
                    }
                }
            });
        })->download();
    }
}
