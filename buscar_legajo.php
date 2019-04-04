<?php
include("conecta.php");

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = 0;

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {


  $consulta = mysql_query("SELECT legajo,nombre FROM afiliado
	WHERE legajo ='$consultaBusqueda'");
	//Obtiene la cantidad de filas que hay en la consulta
	$filas = mysql_num_rows($consulta);

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = 0;
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		//echo 'Legajo ya existente <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysql_fetch_array($consulta)) {
			$nombre = $resultados['nombre'];
			
			/*$mensaje .= '
			<p>
			<strong>Nombre:</strong> ' . $nombre . '<br>
			<strong>Estado:</strong> YA EXISTE <br>

			</p>';*/
			$mensaje = 1;

		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>
