<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceUserController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceUserController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::get('/users/profile/{user}', [UserController::class, 'profile'])->name('user_profile');
});

Route::get('portfolios/{id_detail_user}/{name_user}', [PortfolioController::class, "portfolio"])->name('portfolio_show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
