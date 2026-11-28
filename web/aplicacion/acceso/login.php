<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
//barra de ubicacion logica que nos indica donde estamos
$ubicacion = [
    "pagina principal" => "../../index.php",
    "Login" => "./login.php"
];

 /**
  * CONTROLADOR
  */
 //porque es lo unico que nos interesa recordar 
 $datos=[
    "usuario"=>""
 ];

 $errores=[];

 if (isset($_POST["registro"])) {

    // Recoger datos
    $nick= trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasenia"] ?? "";
    $datos["usuario"] = $nick;

    //Validar que no estén vacíos
    if ($nick === "") {
        $errores["usuario"][] = "Debes indicar el usuario";
    }
    if ($contrasena === "") {
        $errores["contrasenia"][] = "Debes indicar la contraseña";
    }

    //Si no hay errores, comprobar en la ACL
    if (!$errores) {
       

        if ($acl->esValido($nick, $contrasena)) {

            //Obtener los datos del usuario desde la ACL
            $codUsuario = $acl->getCodUsuario($nick);
            $nombre= $acl->getNombre($codUsuario);
            $permisos= $acl->getPermisos($codUsuario);

            //Guardar en sesión con Acceso
            $acceso->registrarUsuario($nick, $nombre, $permisos);

            //Redirigir
            header("Location: ../../index.php");
            exit;

        } else {
            $errores["login"][] = "Usuario o contraseña incorrectos";
        }
    }
}

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION",$ubicacion);
cuerpo($errores,$datos); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo(array $errores,array $datos)
{
?>
<?php
formulario($errores,$datos);
}

/**
 * Formullario para el nick y la cotraseña
 *
 * @return void
 */
function formulario( array $errores,array $datos){
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }

?>

    <form action="" method="post">
        <label for="">Usuario</label>
        <input type="text" name="usuario" id="usuario"  value="<?= $datos["usuario"] ?>"><br>
        <label for="">Contraseña</label>
        <input type="password" name="contrasenia" id="contrasenia"><br>
        <input type="submit" value="Login" name="registro">
    </form>

    <?php

}