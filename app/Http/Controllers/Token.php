<?php

namespace App\Http\Controllers;


abstract class Token
{
    public static function genererToken($length = 32)
    {
        return bin2hex(random_bytes($length / 2));
    }
}
