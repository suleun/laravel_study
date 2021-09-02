<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function () {
    return view('layouts.app');
});

// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/create', [PostController::class, 'create']);
// Route::get('/store', [PostController::class, 'store']);

Route::resource('/posts', PostsController::class);