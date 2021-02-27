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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
//start Coins routs
        Route::get('/content/Coins', 'CoinsController@index');
        Route::get('/content/Coins/{code}', 'CoinsController@showCoin');

        Route::get('/api/Coins/getInfo', 'CoinsController@getInfo');
        Route::get('/api/Coins/getList', 'CoinsController@getList');
//end Coins routs

//start Resources routs
        Route::get('/content/{type}/{code}', 'Admin\ResourceController@showResource');

        Route::get( '/dashboard/editResource/{type}/{id}', 'Admin\DashboardController@showResourceAdmin');
        Route::get('/content/{type}', 'Admin\ResourceController@showType');
        Route::get('/dashboard/resourceList/{type}', 'Admin\DashboardController@showTypeAdmin');
        Route::get('/api/content/{type}/getList', 'Admin\ResourceController@getType');
        Route::post('/dashboard/updateResource', 'Admin\DashboardController@update')->name('saveResource');
        Route::post('/dashboard/deleteResource', 'Admin\DashboardController@remove')->name('deleteResource');
//end Resources routs

        Route::get('/getHistory/{currency1}-{currency2}', 'Admin\CryptoCompareController@getHistory');
        Route::get('/dashboard', 'Admin\MenuController@index')->name('dashboard');
        Route::get('/dashboard/editMenu', 'Admin\MenuController@index');
        Route::match(['get','head','post'],'/dashboard/updateMenu', 'Admin\MenuController@update')->name('updateMenu');
        Route::match(['get','head','post'],'/dashboard/removeMenu', 'Admin\MenuController@remove')->name('deleteMenu');
        Route::match(['get','head','post'],'/dashboard/addMenu', 'Admin\MenuController@add')->name('addMenu');

        Route::get('/getCoinList', 'Admin\CryptoCompareController@getCoinList');
        Route::get('/getPriceList', 'Admin\CryptoCompareController@getPriceList');

        Route::get('/', function () { return view('welcome');});

        Auth::routes();

        Route::get('/getCourse', 'Admin\CryptoCompareController@getCourse');

        Route::apiResource('/reviews', 'Admin\ReviewsController');

    });



