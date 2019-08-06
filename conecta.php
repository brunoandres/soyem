<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$conn=mysql_connect ("mysql.hostinger.com.ar", "u359426750_soyem", "sistemasoyem2019") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_set_charset('utf8',$conn);
mysql_select_db ("u359426750_soyem");
?>
