<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('client.index');
	
});

Route::group(array('prefix' => 'admin'), function() {

    Route::get('/', function() {
        return View::make('client.login');
    });

});

 Route::group(array('before' => 'auth.admin'), function() {

        Route::get('/admin', function() {
            return View::make('admin.pages.index');
        });
        
 });
 
 
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@user_logout'));
//Route::get('/admin', array('as' => 'admin_login', 'uses' => 'AdminindexController@index'));
Route::get('/register', array('as' => 'register', 'uses' => 'UserController@register'));
Route::get('/index', array('as' => 'index', 'uses' => 'IndexController@index'));
Route::post('/save_user', array('as' => 'save_user', 'uses' => 'UserController@save_user'));
Route::post('/user_login', array('as' => 'user_login', 'uses' => 'UserController@user_login'));


//Route::get('/admin_login', array('as' => 'index', 'uses' => 'AdminController@index'));
