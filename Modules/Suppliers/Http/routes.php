<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController

Route::group(['middleware' => ['web', 'AuthCheck','Permission'], 'prefix' => 'suppliers', 'namespace' => 'Modules\Suppliers\Http\Controllers'], function()
{
   //GET ROUTES

	Route::get('supplier-list', [
		'as' => 'supplier-list',
		'uses' => 'SuppliersController@getListSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_view',
		]);

	Route::get('add-suppliers', [
		'as' => 'add-suppliers',
		'uses' => 'SuppliersController@getCreateSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_create',
		]);

	Route::get('view-suppliers/{id}', [
		'as' => 'view-suppliers', 
		'uses' => 'SuppliersController@getViewSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_view',
		]);

	Route::get('edit-supplier/{id}', [
		'as' => 'edit-supplier', 
		'uses' => 'SuppliersController@getEditSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_edit',
		]);

	Route::get('suppliers-report-excel', [
		'as' => 'suppliers-report-excel', 
		'uses' => 'SuppliersController@getSuppliersExcel', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_generate_excel'
		]);

	//POST ROUTES

	Route::post('add-supplier-post', [
		'as' => 'add-supplier-post', 
		'uses' => 'SuppliersController@postCreateSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_create',
		]);

	Route::post('supplier-edit-post/{id}', [
		'as' => 'supplier-edit-post', 
		'uses' => 'SuppliersController@postEditSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_edit',
		]);

	Route::post('delete-suppliers-post/{id}', [
		'as' => 'delete-suppliers-post', 
		'uses' => 'SuppliersController@postDeleteSuppliers', 
		'module' => 'Suppliers', 
        'permission_type' => 'can_delete',
		]);
});

