<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

/**
  * IMPORTANTE --> Para que el contador funcione debe de estar arriba del todo porque las cookies funcionan mediante
  * cabeceras HTTP, igual que header(), Si ya se ha enviado cualquier HTML al navegador, php no puede enviar las cookies
  */
if (isset($_COOKIE["contador"])) {
    //para sumar de uno en uno
    $contador = $_COOKIE["contador"] + 1;
} else {
    $contador = 1;
}

setcookie("contador", $contador, time() + 365 * 24 * 60 * 60);

//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "Index Personalizar"=> "./index.php",
 
 ];

 ?>
 <!-- DEBEMOS LLAMAR A LOS ESTILOS PARA QUE SE APLIQUEN -->
<style>
#documento{
    background-color: <?= $colorFondo ?>;
    color: <?= $colorTexto ?>;
}

</style>
<?php

cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION",$ubicacion);
cuerpo($contador); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($contador)
{
?>
    <p>Hola, esta es mi página index de la carpeta personalizar.</p>
    <p>Has visitado esta página <?= $contador ?> veces.</p>
<?php
}