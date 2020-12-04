<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComicController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/privacy', 'privacy');
Route::view('/support', 'support');
Route::view('/thanks', 'thanks');

Route::get('/auth', AuthController::class);

Route::post('/xkcd', ComicController::class);
