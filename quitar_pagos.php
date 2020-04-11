<?php
include ("conecta.php");
include ("auditoria.php");

$id_pagos = $_GET['id_pagos'];
mysql_query("delete from pagos where id_pagos = '$id_pagos'");
auditar($query);
$nro = $_GET['nro_as'];
mysql_query("delete from asientos where nro = '$nro'");
auditar($query);
header ("location: pagos.php");
exit();
?>