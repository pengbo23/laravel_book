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

Route::get('/', function () {
    return view('welcome');
});

/**
 *  public function auth()
 * {
 * // Authentication Routes...
 * $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
 * $this->post('login', 'Auth\LoginController@login');
 * $this->post('logout', 'Auth\LoginController@logout')->name('logout');
 *
 * // Registration Routes...
 * $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
 * $this->post('register', 'Auth\RegisterController@register');
 *
 * // Password Reset Routes...
 * $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
 * $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 * $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
 * $this->post('password/reset', 'Auth\ResetPasswordController@reset');
 * }
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'TestController@index')->name('test');

//backend  后台模块url

Route::get('backendLogin', 'BackendLoginController@index')->name('backendLogin');
Route::get('backendLoginCaptcha', 'BackendLoginController@createCaptcha')->name('backendLoginCaptcha');
Route::post('backendSignIn', 'BackendLoginController@signIn');
Route::get('backendLogout', 'BackendLoginController@logout')->name('backendLogout');
Route::namespace('Backend')->prefix('backend')->middleware('backend')->group(function () {

    Route::get('index', 'IndexController@index')->name('backend.index');

    Route::get('book', 'BookController@index')->name('book');
    Route::get('book/add', 'BookController@add')->name('book.add');
    Route::post('book/add', 'BookController@addOp');
    Route::get('book/edit/{id}','BookController@edit')->name('book.edit');
    Route::post('book/update','BookController@update')->name('book.update');
    Route::post('book/delete','BookController@delete')->name('book.delete');
    Route::get('getBook', 'BookController@getBook')->name('getBook');

    Route::get('book/tag', 'BookTagController@index')->name('book.tag');
    Route::get('bookTag/add', 'BookTagController@add')->name('bookTag.add');
    Route::post('bookTag/add', 'BookTagController@addOp');
    Route::get('getBookTag', 'BookTagController@getBookTag');
    Route::get('bookTag/edit/{id}','BookTagController@edit')->name('bookTag.edit');
   // Route::get('getBookTag', 'BookTagController@getBookTag');
});



