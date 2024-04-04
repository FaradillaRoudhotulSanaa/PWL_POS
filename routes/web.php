<?php

use App\Http\Controllers\Jobsheet7\BarangController;
use App\Http\Controllers\Jobsheet7\KategoriController as Jobsheet7KategoriController;
use App\Http\Controllers\Jobsheet7\LevelController as Jobsheet7LevelController;
use App\Http\Controllers\Jobsheet7\StokController;
use App\Http\Controllers\Jobsheet7\TransactionController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\KategoriModel;
use App\Http\Controllers\UsersController;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'users'], function () {
    Route::get('/' , [UsersController::class , 'index']);
    Route::get('/list' , [UsersController::class , 'list']);
    Route::get('/create', [UsersController::class , 'create']);
    Route::post('/store' , [UsersController::class , 'store']);
    Route::get('/show/{id}', [UsersController::class , 'show']);
    Route::get('/{id}/edit', [UsersController::class ,'edit']);
    Route::put('/{id}', [UsersController::class ,'update']);
    Route::delete('/{id}', [UsersController::class ,'destroy']);
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/' , [Jobsheet7KategoriController::class , 'index']);
    Route::get('/list' , [Jobsheet7KategoriController::class , 'list']);
    Route::get('/create', [Jobsheet7KategoriController::class , 'create']);
    Route::post('/store' , [Jobsheet7KategoriController::class , 'store']);
    Route::get('/show/{id}', [Jobsheet7KategoriController::class , 'show']);
    Route::get('/{id}/edit', [Jobsheet7KategoriController::class ,'edit']);
    Route::put('/{id}', [Jobsheet7KategoriController::class ,'update']);
    Route::delete('/{id}', [Jobsheet7KategoriController::class ,'destroy']);
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/' , [Jobsheet7LevelController::class , 'index']);
    Route::get('/list' , [Jobsheet7LevelController::class , 'list']);
    Route::get('/create', [Jobsheet7LevelController::class , 'create']);
    Route::post('/store' , [Jobsheet7LevelController::class , 'store']);
    Route::get('/show/{id}', [Jobsheet7LevelController::class , 'show']);
    Route::get('/{id}/edit', [Jobsheet7LevelController::class ,'edit']);
    Route::put('/{id}', [Jobsheet7LevelController::class ,'update']);
    Route::delete('/{id}', [Jobsheet7LevelController::class ,'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/' , [BarangController::class , 'index']);
    Route::get('/list' , [BarangController::class , 'list']);
    Route::get('/create', [BarangController::class , 'create']);
    Route::post('/store' , [BarangController::class , 'store']);
    Route::get('/show/{id}', [BarangController::class , 'show']);
    Route::get('/{id}/edit', [BarangController::class ,'edit']);
    Route::put('/{id}', [BarangController::class ,'update']);
    Route::delete('/{id}', [BarangController::class ,'destroy']);
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/' , [StokController::class , 'index']);
    Route::get('/list' , [StokController::class , 'list']);
    Route::get('/create', [StokController::class , 'create']);
    Route::post('/store' , [StokController::class , 'store']);
    Route::get('/show/{id}', [StokController::class , 'show']);
    Route::get('/{id}/edit', [StokController::class ,'edit']);
    Route::put('/{id}', [StokController::class ,'update']);
    Route::delete('/{id}', [StokController::class ,'destroy']);
});

Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/' , [TransactionController::class , 'index']);
    Route::get('/list' , [TransactionController::class , 'list']);
    Route::get('/create', [TransactionController::class , 'create']);
    Route::post('/store' , [TransactionController::class , 'store']);
    Route::get('/show/{id}', [TransactionController::class , 'show']);
    Route::get('/{id}/edit', [TransactionController::class ,'edit']);
    Route::put('/{id}', [TransactionController::class ,'update']);
    Route::delete('/{id}', [TransactionController::class ,'destroy']);
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::post('/level/store', [LevelController::class, 'store'])->name('level.store');

// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/ubah/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('/kategori/create');

// Route::get('/kategori/update/{id}', [KategoriController::class, 'update'])->name('/kategori/update');
// Route::put('/kategori/save_update/{id}', [KategoriController::class, 'save_update'])->name('/kategori/save_update');

// Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('/kategori/delete');

// //-- JOBSHEET 6 --// 
// // Manage user 

// Route::resource('user',POSController::class);

// Route::post('data_user', [POSController::class, 'storeDashboard'])->name('user.storeDashboard');

// Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Route::get('/user/tambah', [UserController::class], 'tambah')->name('/user/tambah');
// Route::get('/user/tambah_simpan', [UserController::class], 'tambah_simpan')->name('/user/tambah_simpan');
// Route::get('/user/edit/{id}', [UserController::class, 'ubah'])->name('/user/ubah');
// Route::get('/user/{id}', [UserController::class, 'ubah_simpan'])->name('/user/ubah_simpan');
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('/user/hapus');
