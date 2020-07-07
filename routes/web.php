<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');

// Route::get('/', function () {
//     return view('welcome');
// });

//Api consumption in internal systems

Route::group(['prefix'=>'api'], function() {
  //Route::apiResource('posts','Api\PostController');
});

Auth::routes();

<<<<<<< HEAD

=======
>>>>>>> f7e25dabf40b68c8d962339e26d4c6091bd2a7af
Route::middleware('auth')->resource('posts', 'Backend\PostController')->only('index');

Route::get('/home', 'Backend\HomeController@index')->name('home');
