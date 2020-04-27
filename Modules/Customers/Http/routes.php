<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController
Route::group(['middleware' => ['web','AuthCheck'], 'prefix' => 'customers', 'namespace' => 'Modules\Customers\Http\Controllers'], function()
{	
	//GET ROUTES
    Route::get('customer-list', [
    	'as' => 'customer-list', 
    	'uses' => 'CustomersController@getListView'
    	]);

    Route::get('add-customers', [
    	'as' => 'add-customers', 
    	'uses' => 'CustomersController@getCreateCustomers'
    	]);

    Route::get('view-customers/{id}', [
    	'as' => 'view-customers', 
    	'uses' => 'CustomersController@getViewCustomers'
    	]);

    Route::get('edit-customers/{id}', [
    	'as' => 'edit-customers', 
    	'uses' => 'CustomersController@getEditCustomers'
    	]);

    //POST ROUTES

    Route::post('add-customer-post', [
    	'as' => 'add-customer-post', 
    	'uses' => 'CustomersController@postCreateCustomers'
    	]);

    Route::post('customer-edit-post/{id}', [
    	'as' => 'customer-edit-post', 
    	'uses' => 'CustomersController@postEditCustomers'
    	]);

    Route::post('delete-customers-post/{id}', [
    	'as' => 'delete-customers-post', 
    	'uses' => 'CustomersController@postDeleteCustomers'
    	]);
});
