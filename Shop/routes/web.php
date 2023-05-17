<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', 'App\Http\Controllers\CatalogController@start');
Route::get('catalog/{selectedCatalogId}/{selectedCatalogName}', 'App\Http\Controllers\SeparatorCatalogProductController@start');
Route::get('product/{selectedProductId}/{selectedProductName}', 'App\Http\Controllers\ProductController@start');
Route::get('/registration', 'App\Http\Controllers\RegistrationController@start');
Route::post('/registration/post', 'App\Http\Controllers\RegistrationController@store');
Route::get('/profile', 'App\Http\Controllers\ProfileController@start');
Route::get('/login', 'App\Http\Controllers\LoginController@start');
Route::post('/login/post', 'App\Http\Controllers\LoginController@check');
Route::get('/test', function () {
    view('test');
});
