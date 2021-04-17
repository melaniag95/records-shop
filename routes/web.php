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

Route::prefix('/admin')->namespace('Admin')->group(function(){
    //rotte admin:
    Route::match(['get', 'post'],'/', 'AdminController@login'); //match = get+post
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword');
        Route::match(['get', 'post'],'update-admin-details', 'AdminController@updateAdminDetails');
        Route::get('logout', 'AdminController@logout');

        //CRUD actions: 
        Route::get('record-detail/{id}', 'AdminController@getRecordById');

        Route::get('record-edit/{id}', 'AdminController@editRecord');
        Route::post('record-edit/{id}', 'AdminController@saveRecord');

        Route::get('delete/{id}', 'AdminController@deleteRecord');

        Route::get('add', 'AdminController@add');
        Route::post('add', 'AdminController@addRecord');
    });
});

//Home page
Route::get('/', 'RecordsController@home');

//Lista records
Route::get('/records', 'RecordsController@allRecords');

//Dettaglio records
Route::get('/dettaglio/{id}', 'RecordsController@dettaglioRecord');

//Browse by category
Route::get('/genre/{id}', 'RecordsController@viewCategory');

//Shopping Cart
Route::get('/cart', 'RecordsController@shoppingCart');

//Add to cart
Route::post('/add-to-cart', 'RecordsController@addToCart');

//Update items in shopping cart
Route::post('/update-cart-item-quantity', 'RecordsController@updateCartItemQuantity');

//Delete item from shopping Cart
Route::post('/delete-cart-item-quantity', 'RecordsController@deleteCartItem');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
