<?php
//Ajax routes defined in routes/web.php and controller in App\Http\Controller\AjaxController

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'purchase', 'namespace' => 'Modules\Purchase\Http\Controllers'], function()
{
    //GET ROUTES

    Route::get('add-purchase', [
    	'as' => 'add-purchase', 
    	'uses' => 'PurchaseController@getCreatePurchase', 
        'module' => 'Purchase', 
        'permission_type' => 'can_make_purchase'
    	]);

    
    //POST ROUTES
    Route::post('ajax-purchase-products-post', [
    	'as' => 'ajax-purchase-products-post', 
    	'uses' => 'PurchaseController@postPurchaseProducts', 
        'module' => 'Purchase', 
        'permission_type' => 'can_make_purchase'
    	]);

   
});

Route::group(['middleware' => ['web', 'AuthCheck','Permission'], 'prefix' => 'purchase/payment', 'namespace' => 'Modules\Purchase\Http\Controllers'], function()
{
    
    //GET ROUTES

    Route::get('payment-list', [
        'as' => 'payment-list', 
        'uses' => 'PaymentController@getPaymentList', 
        'module' => 'Purchase', 
        'permission_type' => 'can_view_payment'
        ]);

    Route::get('view-payment-invoice/{invoice_number}', [
        'as' => 'view-payment-invoice', 
        'uses' => 'PaymentController@getViewPaymentFromInvoice', 
        'module' => 'Purchase', 
        'permission_type' => 'can_view_payment_invoice'
        ]);


    Route::get('create-payment/{id}', [
        'as' => 'create-payment', 
        'uses' => 'PaymentController@getCreatePayment', 
        'module' => 'Purchase', 
        'permission_type' => 'can_create_payment'
        ]);


    Route::get('print-invoice-for-payment/{invoice_number}', [
        'as' => 'print-invoice-for-payment', 
        'uses' => 'PaymentController@getInvoicePrintforPayment', 
        'module' => 'Purchase', 
        'permission_type' => 'can_print_invoice'
        ]);


    Route::get('clear-purchase-dues/{invoice_number}', [
        'as' => 'clear-purchase-dues',
        'uses' => 'PaymentController@getPaymentClearDues', 
        'module' => 'Purchase', 
        'permission_type' => 'can_clear_dues'
        ]);

    Route::get('delete-purchase-payment-invoice/{invoice_number}', [
        'as' => 'delete-purchase-payment-invoice', 
        'uses' => 'PaymentController@getDeletePurchasePaymentInvoice', 
        'module' => 'Purchase', 
        'permission_type' => 'can_delete_invoice'
        ]);


    Route::get('payment-invoice-report-excel', [
        'as' => 'payment-invoice-report-excel', 
        'uses' => 'PaymentController@getPaymentExcelReport', 
        'module' => 'Purchase', 
        'permission_type' => 'can_generate_excel'
        ]);

    //POST ROUTES

    Route::post('create-payment-post/{invoice_number}', [
        'as' => 'create-payment-post', 
        'uses' => 'PaymentController@postCreatePayment', 
        'module' => 'Purchase', 
        'permission_type' => 'can_create_payment'
        ]);

    Route::post('clear-dues-post/{invoice_number}', [
        'as' => 'clear-dues-post', 
        'uses' => 'PaymentController@postPaymentClearDues', 
        'module' => 'Purchase', 
        'permission_type' => 'can_clear_dues'
        ]);
   
});



