<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function helloWorld()
    {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    }
}
