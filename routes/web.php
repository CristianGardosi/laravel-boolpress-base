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

// *STATIC PAGES*
// HOMEPAGE ROUTE W/ CONTROLLER
Route::get('/', 'StaticPagesController@home')->name('homepage');
// ABOUT ROUTE W/ CONTROLLER
Route::get('/about', 'StaticPagesController@about')->name('about');

// *RESOURCES (CRUD)*
Route::resource('posts', 'PostController');
