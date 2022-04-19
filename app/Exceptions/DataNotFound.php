<?php

namespace App\Exceptions;

use Exception;

class DataNotFound extends Exception
{
    public function render()
    {
        return [
            'status' => 'failed',
            'message' => 'Data Not Found',
            'data' => []
        ];
    }
}
