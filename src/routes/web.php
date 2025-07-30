<?php

use Illuminate\Support\Facades\Route;

Route::get('/stm-ui-components/script.js', function () {
    $file = dirname(__DIR__).'/../dist/main.min.js';
    abort_unless(file_exists($file), 404);

    return response()->file($file, [
        'Content-Type' => 'application/javascript',
        'Cache-Control' => 'public, max-age=604800',
    ]);
});