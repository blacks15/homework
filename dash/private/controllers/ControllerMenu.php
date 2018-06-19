<?php
namespace Controllers;

use Clases\Utileria;
use App\Jwt\JWTService;
use App\Log\Logger;
use utf8_encode;
use Exception;

require(RUTA_LOG.'/Logger.php');
require(RUTA_CLASES.'/Utileria.php');
require(RUTA_CLASES.'/JWTService.php');
require(RUTA_BUSSINESS.'/MenuBussiness.php');
/*
    AUTOR: Felipe Monzón Mendoza
    FECHA: 13-JUNIO-2018
    DESCRIPCIÓN: Controller para Crear Menú Mediante el Perfil
*/
class ControllerMenu {
    public function menu(){
        Logger::log('entro metodo menu', 2);
        $response = array();
        try {
            $datos = json_decode( trim($_POST['cadena']) );

            $jwtService = ( isset($datos->jwt) ) ? JWTService::checkJWT($datos->jwt) : call_user_func(self::class.'::index');
            
            $response = MenuBussiness::creaMenu($jwtService);
        } catch(\Exception $e){
            Logger::log("Metodo: menu, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }
        return $response;
    }

    public static function index(){
        return array("codRetorno" => "002", "mensaje" => ERROR_GENERAL);
    }
}