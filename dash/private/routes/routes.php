<?php
    use app\http\Post;
    
    header("Access-Control-Allow-Origin: *");
    header('content-type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, X-CLIENT-ID, X-CLIENT-SECRET');
    header('Access-Control-Allow-Credentials: true');
    
    require_once( dirname( dirname(__DIR__) ).'/rutas.php' );
    require_once(RUTA_HTTP."/post.php");
    require_once(RUTA_CLASES.'/Mensajes.php');

    print ( json_encode( Post::json($_REQUEST) ) );