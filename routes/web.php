<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\checkUserController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function() {

    Route::get('/admin', 'adminController@index')->name('admin');
    Route::get('/user-list', 'adminController@userList')->name('userList');
    Route::get('/user/{id}', 'adminController@show')->name('profile');
    Route::put('/user/{id}', 'adminController@update')->name('update-profile');
    Route::get('/user/{id}/{status}', 'adminController@isBlockFromProfile')->name('isBlockFromProfile');
    Route::get('/pending-user', 'adminController@pendingUser')->name('pendingUser');
    Route::get('/user-list/{id}/{status}', 'adminController@isBlock')->name('block');
    Route::get('/pending-user/{id}/{status}', 'adminController@isApprove')->name('approve');
    Route::delete('/user-list/{id}', 'adminController@destroy')->name('deleteUser');

});

Route::group(['prefix' => '/'], function() {

    Route::get('user', 'userController@index')->name('user');
    Route::get('/police', 'userController@police')->name('police');
    Route::get('/ambulance', 'userController@ambulance')->name('ambulance');
    Route::get('/fire-fighter', 'userController@firefighter')->name('firefighter');
    Route::get('/sos', 'userController@sos')->name('sos');

});

Route::get('/logout', function() {

    Session::flush();
    Auth::logout();
    return redirect('/');
})->name('logout');
