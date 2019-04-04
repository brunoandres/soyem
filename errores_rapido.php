<?php
include("conecta.php");

echo '<h3>Errores prestamos rapidos a revisar</h3>';
$query = mysql_query("SELECT * from prestamos where (pagado = 'I' 
and vencimiento < '2018/11/01' and vencimiento < fecha_prestamo and vale_pro='X' and efectivo='' 
and banco='' and proveduria = '' and  lena='' and turismo='' and observaciones = '') group by vale");

echo '<b>Casos totales: '.mysql_num_rows($query).'</b><br><br>';
?>
<table border="1" cellpadding="5" cellspacing ="0" width="100%">
<thead>
<tr>
<th>Afiliado</th>
<th>Legajo</th>
<th>Vale</th><th>vencimiento</th><th>fecha</th><th>cuota</th><th>total cuotas</th>
</tr>
</thead>
<tbody>
<?php
	while($dat = mysql_fetch_array($query)){
		echo '<tr>';
		$afiliado = $dat['afiliado'];
		$dat_a = mysql_fetch_array(mysql_query("SELECT * FROM afiliado WHERE clave = '$afiliado'"));
			echo '<td>'.$dat_a['nombre'].'</td>';
			echo '<td>'.$dat_a['legajo'].'</td>';
			echo '<td>'.$dat['vale'].'</td>';
			echo '<td>'.$dat['vencimiento'].'</td>';
			echo '<td>'.$dat['fecha_prestamo'].'</td>';
			echo '<td>'.$dat['cuota'].'</td>';
			echo '<td>'.$dat['num_cuotas'].'</td>';
		echo '</tr>';
	}
?>
</tbody>
</table>
