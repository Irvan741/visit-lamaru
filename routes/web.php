<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountManagerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\WisataFacilityController;
// User
Route::prefix('admin/users')->group(function () {
    Route::get('/', [AccountManagerController::class, 'userIndex'])->name('admin.users.index');
    Route::get('/create', [AccountManagerController::class, 'userCreate'])->name('admin.users.create');
    Route::post('/store', [AccountManagerController::class, 'userStore'])->name('admin.users.store');
    Route::get('/{id}/edit', [AccountManagerController::class, 'userEdit'])->name('admin.users.edit');
    Route::post('/{id}/update', [AccountManagerController::class, 'userUpdate'])->name('admin.users.update');
    Route::delete('/{id}/delete', [AccountManagerController::class, 'userDelete'])->name('admin.users.destroy');
});

// Role
Route::prefix('admin/roles')->group(function () {
    Route::get('/', [AccountManagerController::class, 'roleIndex'])->name('admin.roles.index');
    Route::get('/create', [AccountManagerController::class, 'roleCreate'])->name('admin.roles.create');
    Route::post('/store', [AccountManagerController::class, 'roleStore'])->name('admin.roles.store');
    Route::get('/{id}/edit', [AccountManagerController::class, 'roleEdit'])->name('admin.roles.edit');
    Route::post('/{id}/update', [AccountManagerController::class, 'roleUpdate'])->name('admin.roles.update');
    Route::delete('/{id}/delete', [AccountManagerController::class, 'roleDelete'])->name('admin.roles.destroy');
});

Route::prefix('admin/permissions')->group(function () {
    Route::get('/', [AccountManagerController::class, 'permissionIndex'])->name('admin.permissions.index');
    Route::get('/create', [AccountManagerController::class, 'permissionCreate'])->name('admin.permissions.create');
    Route::post('/store', [AccountManagerController::class, 'permissionStore'])->name('admin.permissions.store');
    Route::get('/{id}/edit', [AccountManagerController::class, 'permissionEdit'])->name('admin.permissions.edit');
    Route::put('/{id}/update', [AccountManagerController::class, 'permissionUpdate'])->name('admin.permissions.update');
    Route::delete('/{id}/delete', [AccountManagerController::class, 'permissionDelete'])->name('admin.permissions.destroy');
});

Route::prefix('admin/category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('admin.category.destroy');
});
// Route::prefix('admin/fasilitas')->group(function(){
//     Route::get('/', [FacilityController::class, 'index'])->name('admin.fasilitas.index');
//     Route::get('/create', [FacilityController::class, 'create'])->name('admin.fasilitas.create');
//     Route::post('/store', [FacilityController::class, 'store'])->name('admin.fasilitas.store');
//     Route::get('/{id}/edit', [FacilityController::class, 'edit'])->name('admin.fasilitas.edit');
//     Route::put('/{id}/update', [FacilityController::class, 'update'])->name('admin.fasilitas.update');
//     Route::delete('/{id}/delete', [FacilityController::class, 'delete'])->name('admin.fasilitas.destroy');
// });

Route::prefix('admin/wisata')->group(function () {
    Route::get('/', [WisataController::class, 'index'])->name('admin.wisata.index');
    Route::get('/create', [WisataController::class, 'create'])->name('admin.wisata.create');
    Route::post('/store', [WisataController::class, 'store'])->name('admin.wisata.store');
    Route::get('/{id}/edit', [WisataController::class, 'edit'])->name('admin.wisata.edit');
    Route::put('/{id}/update', [WisataController::class, 'update'])->name('admin.wisata.update');
    Route::delete('/{id}/delete', [WisataController::class, 'delete'])->name('admin.wisata.destroy');

    Route::get('/{id}/fasilitas', [FacilityController::class, 'index'])->name('admin.wisata.facility.index');
    Route::get('/{id}/fasilitas/create', [FacilityController::class, 'create'])->name('admin.wisata.facility.create');
    Route::post('/{id}/fasilitas/store', [FacilityController::class, 'store'])->name('admin.wisata.facility.store');
    Route::get('/{id}/fasilitas/{idFasilitas}/edit', [FacilityController::class, 'edit'])->name('admin.wisata.facility.edit');
    Route::put('/{id}/fasilitas/{idFasilitas}/update', [FacilityController::class, 'update'])->name('admin.wisata.facility.update');
    Route::delete('/{id}/fasilitas/{idFasilitas}/delete', [FacilityController::class, 'delete'])->name('admin.wisata.facility.destroy');
});

