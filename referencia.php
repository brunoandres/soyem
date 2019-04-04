<?php
set_time_limit(0);
include("conecta.php");
$encero = mysql_num_rows(mysql_query("select * from afiliado where legajo = 0"));
echo $encero.'<br>';
$qd = mysql_query("select legajo, COUNT(*) from afiliado group by legajo");
while($row = mysql_fetch_array($qd)){
	if ($row['COUNT(*)']>1){
	echo "There are ". $row['COUNT(*)'] ." ". $row['legajo'] ." items.";
	echo "<br />";
	}
}
echo 'fin';
?>