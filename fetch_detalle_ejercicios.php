<?php

include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];

$request=$_REQUEST;
$col =array(
    0   =>  'id_a',
    1   =>  'nro',
    2   =>  'fecha',
    3   =>  'cuenta'
);  //create column like table in database
$sql ="select a.id_a,a.nro,DATE_FORMAT(STR_TO_DATE(a.fecha,'%Y-%m-%d'), '%d/%m/%Y') as fecha,a.debe,a.haber,b.cuenta,a.cuenta,a.activo from asientos a INNER JOIN cuentas b on a.cuenta = b.id_cuentas where year(a.fecha) = '".$_POST['valor']."' group by a.nro order by a.id_a asc ";
$query=mysql_query($sql);
$totalData=mysql_num_rows($query);
$totalFilter=$totalData;
//Search
$sql ="select a.id_a,a.nro,DATE_FORMAT(STR_TO_DATE(a.fecha,'%Y-%m-%d'), '%d/%m/%Y') as fecha,a.debe,a.haber,b.cuenta,a.cuenta,a.activo from asientos a INNER JOIN cuentas b on a.cuenta = b.id_cuentas where year(a.fecha) = '".$_POST['valor']."' ";
if(!empty($request['search']['value'])){
    $sql.=" AND (a.nro Like '%".$request['search']['value']."%' ";
    $sql.=" OR DATE_FORMAT(STR_TO_DATE(a.fecha,'%Y-%m-%d'), '%d/%m/%Y') Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.debe Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.haber Like '%".$request['search']['value']."%' ";
    $sql.=" OR b.cuenta Like '%".$request['search']['value']."%') ";
    
}
$sql.=" group by a.nro";
$query=mysql_query($sql);
$totalData=mysql_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysql_query($sql);
$data=array();
while($row=mysql_fetch_array($query)){
    $subdata=array();
     
    $subdata[]=$row[1]; //id
    //$subdata[]=substr($row[2],8,2).'/'.substr($row[2],5,2).'/'.substr($row[2],0,4); //fecha
    $subdata[]=$row[2];
    $subdata[]=$row[5]; //cuenta
    $subdata[]='$ '.$row[3]; //concepto
    $subdata[]='$ '.$row[4]; // importe
    $subdata[]=$row[7]; // activo
            
     
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