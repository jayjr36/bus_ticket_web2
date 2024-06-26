<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::middleware(['auth', 'admin-middleware'])->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'storeUser']);
    Route::post('/admin/users/topup', [AdminController::class, 'topupUser']);
    Route::get('/admin/buses', [AdminController::class, 'showBuses'])->name('admin.buses');
    Route::get('/admin/buses/{bus}/passengers', [AdminController::class, 'showPassengers']);
    Route::get('/admin/buses/{bus}/fare-collection', [AdminController::class, 'showFareCollection']);

Route::get('/admin/add-bus', [AdminController::class, 'showAddBusForm'])->name('admin.addBusForm');
Route::post('/admin/add-bus', [AdminController::class, 'storeBus'])->name('admin.storeBus');
//});
Route::get('/top-up', [AdminController::class, 'showUsers2'])->name('top-up');
Route::get('/add-user', function () {
    return view('admin.addusers');
})->name('add-user');