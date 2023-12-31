<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehiclesController;
use App\Models\Category;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/login'], function(){
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'attemptLogin'])->name('login.attempt');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/register'], function(){
    Route::get('/', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/', [AuthController::class, 'storeAccount'])->name('register.store');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store')->middleware('auth');
Route::post('/vehicles', [VehiclesController::class, 'store'])->name('vehicles.store')->middleware('auth');

Route::delete('/vehicles/{id}', [VehiclesController::class, 'delete'])->name('vehicles.delete')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/files', [FilesController::class, 'index']);
Route::post('/files', [FilesController::class, 'store'])->name('files.store');

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/proyecto-ipvg/public/livewire/update', $handle);
});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/proyecto-ipvg/public/livewire/livewire.js', $handle);
});
