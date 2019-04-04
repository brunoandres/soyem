<div id="menu">
<?php
if($funcion_r=="2" or $funcion_r=="1"  or $funcion_r=="4"){
?>
<div class="<?php if($page=='afiliados'){echo 'active';}else{echo 'item';} ?>"> <a href="listado_afiliados.php">Afiliados</a> </div>
<?php
}
?>
<?php
if($funcion_r=="1"){
?>
<div class="<?php if($page=='usuarios'){echo 'active';}else{echo 'item';} ?>"> <a href="listado_usuarios.php">Usuarios</a> </div>
<div class="<?php if($page=='duplicados'){echo 'active';}else{echo 'item';} ?>"> <a href="duplicados.php">Duplicados</a> </div>
<?php
}
?>
<?php
if($funcion_r=="1"  or $funcion_r=="4"){
?>
<div class="<?php if($page=='prestamos'){echo 'active';}else{echo 'item';} ?>"> <a href="prestamos.php">Prestamos</a> </div>
<?php
}
?>
<?php
if($funcion_r=="1"){
?>
<div class="<?php if($page=='prestamos_rapidos'){echo 'active';}else{echo 'item';} ?>"> <a href="prestamos_rapidos.php">Prestamos Rapidos</a> </div>
<div class="<?php if($page=='prestamos_viviendas'){echo 'active';}else{echo 'item';} ?>"> <a href="prestamos_viviendas.php">Prestamos Viviendas</a> </div>
<div class="<?php if($page=='empresas'){echo 'active';}else{echo 'item';} ?>"> <a href="empresas.php">Empresas</a> </div>
<?php
}
?>
<?php
if($funcion_r=="1"  or $funcion_r=="4"){
?>
<div class="<?php if($page=='reintegros'){echo 'active';}else{echo 'item';} ?>"> <a href="reintegros.php">Reintegros</a> </div>
<div class="<?php if($page=='ingresos'){echo 'active';}else{echo 'item';} ?>"> <a href="ingresos.php">Ingresos</a> </div>
<div class="<?php if($page=='pagos'){echo 'active';}else{echo 'item';} ?>"> <a href="pagos.php">Pagos</a> </div>
<?php
}
?>
<?php
if($funcion_r=="1" or $funcion_r=="3"){
?>
<div class="<?php if($page=='contabilidad'){echo 'active';}else{echo 'item';} ?>"> <a href="contabilidad.php">Contabilidad</a> </div>
<?php
}
?>
<br clear="all" />
</div>