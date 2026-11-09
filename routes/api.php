<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ProductController;

Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('products', ProductController::class);