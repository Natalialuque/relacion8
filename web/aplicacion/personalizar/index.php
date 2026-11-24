<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "Index Personalizar"=> "./index.php",
 
 ];
 ?>
 <!-- LLAMAMOS A LOS ESTILOS POR DEFECTO Y LO APLICAMOS -->
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
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo()
{
?>
<div id="documento">
    Hola, esta es mi página personalizada.
</div>
<?php
}