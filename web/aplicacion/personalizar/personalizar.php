<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//barra de ubicacion logica que nos indica donde estamos
$ubicacion = [
    "pagina principal" => "../../index.php",
    "Personalizar " => "./personalizar.php"

];

//verificamos que haya usuario
if (!$acceso->hayUsuario()) {
    header("Location: /aplicacion/acceso/login.php");
    exit;
}

//verificamos que haya usuario y si no redirigimos
if(!$acceso->puedePermiso(1)){
     paginaError("No tienes permiso para acceder a esta página");
     exit;
}

//creammos sesion 
if(isset($_POST["cerrarSesion"])) $acceso->quitarRegistroUsuario();


/**
 * CONTROLADOR
 */

$errores=[];
$datos=[];

/**
 * Debemos comprobar primero si las cookies existen y si no asignamos por defecto blanco y negro
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
 * LO QUE SUCEDE AL PULSAR GUARDAR--> Se aplican los colores selecionados en el documento 
 */
if (isset($_POST["guardaColores"])) {

    $fondo = $_POST["colorFondo"] ?? "";
    $texto = $_POST["colorTexto"] ?? "";

    // Validamos --> el valor tiene que ser uno de los de las constantes
    if (!in_array($fondo, COLORESFONDO, true))
        $errores[] = "El color de fondo no es válido.";
    if (!in_array($texto, COLORESTEXTO, true))
        $errores[] = "El color del texto no es válido.";
    if (empty($errores) && $fondo === $texto)
        $errores[] = "El fondo y el texto no pueden ser del mismo color.";

    //Si no hay errores -->
   if (empty($errores)) {
        //actualizacion de la cokie nueva
        $caduca = time() + 60 * 60 * 24 * 30;

        setcookie("colorFondo", $fondo, $caduca);
        setcookie("colorTexto", $texto, $caduca);

        header("Location: personalizar.php");
        exit();
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera($datos);
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($datos,$errores); //llamo a la vista
finCuerpo();
///////////////////////////////////////////////////////////////////////////////////////////
////vista cabecera donde podemos ver otros enlaces 

/**
 *FUNCION CABECERA --> En esta funcion debemos pasar el <style> que va ir modificando el codigo
 * @param array $datos
 * @return void
 */
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
function cuerpo(array $datos, array $errores)
{
    //recorremos errores
    foreach ($errores as $error)
        echo "<p><strong>" . htmlspecialchars($error) . "</strong></p>";
    //formulario
    formulario($datos);
?>

<?php

}

/**
 * FUNCION FORMULARIO --> Formulario en el que creamos los dos combos con los colores de texto y de fondo y boton guardar
 *
 * @return void
 */
function formulario(array $datos){
?>
    <form method="post">
        <label for="colorFondo">Color de fondo:</label>
        <select name="colorFondo" id="colorFondo">
            <?php 
            foreach (COLORESFONDO as $nombre => $valor) { ?>
                <option value="<?= $valor ?>" <?= ($valor === $datos["colorFondo"]) ? "selected" : "" ?>>
                    <?= $nombre ?>
                </option>
            <?php 
            } 
            ?>
        </select>
        <br><br>

        <label for="colorTexto">Color del texto:</label>
        <select name="colorTexto" id="colorTexto">
            <?php 
            foreach (COLORESTEXTO as $nombre => $valor) { ?>
                <option value="<?= $valor ?>" <?= ($valor === $datos["colorTexto"]) ? "selected" : "" ?>>
                    <?= $nombre ?>
                </option>
            <?php
             } 
             ?>
        </select>
        <br><br>

        <input type="submit" name="guardaColores" value="Guardar">
    </form>
<?php
}
