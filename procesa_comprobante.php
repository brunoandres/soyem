<?php  
include ("conecta.php");
include ("auditoria.php");
require_once 'PHPExcel/Classes/PHPExcel.php';

if (isset($_POST['btnForm'])) {
	
	//si el archivo excel o csv está cargado
	if (isset($_FILES['archivo'])) {

		//Recibo los datos para insertar en mi tabla comprobantes
      	$mes_comprobante = $_POST['mes'];
		$anio_comprobante = $_POST['anio'];
		$fecha_comprobante = $_POST['fecha_comprobante'];
		$fecha = substr($fecha_comprobante,6,4).'-'.substr($fecha_comprobante,3,2).'-'.substr($fecha_comprobante,0,2);
		$saldo_comprobante = $_POST['saldo'];

		//Detalles de mi archivo de comprobante
		$errors= array();
        $file_name = $_FILES['archivo']['name'];
     	$file_size =$_FILES['archivo']['size'];
     	$file_tmp =$_FILES['archivo']['tmp_name'];
     	$file_type=$_FILES['archivo']['type'];
     	$file_ext=strtolower(end(explode('.',$_FILES['archivo']['name'])));
     	$extensions= array("csv","xls","xlsx");

     	//Reviso si la extension de mi archivo es valida
      	if(in_array($file_ext,$extensions)=== false){
         	$errors[]="La extensión del archivo no es válido";
      	}
      	
      	//Reviso que el archivo no pese mas de 10 mega
      	if($file_size > 10485760){
     		$errors[]='El archivo no puede pesar más de 10MB';
      	}
	    
	    //Si no existen errores, muevo el archivo a mi carpeta de archivos
      	if(empty($errors)==true){
         	move_uploaded_file($file_tmp,"archivos_comprobantes/".$file_name);
      	}else{
         	print_r($errors);
      	}

      	//Inserto mi comprobante
      	$query = "INSERT INTO `comprobantes`(`mes`, `anio`, `fecha`, `saldo`, `archivo`) VALUES ('$mes_comprobante','$anio_comprobante','$fecha','$saldo_comprobante','$file_name')";
      	mysql_query("START TRANSACTION");

      	if (mysql_query($query)) {
      		//Recupero el id insertado para guardar en mi tabla de archivos
      		$id_comprobante = mysql_insert_id();
      		
      		$archivo = "archivos_comprobantes/".$file_name;
			$inputFileType = PHPExcel_IOFactory::identify($archivo);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($archivo);
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

			for ($row = 2; $row <= 2; $row++){ 

				$fecha = $sheet->getCell("A".$row)->getValue();
				$descripcion = $sheet->getCell("B".$row)->getValue();
				$comprobante = $sheet->getCell("C".$row)->getValue();
				$debito = $sheet->getCell("D".$row)->getValue();
				$credito = $sheet->getCell("E".$row)->getValue();
				$saldo = $sheet->getCell("F".$row)->getValue();
				$codigo = $sheet->getCell("G".$row)->getValue();

				$sql = "INSERT INTO `comprobantes_archivos`(`id_comprobante`, `fecha`, `descripcion`, `comprobante`, `debito`, `credito`, `saldo`, `codigo`) VALUES ($id_comprobante,'$fecha','$descripcion','$comprobante','$debito','$credito','$saldo','$codigo')";
				echo $sql;
				if (mysql_query($sql)) {
					echo "OK";
					//mysql_query("COMMIT");
				}else{
					/*mysql_query("ROLLBACK");
					exit();*/
					echo "error";
				}
				
			}

      	}else{
      		echo "Error";
	      	//mysql_query("ROLLBACK");
      	}
	}else{
		echo "No file";
	}
}





?>