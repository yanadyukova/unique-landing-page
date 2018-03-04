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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware'=>'web'], function () {

    Route::match(['get', 'post'], '/', 'IndexController@execute')->name('home');
    Route::get('/page/{alias}', 'PageController@execute')->name('page');

    Route::auth();
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function () {

    Route::get('/', function () {

    });

    Route::group(['prefix'=>'pages'], function () {

        Route::get('/', 'PagesController@execute')->name('pages');
        Route::match(['get', 'post'], '/add', 'PagesAddController@execute')->name('pagesAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{page}', 'PagesEditController@execute')->name('pagesEdit');
    });

    Route::group(['prefix'=>'portfolio'], function () {

        Route::get('/', 'PortfolioController@execute')->name('portfolio');
        Route::match(['get', 'post'], '/add', 'PortfolioAddController@execute')->name('portfolioAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{page}', 'PortfolioEditController@execute')->name('portfolioEdit');
    });

    Route::group(['prefix'=>'services'], function () {

        Route::get('/', 'ServiceController@execute')->name('services');
        Route::match(['get', 'post'], '/add', 'ServiceAddController@execute')->name('serviceAdd');
        Route::match(['get', 'post', 'delete'], '/edit/{page}', 'ServiceEditController@execute')->name('serviceEdit');
    });
});
