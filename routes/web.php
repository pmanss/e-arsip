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

Route::get('/', 'AuthController@getLogin')->middleware('guest');

Route::get('/login','AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login','AuthController@postLogin')->middleware('guest')->name('proses-login');
Route::get('/edit-password','AuthController@editPassword')->middleware('auth')->name('edit-password');
Route::patch('/update-password','AuthController@updatePassword')->middleware('auth')->name('update-password');
Route::get('/logout', 'AuthController@logout')->middleware('auth')->name('logout');

Route::resource('users', 'UserController')->middleware('auth');
Route::get('users/{user}/reset-password', 'UserController@resetPassword')->middleware('auth')->name('users.reset-password');
Route::put('users/{user}', 'UserController@postResetPassword')->middleware('auth')->name('users.post-reset-password');

Route::get('arsips/trash','ArsipController@trash')->middleware('auth')->name('arsips.trash');
Route::get('arsips/{arsip}/restore','ArsipController@restore')->middleware('auth')->name('arsips.restore');
Route::get('arsips/{arsip}/force-delete','ArsipController@forceDelete')->middleware('auth')->name('arsips.force-delete');
Route::get('arsips/empty-trash','ArsipController@emptyTrash')->middleware('auth')->name('arsips.empty-trash');
Route::resource('arsips', 'ArsipController')->middleware('auth');
Route::get('arsips/{arsip}/download','ArsipController@download')->middleware('auth')->name('arsips.download');
Route::get('arsips/{arsip}/{berkas}','ArsipController@showArsipPDF')->middleware('auth')->name('arsips.show-pdf');



Route::get('instansi/edit','InstansiController@edit')->middleware('auth')->name('instansi.edit');
Route::patch('instansi/update','InstansiController@update')->middleware('auth')->name('instansi.update');
Route::get('/dashboard', 'PageController@dashboard')->middleware('auth')->name('dashboard');
