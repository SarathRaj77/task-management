<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function success($message = '', $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function error($message)
    {
        return response()->json([
            'success'    => false,
            'message'   => $message
        ], 422);
    }
}
