<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController

//Sales

Route::group(['middleware' => ['web','AuthCheck', 'Permission'], 'prefix' => 'report/sales/', 'namespace' => 'Modules\Report\Http\Controllers'], function()
{
    Route::get('sales-report', [
    	'as' => 'sales-report', 
    	'uses' => 'ReportController@getSalesReport', 
    	'module' => 'Report', 
        'permission_type' => 'can_view_sales_report'
    	]);

   

});



//Purchase

Route::group(['middleware' => ['web', 'AuthCheck', 'Permission'], 'prefix' => 'report/purchase/', 'namespace' => 'Modules\Report\Http\Controllers'], function()
{

	Route::get('purchase-report', [
		'as' => 'purchase-report', 
		'uses' => 'ReportController@getPurchaseReport',
		'module' => 'Report', 
        'permission_type' => 'can_view_purchase_report',
		]);
    

});


//Dues

Route::group(['middleware' => ['web', 'AuthCheck', 'Permission'], 'prefix' => 'report/dues/', 'namespace' => 'Modules\Report\Http\Controllers'], function()
{

    Route::get('dues-report', [
        'as' => 'dues-report', 
        'uses' => 'ReportController@getDuesReport',
        'module' => 'Report', 
        'permission_type' => 'can_view_dues_report',
        ]);
    

});