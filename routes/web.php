<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Categories
Route::get('/categories', [CategoriesController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('category.store');
Route::delete('/categories/{categories}', [CategoriesController::class, 'destroy'])->name('category.destroy');

// Unit
Route::get('/units', [UnitController::class, 'index'])->name('unit.index');
Route::post('/units', [UnitController::class, 'store'])->name('unit.store');
Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('unit.destroy');

// Supplier
Route::get('/suppliers', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('supplier.store');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

// Stock
Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');
Route::post('/stocks', [StockController::class, 'store'])->name('stock.store');
Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

// User
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
