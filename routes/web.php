<?php

use App\Http\Controllers\ImportExcel;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('imports',[ImportExcel::class,'imports'])->name('imports');


    Route::middleware(ValidUser::class)->get('/cerrados', function () {
        return view('cerrados');
    })->name('cerrados');
});

