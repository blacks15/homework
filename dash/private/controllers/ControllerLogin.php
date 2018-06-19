<?php
namespace Controllers;

use Clases\Utileria;
use App\Log\Logger;
use Bussiness\LoginBussiness;
use utf8_encode;
use Exception;

require(RUTA_LOG.'/Logger.php');
require(RUTA_CLASES.'/Utileria.php');
require(RUTA_BUSSINESS.'/LoginBussiness.php');
/*
    AUTOR: Felipe Monzón Mendoza
    FECHA: 12-MAYO-2018
    DESCRIPCIÓN: Controller para Inicio de Session
*/
class ControllerLogin {
    public function login(){
        Logger::log('entro metodo login', 2);
        $response = array();
        $login = new \stdClass();
        try {
            $login = json_decode( trim($_POST['cadena']) );

            $login->usuario = addslashes($login->usuario);
            $login->password = addslashes($login->password);

            $login->usuario = Utileria::limpiarCadena($login->usuario);
            $login->password = Utileria::limpiarCadena($login->password);

            if (!isset($login->usuario,$login->password) ) {
                $response = array('codRetorno' => '004',
					'titulo' => 'Advertencia',
                    'mensaje' => ERROR_GENERAL
                );
                Logger::log('Metodo: login, Codigo: '.$response['codRetorno'].' Mensaje: '.PARAMETROS_VACIOS, 3);
                return $response;
            }

            $response = LoginBussiness::validaLogin($login);

        } catch(\Exception $e){
            Logger::log("Metodo: login, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }
        return $response;
    }
}