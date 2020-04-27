<?php
namespace Modules\Report\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
   	public function getSalesReport()
   	{
   		return view('report::sales.sales-report');
   	}

   
    public function getPurchaseReport()
    {
      return view('report::purchase.purchase-report');
    }

    public function getDuesReport()
    {
      return view('report::dues.dues-report');
    }
}
