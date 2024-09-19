<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        try {
            $departamentos = User::all();
            return SuccessResponse::success($departamentos);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }

    // Mostrar un usuario específico
    public function mostrar($id)
    {
        try {
            $service = new UserService;
            $result  = $service->ObtenerUsuarioId($id);
            
            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }  
    }

    // Crear un nuevo usuario
    public function crear(Request $request)
    {
        try {
            $service = new UserService;
            $result  = $service->CrearUsuario($request);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }

    // Actualizar un usuario existente
    public function actualizar(Request $request, $id)
    {
        try {
            $service = new UserService;
            $result  = $service->ActualizarUsuario($request, $id);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }

    // Eliminar un usuario
    public function eliminar($id)
    {
        try {
            $service = new UserService;
            $result = $service->EliminarUsuario($id);

            return SuccessResponse::success( $result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }
}
