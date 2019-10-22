<?php  
include ("conecta.php");
include ("auditoria.php");
require_once 'PHPExcel/Classes/PHPExcel.php';

if (isset($_POST['btnForm'])) {
	
	//si el archivo excel o csv está cargado
	if (isset($_FILES['archivo'])) {

		//Recibo los datos para insertar en mi tabla comprobantes
      	$descripcion = $_POST['nombre_comprobante'];
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
         	header("location:subir_comprobante.php?estado=error_formato");
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

      	
      	try {
      		mysql_query("SET AUTOCOMMIT=0");
      		mysql_query("START TRANSACTION");
      		//Inserto mi comprobante
      		$query = "INSERT INTO `comprobantes`(`descripcion`, `fecha_carga`, `saldo`, `archivo`) VALUES ('$descripcion','$fecha','$saldo_comprobante','$file_name')";

      		$ejecuto_insert_comprobante = mysql_query($query);
      		//Recupero el id insertado para guardar en mi tabla de archivos
	  		$id_comprobante = mysql_insert_id();
	  		
	  		if (!$id_comprobante==0) {
	  			$archivo = "archivos_comprobantes/".$file_name;
				$inputFileType = PHPExcel_IOFactory::identify($archivo);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($archivo);
				$sheet = $objPHPExcel->getSheet(0); 
				$highestRow = $sheet->getHighestRow(); 
				$highestColumn = $sheet->getHighestColumn();

				for ($row = 2; $row <= $highestRow; $row++){ 

					$fecha_texto = $sheet->getCell("A".$row)->getValue();
					$strtotime = strtotime($fecha_texto);
					$fecha_insert = getDate($strtotime);
					$fecha_comprobante = $fecha_insert['year'].'-'.$fecha_insert['mon'].'-'.$fecha_insert['mday'];
					$descripcion = $sheet->getCell("B".$row)->getValue();
					$comprobante = $sheet->getCell("C".$row)->getValue();
					$debito = $sheet->getCell("D".$row)->getValue();
					$credito = $sheet->getCell("E".$row)->getValue();
					$saldo = $sheet->getCell("F".$row)->getValue();
					$codigo = $sheet->getCell("G".$row)->getValue();

					$saldo_inicial = $saldo+$debito-$credito;

					//var_dump($fecha_comprobante);

					if (empty($debito)) {
						$debito = '0.00';
					}
					if (empty($credito)) {
						$credito = '0.00';
					}
					if (empty($saldo)) {
						$saldo = '0.00';
					}

					if ($row==2) {
						$fecha_hasta = $fecha_comprobante;
					}
				
					$sql = "INSERT INTO `comprobantes_archivos`(`id_comprobante`, `fecha`, `descripcion`, `comprobante`, `debito`, `credito`, `saldo`, `codigo`) VALUES ($id_comprobante,'$fecha_comprobante','$descripcion','$comprobante','$debito','$credito','$saldo','$codigo')";
					$ejecuto_archivo = mysql_query($sql);
					mysql_query("COMMIT");
					$query_update = "update comprobantes set saldo = '$saldo_inicial',fecha_desde='$fecha_comprobante',fecha_hasta = '$fecha_hasta' where id=".$id_comprobante;
					mysql_query($query_update);
					header("location:subir_comprobante.php?estado=ok");
					auditar($query);
					auditar($sql);

				}
				
	  		}else{
	  			header("location:subir_comprobante.php?estado=error");
	  		}

      	} catch (Exception $e) {
      		mysql_query("ROLLBACK");
			header("location:subir_comprobante.php?estado=error");
      	}

	}else{
		header("location:subir_comprobante.php?estado=error_archivo");
	}
}





?>