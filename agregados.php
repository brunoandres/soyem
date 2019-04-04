<?php
include("conecta.php");
mysql_query("ALTER TABLE afiliado ADD COLUMN telefono varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL");
mysql_query("ALTER TABLE afiliado ADD COLUMN correo varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL");
mysql_query("ALTER TABLE afiliado ADD COLUMN sector varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL");
mysql_query("ALTER TABLE afiliado ADD COLUMN sueldo FLOAT NOT NULL");
mysql_query("ALTER TABLE afiliado ADD COLUMN observaciones BLOB NOT NULL");
mysql_query("ALTER TABLE afiliado ADD COLUMN vencimiento DATE NOT NULL");
mysql_query("ALTER TABLE familiares ADD COLUMN activo varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT  'si'");
echo "listo";
?>