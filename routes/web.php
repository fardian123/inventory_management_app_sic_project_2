<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisorController;




Route::get('/', function () {
    \Log::info('Loading welcome view');
    return view('welcome');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'adminChangePassword'])->name('admin.change.password');
    Route::POST('/admin/password/update',[AdminController::class,'adminPasswordUpdate'])->name('admin.password.update');

    Route::get('/admin/inventory/management',[BarangController::class,'adminInventoryManagement'])->name('admin.inventory.management');
    Route::post('/admin/barang/add',[BarangController::class,'adminBarangAdd'])->name('admin.barang.add');
    Route::post('/admin/barang/edit',[BarangController::class,'adminBarangEdit'])->name('admin.barang.edit');
    Route::post('/admin/barang/delete',[BarangController::class,'adminBarangDelete'])->name('admin.barang.delete');
    Route::post('/admin/barang/out/update', [BarangController::class, 'adminBarangOutUpdate'])->name('admin.barang.out.update');

    Route::get('/admin/inventory/history',[BarangController::class,'adminInventoryHistory'])->name('admin.inventory.history');

});

Route::middleware(['auth','roles:supervisor'])->group(function(){
    Route::get('/supervisor/dashboard',[SupervisorController::class,'supervisorDashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/logout',[supervisorController::class,'supervisorLogout'])->name('supervisor.logout');
    Route::get('/supervisor/profile',[supervisorController::class,'supervisorProfile'])->name('supervisor.profile');
    Route::post('/supervisor/profile/store',[supervisorController::class,'supervisorProfileStore'])->name('supervisor.profile.store');
    Route::get('/supervisor/change/password',[supervisorController::class,'supervisorChangePassword'])->name('supervisor.change.password');
    Route::POST('/supervisor/password/update',[supervisorController::class,'supervisorPasswordUpdate'])->name('supervisor.password.update');


    Route::get('/supervisor/inventory/management',[BarangController::class, 'supervisorInventoryManagement'])->name('supervisor.inventory.management');

    
});



require __DIR__ . '/auth.php';
