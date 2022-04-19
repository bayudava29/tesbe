<?php

namespace App\Exceptions;

use Exception;

class ServerError extends Exception
{
    protected $message;

    public function __construct($msg = 'Internal Server Error')
    {
        $this->message = $msg;
    }

    public function render()
    {
        return response()->json([
            'status' => 'server_error',
            'message' => $this->message
        ], 500);
    }
}
