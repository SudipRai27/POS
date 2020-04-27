<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController

Route::group(['middleware' => ['web', 'AuthCheck', 'Permission'], 'prefix' => 'products', 'namespace' => 'Modules\Products\Http\Controllers'], function()
{

	//GET ROUTES

    Route::get('product-list', [
    	'as' => 'product-list', 
    	'uses' => 'ProductsController@getListProduct',
        'module' => 'Products', 
        'permission_type' => 'can_view_product',
    	]);

    Route::get('add-product', [
    	'as' => 'add-product', 
    	'uses' => 'ProductsController@getCreateProduct',
        'module' => 'Products', 
        'permission_type' => 'can_create_product',
    	]);  

    Route::get('product-view/{id}', [
    	'as' => 'product-view', 
    	'uses' => 'ProductsController@getViewProduct', 
        'module' => 'Products', 
        'permission_type' => 'can_view_product',
    	]);

    Route::get('product-delete/{id}', [
    	'as' => 'product-delete', 
    	'uses' => 'ProductsController@getProductDelete', 
        'module' => 'Products', 
        'permission_type' => 'can_delete_product',
    	]);	

    Route::get('product-edit/{id}', [
    	'as' => 'product-edit', 
    	'uses' => 'ProductsController@getProductEdit', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_product',
    	]);

    Route::get('excel-report-products', [
        'as' => 'excel-report-products', 
        'uses' => 'ProductsController@getExcelReportProducts', 
        'module' => 'Products', 
        'permission_type' => 'can_generate_product_excel',
        ]);

    //POST ROUTES

     Route::post('add-product-post', [
    	'as' => 'add-product-post' , 
    	'uses' => 'ProductsController@postCreateProduct', 
        'module' => 'Products', 
        'permission_type' => 'can_create_product',
    	]);

     Route::post('product-edit-post/{id}', [
     	'as' => 'product-edit-post', 
     	'uses' => 'ProductsController@postEditProduct', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_product',
     	]);

});




Route::group(['middleware' => ['web', 'Permission'], 'prefix' => 'category', 'namespace' => 'Modules\Products\Http\Controllers'], function()
{

	//GET ROUTES

    Route::get('category-list', [
    	'as' => 'category-list', 
    	'uses' => 'CategoryController@getListCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_view_category',
    	]);


    Route::get('add-category', [
    	'as' => 'add-category', 
    	'uses' => 'CategoryController@getCreateCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_create_category',
    	]);

    Route::get('edit-category/{id}', [
    	'as' => 'edit-category', 
    	'uses' => 'CategoryController@getEditCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_category',
    	]);

    //POST ROUTES

    Route::post('add-category-post', [
    	'as' => 'add-category-post', 
    	'uses' => 'CategoryController@postCreateCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_create_category',
    	]);

    Route::post('edit-category-post/{id}', [
    	'as' => 'edit-category-post', 
    	'uses' => 'CategoryController@postEditCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_category',
    	]);

    Route::post('delete-modal-post/{id}', [
    	'as' => 'delete-modal-post', 
    	'uses' => 'CategoryController@postDeleteCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_delete_category',
    	]);

    
});


Route::group(['middleware' => ['web', 'Permission'], 'prefix' => 'sub-category', 'namespace' => 'Modules\Products\Http\Controllers'], function()
{

	//GET ROUTES

    Route::get('sub-category-list', [
    	'as' => 'sub-category-list', 
    	'uses' => 'SubCategoryController@getListSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_view_subcategory',
    	]);

    Route::get('add-sub-category', [
    	'as' => 'add-sub-category', 
    	'uses' => 'SubCategoryController@getCreateSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_create_subcategory',
    	]);

    Route::get('edit-sub-category/{id}', [
    	'as' => 'edit-sub-category', 	
    	'uses' => 'SubCategoryController@getEditSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_subcategory',
    	]);

    //POST ROUTES

    Route::post('add-sub-category-post', [
    	'as' => 'add-sub-category-post', 
    	'uses' => 'SubCategoryController@postCreateSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_create_subcategory',
    	]);


    Route::post('edit-sub-category-post/{id}', [
    	'as' => 'edit-sub-category-post', 
    	'uses' => 'SubCategoryController@postEditSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_edit_subcategory',
    	]);

    Route::post('delete-sub-category-post/{id}', [
    	'as' => 'delete-sub-category-post', 
    	'uses' => 'SubCategoryController@postDeleteSubCategory', 
        'module' => 'Products', 
        'permission_type' => 'can_delete_subcategory',
    	]);

    
});



