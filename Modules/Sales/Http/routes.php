<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController
Route::group(['middleware' => ['web','AuthCheck', 'Permission'], 'prefix' => 'sales', 'namespace' => 'Modules\Sales\Http\Controllers'], function()
{
    Route::get('make-sales', [
    	'as' => 'make-sales', 
    	'uses' => 'SalesController@getCreateSales', 
        'module' => 'Sales', 
        'permission_type' => 'can_make_sales'
    	]);


    Route::get('sales-list', [
        'as' => 'sales-list', 
        'uses' => 'SalesController@getSalesList', 
        'module' => 'Sales', 
        'permission_type' => 'can_view_sales'
        ]);


    Route::post('ajax-make-quick-sales', [
    	'as' => 'ajax-make-quick-sales', 
    	'uses' => 'SalesController@postMakeQuickSales', 
        'module' => 'Sales', 
        'permission_type' => 'can_make_sales'
    	]);

    //This route is called immediately after sales is made
    Route::get('print-sales', [
    	'as' => 'print-sales', 
    	'uses' => 'SalesController@getPrintSales', 
        'module' => 'Sales', 
        'permission_type' => 'can_make_sales'
    	]);


    Route::get('view-sales-invoice/{invoice_number}', [
        'as' => 'view-sales-invoice', 
        'uses' => 'SalesController@getViewSalesInvoice', 
        'module' => 'Sales', 
        'permission_type' => 'can_view_invoice'
        ]);

    Route::get('print-sales-invoice/{invoice_number}', [
        'as' => 'print-sales-invoice', 
        'uses' => 'SalesController@getPrintSalesInvoice', 
        'module' => 'Sales', 
        'permission_type' => 'can_print_invoice'
        ]);

    Route::get('delete-sales-invoice/{invoice_number}', [
        'as' => 'delete-sales-invoice', 
        'uses' => 'SalesController@getDeleteSalesInvoice', 
        'module' => 'Sales', 
        'permission_type' => 'can_delete_invoice'
        ]);

    Route::get('sales-report-excel', [
        'as' => 'sales-report-excel', 
        'uses' => 'SalesController@getSalesExcelReport', 
        'module' => 'Sales', 
        'permission_type' => 'can_generate_excel'
        ]);
});
