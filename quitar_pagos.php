<?php
include ("conecta.php");
$id_pagos = $_GET['id_pagos'];
mysql_query("delete from pagos where id_pagos = '$id_pagos'");
$nro = $_GET['nro_as'];
mysql_query("delete from asientos where nro = '$nro'");
header ("location: pagos.php");
exit();
?>