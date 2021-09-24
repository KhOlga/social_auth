<?php

use App\Http\Controllers\Auth\LoginController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'github', 'as' => 'github.'], function () {
	Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
		Route::get('redirect', [LoginController::class, 'redirectToGitHub'])->name('login');
		Route::get('callback', [LoginController::class, 'handleGitHubCallback'])->name('redirect_callback');
	});
});

Route::group(['prefix' => 'google', 'as' => 'google.'], function () {
	Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
		Route::get('redirect', [LoginController::class, 'redirectToGoogle'])->name('login');
		Route::get('callback', [LoginController::class, 'handleGoogleCallback'])->name('redirect_callback');
	});
});

