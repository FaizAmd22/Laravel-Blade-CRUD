<?php
use App\Http\Controllers\TestControler;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
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

Route::get('tes', [TestControler::class, 'index']);
// Route::resource('posts', PostController::class);

//Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register_form'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Posts
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/create', [PostController::class, 'create']);
    Route::get('posts/{id}', [PostController::class, 'show']);
    Route::get('posts/{id}/edit', [PostController::class, 'edit']);
    Route::patch('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
});
