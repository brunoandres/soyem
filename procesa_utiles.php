<?php 
include("conecta.php");
include("auditoria.php");
$legajo = (int)$_GET['legajo'];
$id_fam = (int)$_GET['id_fam'];
$kit = $_GET['kit'];
$entregado = 1;
$usuario = $_GET['usuario'];

//Verificar que no exista registro de util entregado al mismo familiar

$sql = "select * from legajos_utiles where legajo = $legajo and id_familiar = $id_fam and entregado = 1";
$ejecuto = mysql_query($query);

if(!mysql_num_rows($ejecuto) >= 1){
    $query = "INSERT INTO `legajos_utiles`(`legajo`, `id_familiar`, `kit`, `entregado`, `usuario_entrega`) VALUES ($legajo,$id_fam,'$kit',$entregado,'$usuario')";
    $ejecuto = mysql_query($query);

    if (!$ejecuto) {
        $msj = mysql_error();
        header("location:listado_utiles.php?$msj");
        
    }else{ 
        auditar($query);
        $url = "listado_utiles.php?legajo=".$_GET['legajo'];
        header("location:$url"); 
    }
}else{
    header("location:listado_utiles.php?error=duplicado");
}
?>