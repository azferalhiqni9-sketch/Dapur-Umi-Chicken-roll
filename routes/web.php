<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Proses pemesanan
Route::post('/pesan/proses', [OrderController::class, 'store'])->name('pesan.proses');
Route::get('/pesan/sekarang', [OrderController::class, 'create'])->name('pesan.sekarang');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/proses', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (dilindungi middleware admin)
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'total_menu' => \App\Models\Menu::count(),
            'total_orders' => \App\Models\Order::count(),
            'pending_orders' => \App\Models\Order::where('status', 'pending')->count()
        ]);
    })->name('admin.dashboard');
    
    Route::get('/menu', [MenuController::class, 'adminIndex'])->name('admin.menu');
    Route::post('/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
    Route::put('/orders/{id}', [OrderController::class, 'updateStatus'])->name('admin.orders.update');
});