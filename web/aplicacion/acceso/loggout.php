<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//quitamos el acceso 
$acceso->quitarRegistroUsuario();

//redirigir 
header("Location: ../../index.php");
exit;