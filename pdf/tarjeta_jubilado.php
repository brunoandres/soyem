<?php
require('fpdf.php');
include("../conecta.php");
if(!empty($_GET['clave'])){
$clave=$_GET['clave'];
$data = mysql_fetch_array(mysql_query("select * from afiliado where clave ='$clave'"));
}

class PDF extends FPDF
{
// Cabecera de página


// Pie de página

}

// Creación del objeto de la clase heredada
$pdf = new FPDF('L','mm',array(85,55));
// $pdf = new PDF();

$pdf->SetMargins(5, 5);
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,"LEGAJO: ".$data['legajo'],0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10,strtoupper($data['nombre']),0,0,'L');
$pdf->Ln(4);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,strtoupper($data['domicilio']),0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10,"IMPRESO EL ".date("d-m-Y"),0,0,'L');
$pdf->Output();
?>?>