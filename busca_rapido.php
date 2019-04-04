<?php
include("conecta.php");
$tx = "select * from afiliado where activo = 'si' and legajo = ".$_GET['blegajo'];
$a = mysql_fetch_array(mysql_query($tx));
echo $a['nombre'].'|'.$a['clave'];
?>