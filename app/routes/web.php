<?php

use App\Http\Controllers\PostController;


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


Auth::routes();

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset');


//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', 'PostController');
    Route::resource('users', 'UserController', ['only' => ['index', 'edit', 'update', 'show', 'destroy']]);
    Route::resource('admins', 'AdminController', ['only' => ['index',  'show', 'destroy']]);


    Route::get('/', 'PostController@index')->name('posts.index');
    Route::get('/like', 'UserController@likeIndex')->name('users.like');

    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('ajaxlike', 'PostController@ajaxlike')->name('posts.ajaxlike');
    });