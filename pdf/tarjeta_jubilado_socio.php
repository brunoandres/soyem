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

$pdf->SetMargins(2, 0);
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,"LEGAJO: ".$data['legajo'],0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10,strtoupper($data['nombre']),0,0,'L');
$pdf->Ln(4);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,strtoupper($data['domicilio']),0,0,'L');
$pdf->Ln(4);
$pdf->Cell(0,10,"NRO IPROSS ".strtoupper($data['ipross']),0,0,'L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',8);
$txf = "select * from familiares where id_af = ".$clave." and activo='si'";
	$qfam = mysql_query($txf);
	while($afam = mysql_fetch_array($qfam)){
		switch ($afam['tipo']) {
			case 'H':
				$relacion = 'HIJO/A';
				break;
			case 'C':
				$relacion = 'CONYUGE';
				break;
			case 'O':
				$relacion = 'OTRA';
				break;
		}
$pdf->Cell(0,10,$relacion.": ".strtoupper($afam['nombre']),0,0,'L');
$pdf->Ln(3);
	}
	$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,"IMPRESO EL ".date("d-m-Y"),0,0,'L');
$pdf->Output();
mysql_query("insert into imp_tarjetas (it_clave,it_tar) values ('$clave','3')");
?>