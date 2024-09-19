<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Constants\Message;

class UserService
{

    public function ObtenerTodosLosUsuarios()
    {
        return User::all();
    }

  
    public function CrearUsuario(Request $request)
    {
        $params = [
            'usuario' => $request->input('usuario'),
            'primerNombre' => $request->input('primerNombre'),
            'segundoNombre' => $request->input('segundoNombre'),
            'primerApellido' => $request->input('primerApellido'),
            'segundoApellido' => $request->input('segundoApellido'),
            'idDepartamento' => $request->input('idDepartamento'),
            'idCargo' => $request->input('idCargo')
        ];

        $sql = '
            INSERT INTO users (usuario, primerNombre, segundoNombre, primerApellido, segundoApellido, idDepartamento, idCargo)
            VALUES (:usuario, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :idDepartamento, :idCargo)
        ';

        $result = DB::insert($sql, $params);

        if (!$result) {
            throw new \Exception(Message::USUARIO_NO_REGISTRADO);
        }

        return "Usuario creado con éxito.";
    }

    
    public function ObtenerUsuarioId($id)
    {
        if (empty($id)) {
            return [];
        }

        $params = ['id' => $id];
        $sql = '
            SELECT 
                * 
            FROM users
            WHERE 
                id = :id
        ';

        $result = DB::select($sql, $params);

        if (empty($result)) {
            throw new \Exception(Message::USUARIO_NO_ENCONTRADO);
        }

        return $result;
    }

  
    public function ActualizarUsuario(Request $request, $id)
    {
        $usuarioExistente = $this->ObtenerUsuarioId($id);
        if (empty($usuarioExistente)) {
            throw new \Exception('El usuario no existe.');
        }

        $params = [
            'usuario' => $request->input('usuario'),
            'primerNombre' => $request->input('primerNombre'),
            'segundoNombre' => $request->input('segundoNombre'),
            'primerApellido' => $request->input('primerApellido'),
            'segundoApellido' => $request->input('segundoApellido'),
            'idDepartamento' => $request->input('idDepartamento'),
            'idCargo' => $request->input('idCargo'),
            'id' => $id
        ];

        $sql = '
            UPDATE users
            SET usuario = :usuario, primerNombre = :primerNombre, segundoNombre = :segundoNombre,
                primerApellido = :primerApellido, segundoApellido = :segundoApellido,
                idDepartamento = :idDepartamento, idCargo = :idCargo
            WHERE id = :id
        ';

        $result = DB::update($sql, $params);

        if (!$result) {
            throw new \Exception('Error al actualizar el usuario.');
        }

        return "Usuario actualizado con éxito.";
    }

  
    public function EliminarUsuario($id)
    {
        $this->ObtenerUsuarioId($id);

        $params = ['id' => $id];
        $sql = '
            DELETE FROM users
            WHERE id = :id
        ';

        $deleted = DB::delete($sql, $params);

        if ($deleted === 0) {
            throw new \Exception('No se pudo eliminar el usuario.');
        }

        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario eliminado correctamente.',
        ];
    }
    
}
