<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/remove-global/{type}', array(
	'as'	=>	'remove-global',
	'uses'	=>	'HelperController@removeGlobal'));

Route::get('login-option-page', [
	'as' => 'login-option-page', 
	'uses' => 'Controller@getLoginOptionPage'
	]);

//AJAX ROUTES


Route::get('ajax-get-subcategory-id-from-category-id', [
	'as' => 'ajax-get-subcategory-id-from-category-id', 
	'uses' => 'AjaxController@getAjaxgetSubCategoryIdfromCategoryId'
	]);

Route::get('ajax-get-products-list-from-category-id-and-sub-category-id', [
    'as' => 'ajax-get-products-list-from-category-id-and-sub-category-id', 
    'uses' => 'AjaxController@getAjaxProductsListFromCategoryIdSubCategoryId'
    ]);


Route::get('ajax-get-table-search',[
	'as' => 'ajax-get-table-search', 
	'uses' => 'AjaxController@getSearchValuesfromSearchFields'
	]);

Route::get('product-autocomplete', [
	'as' => 'product-autocomplete', 
	'uses' => 'AjaxController@getProductAutoComplete'
	]);


Route::get('get-selling-price-from-product-code', [
	'as' => 'get-selling-price-from-product-code', 
	'uses' => 'AjaxController@getSellingPriceFromProductCode'
	]);



Route::get('get-search-results-from-date-for-sales', [
    	'as' => 'get-search-results-from-date-for-sales', 
    	'uses' => 'AjaxController@getAjaxSearchSalesHistory'
    	]);

Route::get('get-search-results-from-date-for-purchase', [
    	'as' => 'get-search-results-from-date-for-purchase', 
    	'uses' => 'AjaxController@getAjaxPurchaseHistory'
    	]);


Route::get('get-search-results-from-date-for-dues', [
		'as'  => 'get-search-results-from-date-for-dues', 
		'uses' => 'AjaxController@getAjaxDuesHistory'
	]);




