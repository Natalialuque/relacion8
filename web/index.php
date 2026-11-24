<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("RELACION 8");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista cabecera donde podemos ver otros enlaces 
function cabecera() 
{
    /** */
}

//vista
function cuerpo()
{
?>
    <br><br>
     <h3 id="TituloCuerpo">Ejercicios</h3>
    <ul>
        

    </ul>   
   
    
<?php
}
