<?php
namespace App\Database;

use PDO;

class Conexion extends PDO {
    private $conn;
    private $tipo_de_base;
    private $host;
    private $nombre_de_base;
    private $usuario;
    private $contrasena;
    private $port;
    private $error;

	public function __construct($dbname) {
        $this->getConf($dbname);
        try {
            parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
        } catch (PDOException $e){
            $salidaJson = array(
                'error' => $e->getMessage(),
                'isError' => 1
            );
            print ($salidaJson['isError']);
        }
    }

    private function getConf($dbname) {
        $conf = parse_ini_file(ARCHIVO_INI,true);
            //CARGAR CONFIGURACIÓN DEFAULT
        if ($dbname == null || empty($dbname)) {
            $this->tipo_de_base = $conf['database']['driver'];
            $this->host = $conf['database']['server'];
            $this->nombre_de_base = $conf['database']['db'];
            $this->usuario = $conf['database']['user'];
            $this->contrasena = $conf['database']['password'];
            $this->port = $conf['database']['port'];
        } else {
            $this->tipo_de_base = $conf[$dbname]['driver'];
            $this->host = $conf[$dbname]['server'];
            $this->nombre_de_base = $conf[$dbname]['db'];
            $this->usuario = $conf[$dbname]['user'];
            $this->contrasena = $conf[$dbname]['password'];
            $this->port = $conf[$dbname]['port'];  
        }
    }
}
