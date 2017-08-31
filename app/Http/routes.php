<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

   
    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
});


Route::group(['middleware' => ['web','admin.login']], function () {
    Route::any('admin/index', 'Admin\IndexController@index');
    Route::any('admin/info', 'Admin\IndexController@info');
    Route::any('admin/quit', 'Admin\LoginController@quit');
    Route::any('admin/pass','Admin\IndexController@pass');
    Route::resource('admin/category','Admin\CategoryController');
    Route::post('admin/cate/changeorder','Admin\CategoryController@changeorder');
    Route::resource('admin/article','Admin\articleController');
    Route::any('admin/upload','Admin\CommonController@upload');
    Route::resource('admin/links','Admin\linksController');
    Route::resource('admin/navs','Admin\navsController');
    Route::resource('admin/config','Admin\configController');
    Route::post('admin/config/changecontent','Admin\configController@changecontent');
    Rout::post('admin/users/add','Adim\userscontroller@add');
});
