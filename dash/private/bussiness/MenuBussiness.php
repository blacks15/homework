<?php
namespace Bussiness;

use Models\ModelMenu;
use Exception;

require(RUTA_MODELS.'/ModelMenu.php');

session_start();

abstract class MenuBussiness {
    public static function creaMenu($usuario){

    }
}