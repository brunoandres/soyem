<?php

include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];

$request=$_REQUEST;
$col =array(
    0   =>  'rec_id',
    1   =>  'rec_nro',
    2   =>  'rec_fecha',
    3   =>  'rec_nombre'
);  //create column like table in database
$sql ="select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto = conceptos_recibos.cr_id ";
$query=mysql_query($sql);
$totalData=mysql_num_rows($query);
$totalFilter=$totalData;
//Search
$sql ="select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto = conceptos_recibos.cr_id WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (rec_nro Like '".$request['search']['value']."%' ";
    $sql.=" OR rec_fecha Like '".$request['search']['value']."%' ";
    $sql.=" OR rec_nombre Like '".$request['search']['value']."%' ";
    $sql.=" OR cr_name Like '".$request['search']['value']."%' )";
}
$query=mysql_query($sql);
$totalData=mysql_num_rows($query);
//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";
$query=mysql_query($sql);
$data=array();
while($row=mysql_fetch_array($query)){
    $subdata=array();
    if($row[17]=='S'){
     
        $nombre = $row[3].'<div class="anular">Anulado</div>';
    }else{
        $nombre = $row[3];
    }

    if($row[17]=='N'){
      $link = '<a href="anular_recibo.php?rec_id='.$row[0].'&vuelta=ingresos.php" title="Anular este Recibo" class="anular" onclick="return confirmar(';
      $link.="'¿Está seguro que desea anular eate recibo? Esta operacion no se puede deshacer'";
      $link.=')" >Anular';
      $link.='</a></td>';
    }else{
        $link="";
    }

    
    $subdata[]=$row[1]; //id
    $subdata[]=substr($row[2],8,2).'/'.substr($row[2],5,2).'/'.substr($row[2],0,4); //fecha
    $subdata[]=$nombre; //nombre
    $subdata[]=$row[19]; //concepto
    $subdata[]='$ '.$row[9]; // importe
    $subdata[]='<a href="detalle_recibo.php?rec_id='.$row[0].'" title="ver detalles del recibo '.$row[0].'" class="ver">Ver</a>';
                

    $subdata[]=$link;
     
    $data[]=$subdata;
}
$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);
echo json_encode($json_data);
?>