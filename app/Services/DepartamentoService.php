<?php

namespace App\Services;

use App\Models\Departamento;
use Illuminate\Http\Request;
use DB;
use App\Constants\Message;

class DepartamentoService
{
  
    public function obtenertodoslosdepartamentos()
    {
        return Departamento::all();
    }

  
    public function CrearDepartamentos(Request $request)
    {
        $params = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'activo' => $request->input('activo'),
            'idUsuarioCreacion' => $request->input('idUsuarioCreacion')
        ];

        $sql = '
            INSERT INTO departamentos (codigo, nombre, activo, idUsuarioCreacion)
            VALUES (:codigo, :nombre, :activo, :idUsuarioCreacion)
        ';

        $result = DB::insert($sql, $params);

        if (!$result) {
            throw new \Exception('Error al insertar el departamento.');
        }

        return "Departamento creado con éxito.";
    }

 
    public function ObtenerDepartementoId($id)
    {
        if (empty($id)) {
            return [];
        }

        $params = ['id' => $id];
        $sql    = '
            SELECT 
                * 
            FROM departamentos
            WHERE 
                id = :id
        ';

        $result = DB::select($sql, $params);

        if (empty($result)) {
            throw new \Exception(Message::DEPARTAMENTO_NO_ENCONTRADO);
        }

        return $result;
    }


    public function ActualizarDepartamento(Request $request, $id)
    {
        $departamentoExistente = $this->ObtenerDepartementoId($id);
        if (empty($departamentoExistente)) {
            throw new \Exception('El departamento no existe.');
        }

        $params = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'activo' => $request->input('activo'),
            'id' => $id
        ];

        $sql = '
            UPDATE departamentos
            SET codigo = :codigo, nombre = :nombre, activo = :activo
            WHERE id = :id
        ';

        $result = DB::update($sql, $params);

        if (!$result) {
            throw new \Exception('Error al actualizar el departamento.');
        }

        return "Departamento actualizado con éxito.";
    }

    public function EliminarDepartamento($id)
    {
        $this->ObtenerDepartementoId($id);

        $params = ['id' => $id];
        $sql = '
            DELETE FROM departamentos
            WHERE id = :id
        ';

        $deleted = DB::delete($sql, $params);

        if ($deleted === 0) {
            throw new \Exception('No se pudo eliminar el departamento.');
        }

        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Departamento eliminado correctamente.',
        ];
    }
}
