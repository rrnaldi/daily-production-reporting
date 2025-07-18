<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UomController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Supervisor\LotController;
use App\Http\Controllers\Admin\WorkCenterController;
use App\Http\Controllers\Supervisor\LaporanController;
use App\Http\Controllers\Operator\ProductionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::resource('users', UserController::class);
    Route::resource('work-centers', WorkCenterController::class);
    Route::resource('uoms', UomController::class);
    Route::resource('items', ItemController::class);
});


Route::middleware(['auth', 'role:operator'])->prefix('operator')->group(function () {
    Route::get('/dashboard', function () {
        return view('operator.dashboard');
    });

   
    Route::get('/produksi', [ProductionController::class, 'create'])->name('operator.produksi.create');
    Route::post('/produksi', [ProductionController::class, 'store'])->name('operator.produksi.store');
    Route::get('/riwayat', [ProductionController::class, 'riwayat'])->name('operator.produksi.riwayat');


   
});


Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    });

   Route::resource('lots', LotController::class);
   Route::get('/laporan/export-all', [LaporanController::class, 'exportAll'])->name('laporan.exportAll');

   Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
   Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
   Route::get('/laporan/{id}/export', [LaporanController::class, 'export'])->name('laporan.export');
   

});