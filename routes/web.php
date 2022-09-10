<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Models\Comment;

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

Route::get('/dashboard', function () {
    return view('dashboard')->with('posts', Post::orderBy('updated_at', 'desc')->paginate(5));
})->middleware(['auth'])->name('dashboard');

// Posts

Route::post('createpost', 
    [PostsController::class, 'create']
)->name('createpost');

Route::post('deletepost', 
    [PostsController::class, 'delete']
)->name('deletepost');

// Comments

Route::post('createcomment', 
    [CommentController::class, 'create']
)->name('createcomment');


require __DIR__.'/auth.php';