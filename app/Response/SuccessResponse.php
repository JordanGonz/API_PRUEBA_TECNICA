<?php 
namespace App\Response;
class SuccessResponse 
{
    public static function success($data, $message = '')
    {
        return [
            'status'  => 'ok',
            'message' => empty($message) ? 'Respuesta Sastifactoria.' : $message,
            'data'    => $data
        ]; 
    }

}