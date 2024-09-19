<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Response\SuccessResponse;
use App\Response\ErrorResponse;
use App\Services\DepartamentoService;

class DepartamentoController extends Controller
{
     // Mostrar todos los departamentos
     public function index()
     {
        try {
            $departamentos = Departamento::all();
            return SuccessResponse::success($departamentos);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
     }
 
     // Mostrar un departamento específico
     public function mostrar($id)
     {
        try {
            $service = new DepartamentoService;
            $result  = $service->ObtenerDepartementoId($id);
            
            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }  
     }
 
     // Crear un nuevo departamento
     public function crear(Request $request)
     {
        try {
            $service = new DepartamentoService;
            $result  = $service->CrearDepartamentos($request);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
     }
 
     // Actualizar un departamento existente
     public function actualizar(Request $request, $id)
     {
        try {
            $service = new DepartamentoService;
            $result  = $service->ActualizarDepartamento($request, $id);

            return SuccessResponse::success($result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
     }
 
     // Eliminar un departamento
     public function eliminar($id)
     {
        try {
            $service = new DepartamentoService;
            $result = $service->EliminarDepartamento($id);

            return SuccessResponse::success( $result);
        } catch (\Exception $e) {
            return ErrorResponse::error($e);
        }
     }
}
