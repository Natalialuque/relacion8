<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
//barra de ubicacion logica que nos indica donde estamos
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "Ver textos"=> "./verTextos.php"

 ];

/**
 * CONTROLADOR
 */
$errores = [];

//Recogemo los textos de la sesión (o array vacío si no hay)
$textos = $_SESSION["textos"] ?? [];

//Botón REGISTRAR
if (isset($_POST["registrar"])) {
    $texto = trim($_POST["texto"] ?? "");

    if ($texto === "") {
        $errores[] = "Debes escribir un texto.";
    } else {
        $textos[] = new RegistroTexto($texto);   // añado al array
        $_SESSION["textos"] = $textos;           // actualizo la sesión
        header("Location: verTextos.php");       
        exit;
    }
}

/**
 * BOTON LIMPIAR --> Se encarga de borrar todo el text area
 */
if (isset($_POST["limpiar"])) {
    $textos = [];
    $_SESSION["textos"] = $textos;  // vacío la sesión, NO la destruyo
    header("Location: verTextos.php");
    exit;
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION",$ubicacion);
cuerpo($textos,$errores); //llamo a la vista
finCuerpo();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function cabecera() {}

//vista
function cuerpo(array $textos, array $errores)
{
    foreach ($errores as $error)
        echo "<p><strong>" . htmlspecialchars($error) . "</strong></p>";

    formulario();
    echo "<br>";
    mostrarTextos($textos);
}

function formulario()
{
?>
    <form method="post">
        <label for="texto">Texto:</label>
        <input type="text" name="texto" id="texto">
        <input type="submit" name="registrar" value="Registrar">
    </form>
<?php
}

function mostrarTextos(array $textos){
?>
    <form method="post">
        <textarea rows="10" cols="60" readonly><?php
            foreach ($textos as $registro) {
                echo $registro->getFechaHora()->format("d/m/Y H:i:s") . " - " . $registro->getCadena() . PHP_EOL;
            }
        ?></textarea>
        <br>
        <input type="submit" name="limpiar" value="Limpiar">
    </form>
<?php
}