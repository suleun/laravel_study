<?php

use App\Http\Controllers\LikesController;
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

Route::resource('/posts', PostsController::class)
   ->middleware(['auth']);

Route::delete('/posts/images/{id}',
                [PostsController::class, "deleteImage"])
                ->middleware(['auth']);

// Route::get('/posts', [PostsController::class, "index"])
//    ->name('posts.index')
// Route::Post('/posts', [PostsController::class, "store"])
//    ->name('posts.store')

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::post('/like/{post}', [LikesController::class, "store"])->middleware('auth')->name('like.store');

require __DIR__.'/auth.php';
