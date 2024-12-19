<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PenjualanController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mobils', [MobilController::class, 'index'])->name('mobils.index');
Route::resource('mobils', MobilController::class);
Route::resource('penjualans', PenjualanController::class);

Route::post('/mobils/{id}/beli', [MobilController::class, 'beliSekarang'])->name('mobils.beli');

Route::get('/sales', [PenjualanController::class, 'index'])->name('sales.index');



require __DIR__.'/auth.php';
