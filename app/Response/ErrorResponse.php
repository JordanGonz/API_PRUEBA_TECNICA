<?php
namespace App\Response;
class ErrorResponse 
{
    public static function error(\Exception $e)
    { 
        $data = [
            'status'  => 'error',
            'message' => $e-> getMessage(),
        ];

        return \response($data, 400);
    }
}