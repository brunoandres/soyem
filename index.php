<?php
include("conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Acceso al Sistema Administrativo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="topbar">
<div class="t_izq">Sistema Administrativo - SOYEM</div>
<br clear="all" />
</div>
<div id="fondo_login">
  <p><strong>Formulario de Acceso al Sistema: </strong></p>
  <form name="login" method="post" action="valida.php">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td>Usuario:</td>
      <td><label>
      <input name="usuario" type="text" id="usuario" size="40" />
      </label></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input name="pass" type="password" id="pass" size="40" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><label>
        <input name="Submit" type="submit" class="boton_form" value="Ingresar" />
      </label></td>
      </tr>
  </table>
  </form>

  <?php
  if ($_GET['error']==2){
  echo '<span class="error">Usuario o Password incorrecto</span>';
  }
   if ($_GET['error']==1){
  echo '<span class="error">Usuario o Password no pueden estar vacios</span>';
  }
  ?>  </div>
</body>
</html>
