<?php

namespace App\Services;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Constants\Message;
use DB;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
class CargoService
{
    
    public function obtenertodosloscargos()
    {
        return Cargo::all();
    }

    /**
     * Devuelve un Cargo por Id
     * 
     * @param int $cargoId
     * @return array
     */
    public function obtenerCargoPorId($cargoId)
    {
        if (empty($cargoId)) {
            return [];
        }
        
        $params = ['cargoId' => $cargoId];
        $sql    = '
            SELECT 
                * 
            FROM cargos
            WHERE 
                id = :cargoId
        ';
        
        $result = DB::select($sql, $params);

        if (empty($result)) {
            throw new \Exception(Message::CARGO_NO_ENCONTRADO);
        }

        return $result;
    }
    

    public function crearCargo(Request $request)
    {
        $params = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'activo' => $request->input('activo'),
            'idUsuarioCreacion' => $request->input('idUsuarioCreacion')
        ];

    
        $sql = '
            INSERT INTO cargos (codigo, nombre, activo, idUsuarioCreacion)
            VALUES (:codigo, :nombre, :activo, :idUsuarioCreacion)
        ';

    
        $result = DB::insert($sql, $params);

        if (!$result) {
            throw new \Exception('Error al insertar el cargo.');
        }

        return "Cargo creado con éxito.";
    }

  
    
    public function actualizarCargo(Request $request, $id)
    {
        
        $cargoExistente = $this->obtenerCargoPorId($id);
        if (empty($cargoExistente)) {
            throw new \Exception('El cargo no existe.');
        }

        $params = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'activo' => $request->input('activo'),
            'id' => $id
        ];

        $sql = '
            UPDATE cargos
            SET codigo = :codigo, nombre = :nombre, activo = :activo
            WHERE id = :id
        ';

        $result = DB::update($sql, $params);

        if (!$result) {
            throw new \Exception('Error al actualizar el cargo.');
        }

        return "Cargo actualizado con éxito.";
    }


   
    public function EliminarCargo($id)
    {
       
        $this->obtenerCargoPorId($id); 
    
        $params = ['id' => $id];
        $sql = '
            DELETE FROM cargos
            WHERE id = :id
        ';
        
        $deleted = DB::delete($sql, $params); 
        if ($deleted === 0) {
            throw new \Exception('No se pudo eliminar el cargo.');
        }
        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Cargo eliminado correctamente.',
        ];
    }
}
