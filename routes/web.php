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
//链接前面必须加上admin  http://www.blog.gd/admin
//Route::group(['prefix'=>'admin'],function (){
//    Route::get('/', 'IndexController@home')->name('home');
//
//});
Route::get('/', 'IndexController@home')->name('home');

Route::resource('user','UserController');

Route::get('logout','LoginController@logout')->name('logout');
Route::get('login',"LoginController@login")->name('login');
Route::post('login',"LoginController@store")->name('login');

Route::get('confirmEmail_token/{token}',"UserController@confirmEmail_token")->name('confirmEmail_token');

Route::get('follow/{user}','UserController@follow')->name('user.follow');

//重置密码
Route::get('FindPasswordEmail','PasswordController@email')->name('FindPasswordEmail');
Route::post('FindPasswordSend','PasswordController@send')->name('FindPasswordSend');
Route::get('FindPasswordEdit/{token}','PasswordController@edit')->name('FindPasswordEdit');
Route::post('FindPasswordUpdate','PasswordController@update')->name('FindPasswordUpdate');



//博客路由

Route::resource('blog','BlogController');