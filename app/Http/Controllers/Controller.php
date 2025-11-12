<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="APIs pour la gestion du site d'e-commerce",
 *     version="1.0.0",
 *     description="Des APIs pour gérer les articles du site"
 * ),
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Entrez votre token JWT"
 * )
 */

abstract class Controller
{
    //
}
