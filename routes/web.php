<?php

namespace app\App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
require __DIR__ . '/auth.php';


// Front Auth Routes

Route::get('/sign-up', function () {
    return view('front.register');
})->name('register');
Route::post('/sign-up', [AuthController::class, 'clientRegister'])->name('clientRegister');
Route::get('/clientLogin', function () {return view('front.login');})->name('clientLogin');
Route::get('/article-details', function () {return view('front.article-details');})->name('article-details');

Route::get('/donation-details/{id}', [MainController::class, 'donationDetails'])->name('donation-details');
Route::get('/article/{id}', [MainController::class, 'showArticle'])->name('article-details');
Route::get('/myFavourites/', [MainController::class, 'myFavourites'])->name('myFavourites');
Route::get('/articles', [MainController::class, 'showArticles'])->name('articles');
Route::post('/clientLogin', [AuthController::class, 'clientLogin'])->name('clientLogin');
Route::get('/', [MainController::class, 'mainPage'])->name('HomePage');


Route::middleware('auth:client')->group(function () {
    Route::post('/post-favourite', [MainController::class, 'toggleFavourite'])->name('post-favourite');
    Route::post('/clientlogout', [AuthController::class, 'clientLogout'])->name('clientLogout');
});

Route::post('/contact', [MainController::class, 'contact'])->name('contact.store');
Route::get('/contact-us', function () {return view('front.contact-us');})->name('contact-us');
Route::get('/who-are-us', function () {return view('front.who-are-us');})->name('who-are-us');
Route::get('/donation-requests', [MainController::class, 'donationRequests'])->name('donation-requests');
//Route::get('/donation-requests', function () {return view('front.donation-requests');})->name('donation-requests');
//Route::get('/cities', [MainController::class, 'getCities']);

////////////////////
// Login route
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

//Admin panel

Route::group(['middleware' => ['auth:sanctum', 'check-permissions'], 'prefix' => 'admin'], function () {
    Route::get('/home', function () {return view('home');})->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('governorates', GovernorateController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('posts', PostController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('donations', DonationController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('settings', SettingController::class);
});

Route::get('clients-activate/{id}', [ClientController::class, 'activate'])->name('clients.activate');
Route::get('clients-deactivate/{id}', [ClientController::class, 'deactivate'])->name('clients.deactivate');
Route::get('clients-toggle-activation/{id}', [ClientController::class, 'toggleActivation'])->name('clients.toggle-activation');


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



