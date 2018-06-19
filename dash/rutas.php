<?php
        //CARPETAS
    define('RUTA_PADRE',dirname( dirname(__FILE__) ));
    define('RUTA_RAIZ', __DIR__);
    define('RUTA_ERRORES',__DIR__.'/errores');
    define('RUTA_PRIVATE',__DIR__.'/private');
    define('RUTA_ROUTES',__DIR__.'/private/routes');
    define('RUTA_VIEWS',__DIR__.'/private/views');
    define('RUTA_CONF',__DIR__.'/private/config');
    define('RUTA_CLASES',__DIR__.'/private/clases');
    define('RUTA_MODELS',__DIR__.'/private/models');
    define('RUTA_CONTROLLERS',__DIR__.'/private/controllers');
    define('RUTA_BUSSINESS',__DIR__.'/private/bussiness');
    define('RUTA_RECURSOS',__DIR__.'/private/resources');
    define('RUTA_IMGS',__DIR__.'/private/resources/images');
    define('RUTA_HTTP',__DIR__.'/private/app/http');
    define('RUTA_XML',__DIR__.'/private/app/routesviews');
    define('RUTA_JWT',__DIR__.'/private/app/jwt');
    define('RUTA_LOG',__DIR__.'/private/app/log');
    define('RUTA_SAVE_LOG',__DIR__.DIRECTORY_SEPARATOR.'LOG');
    define('RUTA_PUBLIC_IMAGES',__DIR__.'/public/resources/images ');
        //ARCHIVOS
    define('ARCHIVO_INI',__DIR__.'/env.ini');
    define('ARCHIVO_XML',__DIR__.'/private/app/routesviews/views.xml');
    define('ARCHIVO_CONECTION',__DIR__.'/private/app/database/Conexion.php');
        //LIBRERIAS
    define('ARCHIVO_DOMPDF',__DIR__.'/private/app/dompdf/autoload.inc.php');
    define('ARCHIVO_EXCEL',__DIR__.'/private/app/SimpleExcel/SimpleExcel.php');