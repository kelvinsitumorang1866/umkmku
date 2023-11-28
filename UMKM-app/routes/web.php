<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\makanOlahanController;
use App\Http\Controllers\pertanianController;
use App\Http\Controllers\peternakanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\umkmController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [indexController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('umkm', UmkmController::class)->middleware(['auth']);
Route::middleware('auth')->prefix('manageUmkm')->group(function(){
    Route::get('/MakananOlahan/{id}',[makanOlahanController::class, 'index'])->name('makananOlahan');
    Route::post('/MakananOlahan/{id}/produk',[makanOlahanController::class, 'addProduct'])->name('makananOlahan.addProduct');
    Route::put('/MakananOlahan/{id}/produk',[makanOlahanController::class, 'editProduct'])->name('makananOlahan.editProduct');
    Route::post('/MakananOlahan/{id}/sale',[makanOlahanController::class, 'addSale'])->name('makananOlahan.addSale');
    Route::get('/Pertanian/{id}',[pertanianController::class, 'index'])->name('Pertanian');
    Route::post('/Pertanian/{id}/produk',[pertanianController::class, 'addProduct'])->name('Pertanian.addProduct');
    Route::delete('/Pertanian/produk/{produk}',[pertanianController::class, 'deleteProduct'])->name('Pertanian.deleteProduct');
    Route::put('/Pertanian/{id}/produk',[pertanianController::class, 'editProduct'])->name('Pertanian.editProduct');
    Route::post('/Pertanian/{id}/gagal',[pertanianController::class, 'addGagal'])->name('Pertanian.addGagal');
    Route::delete('/Pertanian/gagal{gagal}',[pertanianController::class, 'deleteGagal'])->name('Pertanian.deleteGagal');
    Route::post('/Pertanian/{id}/sukses',[pertanianController::class, 'addSukses'])->name('Pertanian.addSukses');
    Route::delete('/Pertanian/sukses/{sukses}',[pertanianController::class, 'deleteSukses'])->name('Pertanian.deleteSukses');
    Route::post('/Pertanian/{id}/sale',[pertanianController::class, 'addSale'])->name('Pertanian.addSale');
    Route::delete('/Pertanian/sale/{sale}',[pertanianController::class, 'deleteSale'])->name('Pertanian.deleteSale');
    Route::get('/Peternakan/{id}',[peternakanController::class, 'index'])->name('Peternakan');
    Route::post('/Peternakan/{id}/produk',[peternakanController::class, 'addProduct'])->name('Peternakan.addProduct');
    Route::put('/Peternakan/{id}/produk',[peternakanController::class, 'editProduct'])->name('Peternakan.editProduct');
    Route::delete('/Peternakan/produk/{produk}',[peternakanController::class, 'deleteProduct'])->name('Peternakan.deleteProduct');
    Route::post('/Peternakan/{id}/gagal',[peternakanController::class, 'addGagal'])->name('Peternakan.addGagal');
    Route::delete('/Peternakan/gagal/{gagal}',[peternakanController::class, 'deleteGagal'])->name('Peternakan.deleteGagal');
    Route::post('/Peternakan/{id}/sukses',[peternakanController::class, 'addSukses'])->name('Peternakan.addSukses');
    Route::delete('/Peternakan/sukses/{sukses}',[peternakanController::class, 'deleteSukses'])->name('Peternakan.deleteSukses');
    Route::post('/Peternakan/{id}/gagalT',[peternakanController::class, 'addGagalT'])->name('Peternakan.addGagalT');
    Route::delete('/Peternakan/gagalT/{gagalT}',[peternakanController::class, 'deleteGagalT'])->name('Peternakan.deleteGagalT');
    Route::post('/Peternakan/{id}/suksesT',[peternakanController::class, 'addSuksesT'])->name('Peternakan.addSuksesT');
    Route::delete('/Peternakan/suksesT/{suksesT}',[peternakanController::class, 'deleteSuksesT'])->name('Peternakan.deleteSuksesT');
    Route::post('/Peternakan/{id}/sale',[peternakanController::class, 'addSale'])->name('Peternakan.addSale');
    Route::delete('/Peternakan/sale/{sale}',[peternakanController::class, 'deleteSale'])->name('Peternakan.deleteSale');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
