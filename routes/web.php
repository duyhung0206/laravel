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
//use App\User;
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    /*Manage customer*/
    Route::get('customer/listcustomers', 'CustomerController@index')->name('customer');
    Route::get('customer/pagecreate', function (){
        return view('customer.create');
    })->name('page_create_customer');
    Route::post('customer/create', 'CustomerController@create')->name('create_customer');
    Route::get('customer/delete/{id}', 'CustomerController@delete')->name('delete_customer');
    Route::get('customer/pageedit/{id}', 'CustomerController@pageedit')->name('edit_customer');
    Route::post('customer/edit', 'CustomerController@edit')->name('edit_customer');



    /*Manage supplier*/
    Route::get('supplier/listsuppliers', 'SupplierController@index')->name('supplier');
    Route::get('supplier/pagecreate', function (){
        return view('supplier.create');
    })->name('page_create_supplier');
    Route::post('supplier/create', 'SupplierController@create')->name('create_supplier');
    Route::get('supplier/delete/{id}', 'SupplierController@delete')->name('delete_supplier');
    Route::get('supplier/pageedit/{id}', 'SupplierController@pageedit')->name('edit_supplier');
    Route::post('supplier/edit', 'SupplierController@edit')->name('edit_supplier');

    /*Manage product*/
    Route::get('product/listproducts', 'ProductController@index')->name('product');
    Route::get('product/pagecreate', 'ProductController@pagecreate')->name('page_create_product');
    Route::post('product/create', 'ProductController@create')->name('create_product');
    Route::get('product/delete/{id}', 'ProductController@delete')->name('delete_product');
    Route::get('product/pageedit/{id}', 'ProductController@pageedit')->name('edit_product');
    Route::post('product/edit', 'ProductController@edit')->name('edit_product');

    /*Manage order*/
    Route::get('order/pagecreateorder', 'OrderController@pagecreate')->name('page_create_order');
    Route::post('order/create', 'OrderController@create')->name('create_order');
    /*Setting*/
    Route::get('setting/{type?}', 'SettingController@index')->name('setting');
});
