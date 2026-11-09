<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'application' => 'QuoteFlow',
        'version' => '1.0.0'
    ]);
});