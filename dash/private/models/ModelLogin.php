<?php
namespace Models;

use App\Database\Conexion;
use PDO;
use PDOStatement;
use PDOException;
use Exception;

require_once(ARCHIVO_CONECTION);

abstract class ModelLogin {
        //QUERYS

    public static function consultarUsuario($datos) {
        try {
            //$db = new Conexion('mysql');
            
            if ($datos->usuario == 'felipe') {
                $response = array('nombre_usuario' => 'felipe',
                    'matricula_empleado' => '3312',
                    'nombreEmpleado' => strtoupper('felipe monzon'),
                    'perfil' => '1',
                    'codRetorno' => '000'
                );
            } else {
                $response = array('codRetorno' => '001');
            }
        } catch(\PDOException $e){
            Logger::log("Metodo: consultarUsuario, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        } catch (\Exception $e) {
            Logger::log("Metodo: consultarUsuario, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }

        return $response;
    }
}