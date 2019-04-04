<?php
require('fpdf.php');
include("../conecta.php");
if(!empty($_GET['id_pres'])){
$id_pres=$_GET['id_pres'];
$data = mysql_fetch_array(mysql_query("select * from prestaciones where id_pres ='$id_pres'"));
$fecha_a = $data['fecha_pres'];
$tecnico_a = $data['informe_tecnico_pres'];
$id_li_pre=$data['motivo_pres'];
$data_pres = mysql_fetch_array(mysql_query("select * from lis_prestaciones where id_li_pre ='$id_li_pre'"));
$motivo_a = $data_pres['name_pre'];
$jf_id=$data['id_ben_pres'];
$data_ben = mysql_fetch_array(mysql_query("select * from jefes_fam where jf_id ='$jf_id'"));
}
if(!empty($_GET['id_int'])){
$id_pres=$_GET['id_int'];
$data = mysql_fetch_array(mysql_query("select * from intervenciones where id_int ='$id_pres'"));
$fecha_a = $data['fecha_int'];
$tecnico_a = $data['informe_tecnico_int'];
$id_li_int=$data['motivo_int'];
$data_pres = mysql_fetch_array(mysql_query("select * from lis_intervenciones where id_li_int ='$id_li_int'"));
$motivo_a = $data_pres['name_int'];
$jf_id=$data['id_ben_int'];
$data_ben = mysql_fetch_array(mysql_query("select * from jefes_fam where jf_id ='$jf_id'"));
}
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../recortes/logo.png',8,8);
    // Arial bold 15
	 $this->Ln(20);
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'Dictamen Social',0,0,'C');
    // Salto de línea
    $this->Ln(10);
	$this->SetFont('times','I',13);
	$this->Cell(0,10,'Instituto Municipal de Tierra y Vivienda para el Habitat Social de San Carlos de Bariloche',0,0,'C');
	 $this->Ln(15);
}

// Pie de página

}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'1. Datos Generales:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Id: '.$id_pres);
$pdf->SetX(40);
$pdf->Cell(40,10,'Solicitud: '.$motivo_a);
$pdf->SetX(-80);
$pdf->Cell(40,10,'Fecha de Intervención: '.substr($fecha_a,8,2).'-'.substr($fecha_a,5,2).'-'.substr($fecha_a,0,4));
$pdf->Ln(20);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'2. Datos Domiciliarios',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Calle: '.$data_ben['jf_calle']);
$pdf->SetX(80);
$pdf->Cell(40,10,'Nro: '.$data_ben['jf_nro']);
$pdf->SetX(-80);
$pdf->Cell(40,10,'Barrio: '.$data_ben['jf_barrio']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Sector: '.$data_ben['jf_sector']);
$pdf->SetX(80);
$pdf->Cell(40,10,'Manzana: '.$data_ben['jf_manzana']);
$pdf->SetX(-80);
$pdf->Cell(40,10,'Lote: '.$data_ben['jf_lote']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Teléfono: '.$data_ben['jf_telefono']);
$pdf->Ln(20);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'3. Datos de identificación de los Solicitantes/Beneficiarios:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Apellido Jefe: '.$data_ben['jf_apellido']);
$pdf->SetX(85);
$pdf->Cell(40,10,'Nombre Jefe: '.$data_ben['jf_nombre']);
$pdf->SetX(-55);
$pdf->Cell(40,10,'DNI Jefe: '.$data_ben['jf_dni']);

$qf = mysql_query("select * from familiares where (fam_jf_id='$jf_id' and fam_parentesco='Conyuge / Pareja')");
if (mysql_num_rows($qf)>0){
	$af = mysql_fetch_array($qf);
$pdf->Ln(8);
$pdf->Cell(40,10,'Apellido Sol. 2: '.$af['fam_apellido']);
$pdf->SetX(85);
$pdf->Cell(40,10,'Nombre Sol. 2: '.$af['fam_nombre']);
$pdf->SetX(-55);
$pdf->Cell(40,10,'DNI Sol. 2: '.$af['fam_dni']);
}
$pdf->Ln(20);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'4. Opinión Técnica:',0,0,'L');
$pdf->Ln(12);
$pdf->SetFont('Times','',12);
$tecnico_a = str_replace("<li>"," -  ",$tecnico_a);
$tecnico_a = str_replace("&ldquo;",'"',$tecnico_a);
$tecnico_a = str_replace("&rdquo;",'º',$tecnico_a);
$pdf->MultiCell(0,6,strip_tags(html_entity_decode($tecnico_a, ENT_QUOTES, "ISO-8859-1")));


$pdf->Output();
?>?>