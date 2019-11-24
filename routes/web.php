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

Auth::routes();

$this->get('login', function (){
    return view('auth.login', [
        'is_admin' => 1,
    ]);
});
$this->post('login', 'StaffController@authenticate');
$this->any('forget/index/{is_admin}', 'ForgetController@index');
$this->any('forget/email', 'ForgetController@forget');
$this->any('forget/email/{token}', 'ForgetController@reset');
$this->any('forget/set', 'ForgetController@set');

$this->any('reset', 'StaffController@reset');
$this->any('staffreset', 'UserController@reset');

$this->get('stafflogin', function (){
    return view('auth.login', [
        'is_admin' => 0,
    ]);
});
$this->post('stafflogin', 'UserController@staffauthenticate');
$this->any('stafflogout', 'UserController@logout');
$this->any('logout', 'StaffController@logout')->name('logout');

//Route::any('info/index', 'StaffController@index')->middleware('auth');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'StaffController@createstaff');

// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');

//Route::get('/home', 'HomeController@index')->name('home');

Route::any('/staff/testindex/{id}', 'UserController@index');

//Route::any('/create', 'UserController@create');