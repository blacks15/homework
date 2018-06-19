<?php
namespace Bussiness;

use Models\ModelLogin;
use App\Jwt\JWTService;
use Exception;

require(RUTA_MODELS.'/ModelLogin.php');
require(RUTA_CLASES.'/JWTService.php');

session_start();

abstract class LoginBussiness {
    public static function validaLogin($login){
        $response = array();
        try {
            if (!isset($_SESSION['intentos']) ) {
				$_SESSION['intentos'] = 0; 
				$_SESSION['usuario'] = ""; 
			} else if ($_SESSION['intentos'] > 3 && $_SESSION['usuario'] == $login->usuario) {
                LoginModel::bloquearUsuario($login->usuario);
				$response['mensaje'] = USUARIO_BLOQUEADO;
				return $response;
				exit();
            }
            
            $datosUsuario = ModelLogin::consultarUsuario($login);

            if ( $datosUsuario['codRetorno'] == '000' ) {
                $jwt = JWTService::createJWT($datosUsuario);

                $decode = JWTService::checkJWT($jwt['jwt']);

                $response = array('codRetorno' => '000',
                    'jwt' => $jwt,
                    'titulo' => 'Bienvenido',
                    'mensaje'=> $datosUsuario['nombreEmpleado'],
                );
            } else {
                $this->intentosLogin($login->usuario );
            }
        } catch(\Exception $e){
            Logger::log("Metodo: login, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }

        return $response;
    }

    private static function validaPassword($password,$usuario){
        $isValido = false;
        try {
            $password = filter_var($password,FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES|FILTER_FLAG_ENCODE_AMP);
            
            if (!empty($password)) {
                if ( crypt($password,$usuario['password']) == $usuario['password'] ) {
                    $isValido = true;
                }
            }
        } catch(\Exception $e){
            Logger::log("Metodo: validaPassword, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }
        return $isValido;
    }

    private static function intentosLogin($usuario){
        try {
            $_SESSION['intentos'] += 1;
            $_SESSION['usuario'] = $usuario;

            $response = array('codRetorno' => '002',
                'mensaje' => ERROR_LOGIN
            );
        } catch(\Exception $e){
            Logger::log("Metodo: validaPassword, ".Utileria::getErrorMessage($e->getMessage() ),1);
            $response = array(Utileria::getErrorMessage($e->getMessage()) ) ;
        }
    }
}
