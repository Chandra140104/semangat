<?php

use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
    return view('welcome');
    
    Route::get('/saw-test', [SawController::class, 'index']);
    Route::get('/penilaian/input', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/input', [PenilaianController::class, 'store'])->name('penilaian.store');
});
