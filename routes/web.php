<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
	return view('default');
});

Auth::routes();

Route::middleware(['auth:web'])->group(function () {
	Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
	//Routes for Referrals
    Route::get('referrals/upload', 'ReferralController@upload');
    Route::post('referrals/upload', 'ReferralController@processUpload');
    Route::get('referrals/create', 'ReferralController@create')->name('add-referral');
    Route::get('referrals/{country?}/{city?}', 'ReferralController@index');
    Route::post('referrals', 'ReferralController@store');
    Route::post('referrals/search','ReferralController@search')->name('referrals.search');
    //Routes for users
    Route::get('allusers', 'UserController@index')->name('users.index');
    Route::get('user/create', 'UserController@create')->name('users.create');
    Route::get('user/create/login', 'UserController@logincreate')->name('users.create.login');
    Route::post('user/login', 'UserController@userlogin')->name('users.login');
    Route::post('user/store', 'UserController@store')->name('users.store');
    Route::delete('user/{id}','UserController@destroy')->name('users.delete');
    //Routes for Posts
    Route::get('posts/create', 'PostController@create');
    Route::get('posts', 'PostController@index');
    Route::post('posts', 'PostController@store');
    Route::get('posts/{id}', 'PostController@show');
});

/*


//Logged in Users
Route::get('my-posts', 'AuthorsController@posts')->name('my-posts');

//Routes for Authors
Route::get('authors', 'AuthorsController@index');
Route::get('authors/{author}', 'AuthorsController@show');
*/