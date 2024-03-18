<?php

use Illuminate\Support\Facades\Route;

Route::prefix('pdf')
    ->controller(\App\Http\Controllers\PdfController::class)
    ->group(function () {
        Route::post('make', 'make');
});
