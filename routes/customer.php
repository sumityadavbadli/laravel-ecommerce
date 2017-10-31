<?php

Route::group(['namespace' => 'customer'], function() {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

/* ======================= Category Routes ======================================= */
    Route::get('home','homeController@showHome');
    
    Route::get('complete-your-profile','completeUserProfile@createView');
    Route::post('complete-your-profile','completeUserProfile@saveToDb');
    
    Route::get('checkout','cartController@checkout');
    Route::get('pending-orders','cartManager@displayCart');
    
    Route::post('userQuantityPlus','cartController@updatePlusQuantity');
    Route::post('userQuantityMinus','cartController@updateMinusQuantity');
    Route::post('userProductDelete','cartController@deleteProductRow');
    
});