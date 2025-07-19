<?php

use Illuminate\Support\Facades\Route;

Route::get('/debug-providers', function () {
    return config('app.providers');
});