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


//for clear view cache
Artisan::call('view:clear');



//start Coins routs
Route::get('/Coins', 'CoinsController@index');
Route::get('/Coins/{code}', 'CoinsController@showCoin');
Route::get('/api/Coins/getInfo', 'CoinsController@getInfo');
Route::get('/api/Coins/getList', 'CoinsController@getList');
//end Coins routs


//start Resources routs
Route::get('/{type}/{code}', 'Admin\ResourceController@showResource');

//start Resources routs
Route::get('/{code}', 'Admin\ResourceController@showPage');



Route::get( '/dashboard/editResource/{type}/{id}', 'Admin\ResourceController@showResourceAdmin');
Route::get('/content/{type}', 'Admin\ResourceController@showType');
Route::get('/dashboard/resourceList/{type}', 'Admin\ResourceController@showTypeAdmin');
Route::get('/api/content/{type}/getList', 'Admin\ResourceController@getType');
Route::match(['get','head','post'], '/dashboard/updateResource', 'Admin\ResourceController@update');
//end Resources routs



Route::get('/getHistory/{currency1}-{currency2}', 'Admin\CryptoCompareController@getHistory');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/editMenu', 'Admin\MenuController@index');
Route::match(['get','head','post'],'/dashboard/updateMenu', 'Admin\MenuController@update');
Route::match(['get','head','post'],'/dashboard/addMenu', 'Admin\MenuController@add');


Route::get('/streamer', 'Admin\CryptoCompareController@streamer');
Route::get('/getCoinList', 'Admin\CryptoCompareController@getCoinList');
Route::get('/getPriceList', 'Admin\CryptoCompareController@getPriceList');

Route::get('/', function () { return view('welcome');});

Auth::routes();



Route::get('/getCourse', 'Admin\CryptoCompareController@getCourse');

Route::apiResource('/reviews', 'Admin\ReviewsController');
