<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\ServiceUserController;
use App\Http\Controllers\SkillUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperDetailServiceController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/x', function () {
    return view('x');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('skills', SkillUserController::class);
    Route::resource('services', ServiceUserController::class);
    Route::resource('projects', ProjectUserController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::get('detail_services/create/{service_id}', [SuperDetailServiceController::class, 'create'])->name('detail_services_create');
    Route::get('/users/profile/{user}', [UserController::class, 'profile'])->name('user_profile');

    Route::get('/open_app', function () {
        return redirect()->route('user_profile', ['user' => Auth::user()->id]);
    });
});

Route::get('portfolios/{id_detail_user}/{name_user}', [PortfolioController::class, "portfolio"])->name('portfolio_show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
