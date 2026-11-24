<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//dibuja la plantilla de la vista
//barra de ubicacion logica que nos indica donde estamos
$ubicacion = [
    "pagina principal" => "../../index.php",
    "Personalizar " => "./personalizar.php"

];

//controlador
/**
 * Para que cambie de color al pulsar
 */
if (isset($_POST["guardaColores"])) {

    setcookie("colorFondo", $_POST["fondo"], time() + 3600 * 24 * 30);
    setcookie("colorTexto", $_POST["texto"], time() + 3600 * 24 * 30);

    header("Location: personalizar.php");
    exit();
}

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo()
{
    formulario();
?>
<?php
}

/**
 * Formulario en el que creamos los dos combos con los colores de texto y de fondo y boton guardar
 *
 * @return void
 */
function formulario(){
?>
    <form method="post">

        <label>Color fondo</label>
        <select name="fondo">

            <?php
            foreach (COLORESFONDO as $nombre => $valor) {
                echo "<option value='$valor'>$nombre</option>";
            }
            ?>

        </select>
<br><br>
        <label>Color texto</label>

        <select name="texto">

            <?php
            foreach (COLORESTEXTO as $nombre => $valor) {
                echo "<option value='$valor'>$nombre</option>";
            }
            ?>

        </select>
<br><br>
        <input type="submit" value="Guardar" name="guardaColores">

    </form>
<?php
}
