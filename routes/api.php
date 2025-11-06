<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;

Route::get('/test', [Test::class, 'test']);
