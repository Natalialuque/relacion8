<?php 
error_reporting(0);
date_default_timezone_set('Europe/Madrid'); //para el tema de las horas 

define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO=="produccion")
    error_reporting(0);
    else 
        error_reporting(E_ALL);  

spl_autoload_register(function ($clase){
    //la carga de la carpeta scripts donde tenemos la carpeta clases 
    $ruta=RUTABASE."/scripts/clases/";
    $fichero=$ruta."$clase.php";
    //
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});

include(RUTABASE."/aplicacion/plantilla/plantilla.php");
include(RUTABASE."/scripts/librerias/validacion.php");


//creo todos los objetos que necesita mi aplicación

/**
 * Dos constantes para los los colores del texto y los colores del fondo
 */
const COLORESTEXTO = [
    "Negro" => "black",
    "Azul" => "blue",
    "Blanco" => "white",
    "Rojo" => "red"
];

const COLORESFONDO = [
    "Blanco" => "white",
    "Rojo" => "red",
    "Verde" => "green",
    "Amarillo" => "yellow",
    "Gris" => "gray"
];
/**
 * Si no existen cookies asignamos estos colores por defecto
 */
$colorFondo = $_COOKIE["fondo"] ?? "white";
$colorTexto = $_COOKIE["texto"] ?? "black";