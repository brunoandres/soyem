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
    $this->Cell(80,10,'Dictamen Social - Adhesión a la Ley Pierri',0,0,'C');
    // Salto de línea
    $this->Ln(10);
	$this->SetFont('times','I',13);
	$this->Cell(0,10,'Instituto Municipal de Tierra y Vivienda para el Habitat Social de San Carlos de Bariloche',0,0,'C');
	 $this->Ln(10);
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
$pdf->Ln(10);

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
$pdf->Cell(40,10,'Nomenclatura Catastral: '.$data_ben['jf_sector'].'-'.$data_ben['jf_manzana'].'-'.$data_ben['jf_lote']);
$pdf->Ln(10);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'3. Datos de identificación del Solicitante:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Apellido: '.$data_ben['jf_apellido']);
$pdf->SetX(85);
$pdf->Cell(40,10,'Nombre: '.$data_ben['jf_nombre']);
$pdf->SetX(-55);
$pdf->Cell(40,10,'DNI: '.$data_ben['jf_dni']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Nacionalidad: '.$data_ben['jf_pais_nac']);
$pdf->SetX(65);
$pdf->Cell(40,10,'Años de residencia en Bariloche: '.$data_ben['jf_res_bche']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Estado Civil: '.$data_ben['jf_estado_civil']);
$pdf->Ln(10);
$qf = mysql_query("select * from familiares where (fam_jf_id='$jf_id')");
if (mysql_num_rows($qf)>0){
	
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'4. Datos de identificación de los familiares:',0,0,'L');
for($f=1;$f<=mysql_num_rows($qf);$f++){
	$af = mysql_fetch_array($qf);
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Apellido: '.$af['fam_apellido']);
$pdf->SetX(85);
$pdf->Cell(40,10,'Nombre: '.$af['fam_nombre']);
$pdf->SetX(-55);
$pdf->Cell(40,10,'DNI: '.$af['fam_dni']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Nacionalidad: '.$af['fam_pais_nac']);
$pdf->SetX(65);
$pdf->Cell(40,10,'Años de residencia en Bariloche: '.$af['fam_res_bche']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Estado Civil: '.$af['fam_estado_civil']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Parentesco: '.$af['fam_parentesco']);
if($f != mysql_num_rows($qf)){
$pdf->Ln(2);
}
}
}
$pdf->Ln(10);

$qv = mysql_query("select * from viviendas where (viv_id_jf='$jf_id')");

	$av = mysql_fetch_array($qv);
$qs = mysql_query("select * from situacion_ocial where (ss_ben_id='$jf_id')");

	$as = mysql_fetch_array($qs);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'5. Datos del Terreno:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Tipo de Titularidad: '.$av['viv_estado_prop_jf']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Dimensiones: '.$av['viv_sup_terreno']);
$pdf->SetX(65);
$pdf->Cell(40,10,'Antigüedad de Posesión: '.$av['viv_ant_terreno']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Dominio del Lote: '.$av['viv_estado_prop_terreno']);
$pdf->Ln(10);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'6. Datos de la Vivienda:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Superficie: '.$av['viv_sup_viv']);
$pdf->SetX(55);
$pdf->Cell(40,10,'Cantidad de viviendas en el lote: '.$as['ss_viv_lote']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Aislación Térmica: '.$av['viv_aislacion']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Material de Paredes: '.$av['viv_mat_paredes']);
$pdf->SetX(100);
$pdf->Cell(40,10,'Material del Techo: '.$av['viv_mat_techo']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Material del Piso: '.$av['viv_mat_piso']);
$pdf->SetX(95);
$pdf->Cell(40,10,'Cielorraso: '.$av['viv_cielorraso_ex']);
$pdf->SetX(125);
$pdf->Cell(40,10,'Vidrios: '.$av['viv_vidrios']);
$pdf->SetX(155);
$pdf->Cell(40,10,'Revestimiento Interior: '.$av['viv_rev_interior']);
$pdf->Ln(10);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'7. Datos de los Servicios:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Agua: '.$av['viv_agua']);
$pdf->SetX(70);
$pdf->Cell(40,10,'Procedencia del Agua: '.$av['viv_agua_proc']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Conexión de Agua: '.$av['viv_tipo_con_agua']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Electricidad: '.$av['viv_luz']);
$pdf->SetX(70);
$pdf->Cell(40,10,'Conexión a la red eléctrica: '.$av['viv_tipo_con_luz']);
$pdf->Ln(8);
$pdf->Cell(40,10,'Baño: '.$av['viv_bano']);
$pdf->SetX(70);
$pdf->Cell(40,10,'Tipo de desagüe: '.$av['viv_bano_des']);
$pdf->SetX(-65);
$pdf->Cell(40,10,'Instalaciones sanitarias: '.$av['viv_inst_san']);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'8. Opinión Técnica:',0,0,'L');
$pdf->Ln(8);
$pdf->SetFont('Times','',12);
$tecnico_a = str_replace("<li>"," -  ",$tecnico_a);
$tecnico_a = str_replace("&ldquo;",'"',$tecnico_a);
$tecnico_a = str_replace("&rdquo;",'º',$tecnico_a);
$pdf->MultiCell(0,6,strip_tags(html_entity_decode($tecnico_a, ENT_QUOTES, "ISO-8859-1")));

$pdf->Output();
?>?>