<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
            'middleware'=>'auth',
            'namespace'=>'App\Http\Controllers\Admin',
            'prefix'=>'dashboard'
            ], function (){

        Route::resource('category','CategoryController');
        Route::resource('sub_category','SubCategoryController');
        Route::resource('product','ProductController');
        Route::resource('filter','FilterController');
        Route::resource('sub_filter','SubFilterController');

        Route::get('offer/index','AjaxController@create')->name('offer.index');
        Route::get('offer','AjaxController@show')->name('ajax.show');
        Route::post('ajaxstore','AjaxController@store')->name('ajax.store');
        Route::post('ajaxdelete','AjaxController@delete')->name('ajax.delete');
});


Route::group([
            'namespace'     => 'App\Http\Controllers\Customer',
            
            ],function (){

Route::resource('/','HomePageController');
Route::get('shop','HomePageController@Shop_list')->name('shop');

Route::get('shop-cart','HomePageController@Shop_Cart')->name('shop-cart');
Route::get('checkout','HomePageController@Checkout')->name('checkout')->middleware('Customer:customer');

Route::get('shop-details/{id}','HomePageController@Shop_Detail')->name('shop-details');
Route::get('add-cart/{id}','HomePageController@Add_Cart')->name('add-cart');

Route::post('item-add','HomePageController@Item_Add')->name('item-add');
Route::delete('item-delete','HomePageController@Item_Delete')->name('item-delete');


Route::post('get-color','HomePageController@ajaxColor')->name('ajax.get-color');

Route::get('logout_customer/{id}','HomePageController@Logout')->name('page.logout');
Route::get('login_customer','HomePageController@Login_Customer_View')->name('page.login');
Route::post('login_customer','HomePageController@Login_Customer')->name('page.login_customer');
Route::get('register_customer','HomePageController@Register_Customer_View')->name('page.register');
Route::post('register_customer','HomePageController@Register_Customer')->name('page.register_customer');

    /*Route::group(['middleware'=>'Customer:customer'],function (){
        Route::get('shop-cart','HomePageController@Shop_Cart')->name('shop-cart');
    Route::get('checkout','HomePageController@Checkout')->name('checkout')->middleware('Customer:customer');

    });*/

});
