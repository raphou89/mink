<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\TypeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('animals.admin.index');
});

Route::get('/animals/user', [AnimalController::class, 'user']);
Route::get('/animals/admin', [AnimalController::class, 'admin']);

Route::get('/races', [RaceController::class, 'index']);
Route::get('/types', [TypeController::class, 'index']);