<?php

use Illuminate\Support\Facades\Route;

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');
