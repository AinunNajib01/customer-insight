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
Route::group([], function() {
    // Route::get('auth', 'UserManagementController@showForm')->name('login');
    // Route::post('login', 'UserManagementController@submitLoginForm');
    // Route::post('register', 'UserManagementController@submitRegisterForm');
    // Route::post('logout', 'UserManagementController@logout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home');

	// single upload
	Route::get('file/upload', 'UploadFileController@form')->name('file.form');
	// Route::get('file/index', 'FileController@index')->name('file.index');
	Route::post('file/upload', 'UploadFileController@upload')->name('file.upload');
	// Route::get('file/{file}/download', 'FileController@download')->name('file.download');
	// Route::get('file/{file}/response', 'FileController@response')->name('file.response');

	// multiple upload
	Route::get('file/multiple/upload', 'UploadMultipleFileController@form')->name('multiple.form');
	Route::post('file/multiple/upload', 'UploadMultipleFileController@upload')->name('multiple.upload');
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', 'DashboardController@index');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

