<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;


// Public routes for registration and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/send-pin-code', [AuthController::class, 'sendPinCode']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);
Route::get('/cities', [MainController::class, 'cities']);
Route::get('/blood-types', [MainController::class, 'bloodTypes']);
Route::get('/categories', [MainController::class, 'categories']);
Route::get('/governorates', [MainController::class, 'governorates']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'get_profile']);
    Route::put('/clients/{id}', [AuthController::class, 'update']);
    Route::post('/notifications-settings', [AuthController::class, 'notificationsSettings']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    // Create a post
    Route::post('/posts-requests', [MainController::class, 'createPosts']);
    //  post-favourite
    Route::post('/post-favourite', [MainController::class, 'postFavourite']);
    // myFavourites
    Route::get('/myFavourites', [MainController::class, 'myFavourites']);
    // Search posts
    Route::get('/posts/search', [MainController::class, 'searchPosts']);
    // Create a donation request
    Route::post('/donation-request-create', [MainController::class, 'DonationRequestCreat']);
    // Search donation requests
    Route::get('/donation-requests', [MainController::class, 'donationRequests']);
    // Contact requests
    Route::get('/contact-requests', [MainController::class, 'contact']);
});
