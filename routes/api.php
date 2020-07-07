<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

<<<<<<< HEAD
Route::post('auth/login', 'Api\AuthController@login')->name('login');

//Use of tokens in external systems...


Route::group(['middleware'=>['apiJwt']], function() {
  Route::apiResource('posts','Api\PostController')
        ->names([
          'index'   =>    'api.posts.index',
          'show'    =>    'api.posts.show',
          'store'   =>    'api.posts.store',
          'update'  =>    'api.posts.update',
          'destroy' =>    'api.posts.destroy'
        ]);
});

Route::get('posts','Api\PostController@index');
=======
//Route::resource('posts','Api\PostController')->except('create','edit');
//Route::apiResource('posts','Api\PostController');

//Use of tokens in external systems...

Route::apiResource('posts','Api\PostController')
    ->names([
      'index'   =>    'api.posts.index',
      // 'show'    =>    'api.posts.show',
      // 'store'   =>    'api.posts.store',
      // 'update'  =>    'api.posts.update',
      // 'destroy' =>    'api.posts.destroy',
    ]);
>>>>>>> f7e25dabf40b68c8d962339e26d4c6091bd2a7af
