<?php 
include("conecta.php");
include("auditoria.php");
$legajo = (int)$_GET['legajo'];
$id_fam = (int)$_GET['id_fam'];
$kit = $_GET['kit'];
$entregado = 0;

$query = "DELETE FROM `legajos_utiles` WHERE id_familiar = $id_fam and legajo = $legajo";
$ejecuto = mysql_query($query);

if (!$ejecuto) {
    $msj = mysql_error();
    header("location:listado_utiles.php?$msj");
    
}else{

    auditar($query);
    $url = "listado_utiles.php?legajo=".$_GET['legajo'];
    header("location:$url");

}

?>