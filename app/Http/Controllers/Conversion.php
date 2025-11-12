<?php

namespace App\Http\Controllers;

abstract class Conversion
{
    public static function convertir(array &$data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data[$key] = null;
            }
        }
    }

    public static function reconvertir(object &$data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data->$key = '';
            }
        }
    }
}
