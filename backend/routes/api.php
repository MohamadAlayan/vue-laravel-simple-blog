<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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


// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostController::class, 'getAllPosts']); //  Get All Posts

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // User
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/posts/{id}', [PostController::class, 'getPost']); // Get Single Post
    Route::get('/user/posts/{id}', [PostController::class, 'getUserPosts']); // Get User Posts
    Route::post('/posts', [PostController::class, 'addNewPost']); // Create New Post
    Route::put('/posts/{id}', [PostController::class, 'editPost']); // Edit Post
    Route::delete('/posts/{id}', [PostController::class, 'deletePost']); // Delete Post
});
