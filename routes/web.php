<?php
// command =php artisan = show everything and add topic --help for details
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


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');



// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');



$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');



$this->get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
$this->get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
$this->get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/my-tokens', 'HomeController@getTokens')->name('personal-tokens');

Route::get('/', function(){
     return view('welcome');
})->middleware('guest');
