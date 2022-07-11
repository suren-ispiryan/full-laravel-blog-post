<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\ProfileController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth-user-posts', [DashboardController::class, 'showAuthUserPosts']);
    // Profile
    Route::get('/my-profile/{id}', [ProfileController::class, 'showMyProfile']);
    Route::get('/user-profile/{id}', [ProfileController::class, 'showChosenUserProfile']);
    Route::get('/home-page', [ProfileController::class, 'homePage']);
    Route::get('/post-details/{id}', [ProfileController::class, 'showPostDetails']);
    // follow
    Route::get('/follow/{id}', [ProfileController::class, 'follow']);
    Route::get('/unfollow/{id}', [ProfileController::class, 'unfollow']);
    // post comments crud
    Route::post('/add-comment/{id}', [ProfileController::class, 'createComment']);
    Route::get('/show-update-comment/{id}', [ProfileController::class, 'showUpdateComment']);
    Route::post('/update-comment/{id}', [ProfileController::class, 'updateComment']);
    Route::get('/delete-comment/{id}', [ProfileController::class, 'deleteComment']);
    // Liked / dislike
    Route::get('/liked-user-posts', [DashboardController::class, 'showLikedPosts']);
    Route::get('/likePost/{id}', [DashboardController::class, 'likePost']);
    Route::get('/unlike/{id}', [DashboardController::class, 'unLikePost']);
    Route::get('/like-comment/{id}', [DashboardController::class, 'likeComment']);
    Route::get('/dislike-comment/{id}', [DashboardController::class, 'disLikeComment']);
    // Post crud
    Route::get('/create-post', [DashboardController::class, 'createPost']);
    Route::post('/create', [DashboardController::class, 'create']);
    Route::get('/update-post/{id}', [DashboardController::class, 'updatePost']);
    Route::post('/update/{id}', [DashboardController::class, 'update']);
    Route::get('/delete-post/{id}', [DashboardController::class, 'deletePost']);
    // soft delete
    Route::get('/deleted-posts-posts', [DashboardController::class, 'deletedPosts']);
    Route::get('/deletePostForever/{id}', [DashboardController::class, 'deleteForever']);
    Route::get('/restorePost/{id}', [DashboardController::class, 'restorePost']);
    // Registration routes
    Route::post('/change-password', [SignController::class, 'changePass']);
    Route::get('/log-out', [SignController::class, 'signOut']);
});

// Registration routes
Route::get('/login', [SignController::class, 'showSignIn'])->name('login');
Route::get('/register', [SignController::class, 'showSignUp']);
Route::post('/login-user', [SignController::class, 'signIn']);
Route::post('/register-user', [SignController::class, 'signUp']);
// Profile
Route::get('/post-details/{id}', [ProfileController::class, 'showPostDetails']);
// unknown links redirect
Route::get('/{any}', [DashboardController::class, 'showAllPosts']);
