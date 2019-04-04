<?php
if(!empty($_GET['id'])){

    $fecha = $_GET['id'];
    //DB details

    include("secure3.php");
    include("conecta.php");
    //get content from database
    $query = mysql_query("SELECT * FROM asientos where YEAR(fecha) = $fecha order by fecha asc limit 10");
    $count = mysql_num_rows($query);

    

    if($count > 0){
        
        while($dat=mysql_fetch_array($query)){
        echo '<h4>'.$dat['nro'].'</h4>';
        echo '<p>'.$dat['fecha'].'</p>';
    }
    }else{
        echo 'Content not found....';
    }
}else{
    echo 'Content not found....';
}
?>