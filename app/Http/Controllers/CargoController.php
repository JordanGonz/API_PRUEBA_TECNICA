<?php

namespace App\Http\Controllers;

use App\Response\ErrorResponse;
use Illuminate\Http\Request;
use DB;
use App\Models\Cargo;
use App\Services\CargoService;
use App\Response\SuccessResponse;
use PhpParser\Node\Stmt\TryCatch;


class CargoController extends Controller
{
    // Mostrar todos los cargos
    public function index()
    { 
        try {
            $service = new CargoService;
            $results = $service->obtenertodosloscargos();

            return SuccessResponse::success($results);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }

    // Mostrar un cargo específico
    public function mostrar($id)
    {
        try {
            $service = new CargoService;
            $result  = $service->obtenerCargoPorId($id);
            
            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }  
    }

    // Crear un nuevo cargo
    public function crear(Request $request)
    {
        try {
            $service = new CargoService;
            $result  = $service->CrearCargo($request);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }

    // Actualizar un cargo existente
    public function actualizar(Request $request, $id)
    {
        try {
            $service = new CargoService;
            $result  = $service->ActualizarCargo($request, $id);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }

    }

    // Eliminar un cargo
    public function eliminar($id)
    {
        try {
            $service = new CargoService;
            $result = $service->EliminarCargo($id);

            return SuccessResponse::success( $result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
    }
}
