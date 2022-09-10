<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Models\Post;

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
    return view('dashboard')->with('posts', Post::all());
})->middleware(['auth'])->name('dashboard');

// Posts

Route::post('createpost', 
    [PostsController::class, 'create']
)->name('createpost');

Route::post('deletepost', 
    [PostsController::class, 'delete']
)->name('deletepost');

require __DIR__.'/auth.php';