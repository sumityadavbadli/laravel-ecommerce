<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');



Route::group(['namespace' => 'admin'], function() {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

/* ======================= Category Routes ======================================= */
Route::get('create-categories','CategoryManagement@showInsertView');    
Route::post('createCategory','CategoryManagement@insert');
    
Route::get('edit-categories','CategoryManagement@showEditView');
Route::get('edit-this-categories/{id}','CategoryManagement@showEditViewWithData');    

Route::post('updateCategory','CategoryManagement@update');
Route::get('delete-this-categories/{id}','CategoryManagement@delete');  

/* ======================= Product Routes ======================================= */    
Route::get('create-products','productManagement@showInsertView');
Route::post('createProducts','productManagement@insert');

Route::get('edit-products','productManagement@showEditView'); 
Route::get('edit-this-product/{id}','productManagement@showEditViewWithData');
    
Route::post('updateProduct','productManagement@update');
Route::get('delete-this-product/{id}','productManagement@delete');
    
/* ===================== Special Product Routes =============================== */

Route::get('add-special-products','specialProductManagement@showData');
Route::get('add-this-product/{id}','specialProductManagement@add');
Route::get('delete-this-specialProduct/{id}','specialProductManagement@delete');

/* ===================== Popular Product Routes =============================== */

Route::get('add-popular-products','popularProductManagement@showData');
Route::get('add-popular-product/{id}','popularProductManagement@add');
Route::get('delete-this-popularProduct/{id}','popularProductManagement@delete');    
    
    
});