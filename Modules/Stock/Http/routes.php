<?php

Route::group(['middleware' => ['web', 'AuthCheck','Permission'], 'prefix' => 'stock', 'namespace' => 'Modules\Stock\Http\Controllers'], function()
{
    Route::get('list-stock', [
    	'as' => 'list-stock', 
    	'uses' => 'StockController@getList', 
    	'module' => 'Stock', 
        'permission_type' => 'can_view'
    	]);

    Route::get('excel-report-stock', [
    	'as' => 'excel-report-stock', 
    	'uses' => 'StockController@getStockExcel',
        'module' => 'Stock', 
        'permission_type' => 'can_generate_excel'
    	]);
});
