<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ola', function (Request $request) {
    return 'ola';
});
