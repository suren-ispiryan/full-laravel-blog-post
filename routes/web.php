<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignController;

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

// Dashboard routes
Route::get('/', [DashboardController::class, 'showAllPosts']);
Route::get('/auth-user-posts', [DashboardController::class, 'showAuthUserPosts']);

// Liked posts
Route::get('/liked-user-posts', [DashboardController::class, 'showLikedPosts']);
Route::get('/likePost/{id}', [DashboardController::class, 'likePost']);
Route::get('/unlike/{id}', [DashboardController::class, 'unLikePost']);

// Post crud
Route::get('/create-post', [DashboardController::class, 'createPost']);
Route::POST('/create', [DashboardController::class, 'create']);
Route::get('/update-post/{id}', [DashboardController::class, 'updatePost']);
Route::post('/update/{id}', [DashboardController::class, 'update']);
Route::get('/delete-post/{id}', [DashboardController::class, 'deletePost']);

// Registration routes
Route::get('/login', [SignController::class, 'showSignIn']);
Route::get('/register', [SignController::class, 'showSignUp']);
Route::post('/login-user', [SignController::class, 'signIn']);
Route::post('/register-user', [SignController::class, 'signUp']);
Route::get('/log-out', [SignController::class, 'signOut']);

// unknown links redirect
Route::get('/{any}', [DashboardController::class, 'showAllPosts']);
