<?php
include("conecta.php");
$query = mysql_query("select * from asientos where (fecha = '2016-10-06' and detalle like '%Prestamo para TURISMO%') order by id_a desc");
while($a = mysql_fetch_array($query)){
	$id_a = $a['id_a'];
	echo '<br>';
	echo $a['detalle'];
	if ($a['cuenta']==36){
	mysql_query("update asientos set cuenta = '59' where id_a ='$id_a'");
	}
}

?>