<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;
use App\Http\Controllers\Utilisateur;

Route::get('/test', [Test::class, 'test']);
Route::post('/connexion', [Utilisateur::class, 'connexion']);
Route::put('/deconnexion', [Utilisateur::class, 'deconnexion']);
Route::post('/inscription', [Utilisateur::class, 'inscription']);
Route::put('/modifier_infos', [Utilisateur::class, 'modifier_infos']);
Route::put('/modifier_mdp', [Utilisateur::class, 'modifier_mdp']);
