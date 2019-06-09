<?php

use Illuminate\Http\Request;

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

Route::get('/players', 'PlayerController@index');
Route::get('/players/{id}', 'PlayerController@show');
Route::post('/players', 'PlayerController@store');
Route::post('/players/{id}/answers', 'PlayerController@answer');
Route::delete('/players/{id}', 'PlayerController@delete');
Route::delete('/players/{id}/answers', 'PlayerController@resetAnswers');

Route::get('/categories', 'CategoryController@index');
Route::get('/categories/{id}', 'CategoryController@show');
Route::post('/categories', 'CategoryController@store');
// Route::post('/categories/{id}/answers', 'CategoryControllerC@answer');
Route::delete('/categories/{id}', 'CategoryController@delete');


Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::post('/products', 'ProductController@store');
Route::delete('/products/{id}', 'ProductController@delete');

Route::get('/orders', 'OrderController@index');
Route::get('/orders/{id}', 'OrderController@show');
Route::post('/orders', 'OrderController@store');
Route::delete('/orders/{id}', 'OrderController@delete');
