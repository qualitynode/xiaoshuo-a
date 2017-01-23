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

$admin = [
    'prefix' => 'admin',
    'namespace' => 'Admin',
    //'middleware'    => 'admin'
];
Route::group($admin , function(){

    //debug
    Route::get('form' , function(){
       return view('admin.form');
    });
    //debug

    Route::get('login' , 'AuthController@getLogin')->name('getAdminLogin');
    Route::post('login' , 'AuthController@postLogin')->name('postAdminLogin');

//    Route::get('register' , 'AuthController@getRegister')->name('getAdminRegister');
//    Route::post('register' , 'AuthController@postRegister')->name('postAdminRegister');
    Route::get('logout' , 'AuthController@getLogout')->name('getAdminLogout');
    Route::any('enterpassword' , 'AuthController@getEnterpassword')->name('getEnterpassword');

    //AdminAuthenticate中间件接管
    Route::group(['middleware' => 'admin'] ,function(){

        Route::get('/' , 'IndexController@getIndex')->name('getAdminIndex');

        Route::controller('manager' , 'ManagerController' , [
            'getIndex'   => 'Manager.getIndex',
            'getCreate'  => 'Manager.getCreate',
            'postCreate' => 'Manager.postCreate',
            'getUpdate'  => 'Manager.getUpdate',
            'postUpdate' => 'Manager.postUpdate',
            'getDelete'  => 'Manager.getDelete',
        ]);
        Route::controller('article' , 'ArticleController' , [
            'getIndex'   => 'Article.getIndex',
            'getCreate'  => 'Article.getCreate',
            'postCreate' => 'Article.postCreate',
            'getUpdate'  => 'Article.getUpdate',
            'postUpdate' => 'Article.postUpdate',
            'getDelete'  => 'Article.getDelete',
            'getCategorys'  => 'Article.getCategorys',
            'getRecycle'  => 'Article.getRecycle',
        ]);
        Route::controller('menu' , 'MenuController' , [
            'getIndex'   => 'Menu.getIndex',
            'getCreate'  => 'Menu.getCreate',
            'postCreate' => 'Menu.postCreate',
            'getUpdate'  => 'Menu.getUpdate',
            'postUpdate' => 'Menu.postUpdate',
            'getDelete'  => 'Menu.getDelete',
        ]);
        Route::controller('database' , 'DatabaseController' , [
            'getIndex'   => 'Database.getIndex',
            'getFields'  => 'Database.getFields',
        ]);
/*        Route::controller('weixin' , 'WeixinController' , [
            'getIndex'   => 'Database.getIndex',
            'getFields'  => 'Database.getFields',
        ]);*/

/*        Route::controllers([
            'article' => 'ArticleController',
            'auth'	  => 'AuthController',
            'menu'    => 'MenuController',
            'manager' => 'ManagerController',
        ]);*/
    });

});

$home = [
    'prefix'    => '/',
    'namespace' => 'Home',
];
Route::group($home , function(){
    Route::controllers([
        'article'   => 'ArticleController',
        '/'         => 'IndexController'
    ]);
});