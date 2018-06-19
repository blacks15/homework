<?php
namespace Clases;

use stdClass;
use Dompdf\Dompdf;
use SimpleExcel\SimpleExcel;

require_once(ARCHIVO_DOMPDF);
require_once(ARCHIVO_EXCEL);

abstract class Utileria{
    private $conf;

    public function getConf() {
        $conf = parse_ini_file(RUTA_RAIZ."/conf.ini");
        return $this->conf;
    }

    public static function utf8EncodeArray($array) {
        $arrayEncode = array();

        foreach($array as $data){
            array_push($arrayEncode, utf8_encode($data));
        }
        return $arrayEncode;
    }

        //USA ESTE METODO SOLO PARA ARCHIVOS DE UN MB O INFERIORES
    public static function getFileBase64($archivo) {
        $archivoBase = new \StdClass();

        $tmpFile = pathinfo($archivo);
        $type = $tmpFile["extension"];
        $data =  base64_encode(file_get_contents($archivo));
        $base64 = 'data:application/' . $type . ';base64,' . $data;

        $archivoBase->extension = $type;
        $archivoBase->file = $base64;
        $archivoBase->name = $tmpFile["filename"];
        $archivoBase->fullName = $tmpFile["filename"] . "." .$type ;
        
        return $archivoBase;
    }
    
        //USA ESTE METODO SOLO PARA ARCHIVOS DE UN MB O INFERIORES
    public static function createPDFBase64($htmlContent, $nombre,$extension) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(utf8_decode($htmlContent));
        $dompdf->setPaper('A4'); // (Opcional) Configurar papel y orientación
        $dompdf->render(); // Generar el PDF desde contenido HTML
        $pdf = self::convertFormatBase64($dompdf->output(),$nombre,$extension); // Obtener el PDF generado

        return $pdf;
    }
    
        //USA ESTE METODO SOLO PARA ARCHIVOS DE UN MB O INFERIORES
    private static function convertFormatBase64($file,  $nombre, $extension) {
        $archivoBase = new \StdClass();

        $data = chunk_split( base64_encode($file) );
        $base64 = 'data:application/' . $extension . ';base64,' . $data;

        $archivoBase->extension = $extension;
        $archivoBase->file = $base64;
        $archivoBase->name = $nombre;
        $archivoBase->fullName = $nombre . "." .$extension ;

        return $archivoBase;
    }

        //CREATE PDF
    public static function createPDF($htmlContent, $nombre, $ruta) {
        $archivoPdf = new \StdClass();

        $dompdf = new Dompdf();
        $dompdf->loadHtml(utf8_decode($htmlContent));
        $dompdf->setPaper('A4'); //(OPCIONAL) CONFIGURAR PAPEL Y ORIENTACIÓN
        $dompdf->render(); //GENERAR EL PDF DESDE CONTENIDO HTML
        $pdf = $dompdf->output(); //OBTENER EL PDF GENERADO
        $rutaPdf =$ruta.'\\'.$nombre.'.pdf';
            //GENERA EL ARCHIVO Y LO COLOCA EN UNA RUTA
        file_put_contents($rutaPdf, $pdf);
        $rutaPublica = str_replace(RUTA_PADRE,"",$rutaPdf);
        $archivoPdf->file = $rutaPublica;
        $archivoPdf->fullName = $nombre.".pdf";
        return $archivoPdf;
    }

        //GENERA UNA PLATILLA BASICA DE EXCEL O CSV, RECIBE UNA MATRIZ, CADA RENGLON DE LA MATRIZ 
        //SE AGREGARA AL OBJETO COMO UNA FILA
    public static function createExcel($nombre,$datos,$extension,$delimitador,$rutaCSV) {
        $archivoCsv= new \StdClass();

        $nombreCompleto = $nombre.".".$extension;
        $excel = new SimpleExcel('csv');

        $excel->writer->setData(
            $datos
        );

        $excel->writer->setDelimiter($delimitador);   
        $excel->writer->saveFile($nombre,$rutaCSV."/".$nombreCompleto); 

        $rutaPublica = str_replace(RUTA_PADRE,"",$rutaCSV);

        $archivoCsv->file = $rutaPublica."/".$nombreCompleto;
        $archivoCsv->fullName = $nombreCompleto;

        return $archivoCsv;
    }

    public static function validarCorreo($correo){      
        $res = true;
            //REMOVER CARACTERES NO PERMITIDOS EN EL EMAIL
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
            
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { //VALIDAR CORREO
            $res = false;
        } 
        return $res;
    }

    public static function limpiarCadena($str){
        $str = trim($str);
        $str = filter_var($str, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES|FILTER_FLAG_ENCODE_AMP);

        $textoLimpio = preg_replace('([^A-Za-z0-9\.\-\_])', '', $str);	     					
		return $textoLimpio;
    }

    public static function getErrorMessage($message){
        preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', utf8_encode($message ), $matches); 
        return "code: ".$matches[2]." Message: ".$matches[3]; 
    }
}