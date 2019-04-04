<?php
include("conecta.php");
mysql_query("update afiliado set activo = 'sa' where (afiliacion > '0000-00-00' and activo = 'no')");
mysql_query("update afiliado set activo = 'no' where (afiliacion > '0000-00-00' and activo = 'si')");
mysql_query("update afiliado set activo = 'si' where (afiliacion > '0000-00-00' and activo = 'sa')");
echo 'Listo';
?>