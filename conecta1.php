<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$conn=mysql_connect ("localhost", "soyem", "vMis823rWf") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("soyem_resoluciones");
?>
