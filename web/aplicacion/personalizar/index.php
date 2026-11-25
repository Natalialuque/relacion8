<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "Index Personalizar"=> "./index.php",
 
 ];

$datos=[];

/**
 * Debemos comprobar primero si las cookies existen y si n asignamos por defecto blanco y negro
 * Ademas verificamos que el color este asignado en el array de la cabecera
 */

//Fondo
if(isset($_COOKIE["colorFondo"]) && in_array($_COOKIE["colorFondo"], COLORESFONDO, true)){
    $datos["colorFondo"]=$_COOKIE["colorFondo"];
}else{
    $datos["colorFondo"]="white";
}

//Texto
if(isset($_COOKIE["colorTexto"])&& in_array($_COOKIE["colorTexto"], COLORESTEXTO, true)){
    $datos["colorTexto"]=$_COOKIE["colorTexto"];
}else{
    $datos["colorTexto"]="black";
}

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

setcookie("contador", $contador);


////////////////////////////////////////////////////////////////////////
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera($datos);
finCabecera();
inicioCuerpo("2DAW APLICACION",$ubicacion);
cuerpo($contador); //llamo a la vista
finCuerpo();
//////////////////////////////////////////////////////////////////////////////
//vista cabecera donde podemos ver otros enlaces 
function cabecera(array $datos) {
?>
<style>
#documento{
    background-color: <?= $datos["colorFondo"] ?>;
    color: <?= $datos["colorTexto"]  ?>;
}

</style>

<?php
}
//vista
function cuerpo(int $contador)
{
    ?>
    <br><br>
    <?php
    echo "pagina index <br>";
    echo "Has visitado esta página $contador veces.".PHP_EOL;
}