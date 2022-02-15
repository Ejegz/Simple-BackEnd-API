<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    // MEnyeragamkan output atau data respone dari json
    // Status
    // Data 
    // Error
    // Dibuat kesepakatan antar tim
    public function out($data = null, $status = '', $error = null, $code = 200)
    {
        return \response()->json(
            [
                'status' => $status,
                'data' => $data,
                'error' => $error
            ],
            $code
        );
    }
}
