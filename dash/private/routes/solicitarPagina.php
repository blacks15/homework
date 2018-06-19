<?php
    header("Content-Type: text/html");
    require_once( dirname( dirname(__DIR__) ).'/rutas.php' );
    require(RUTA_HTTP."/get.php");
    
    use app\http\Get;
    
    Get::View($_GET );
