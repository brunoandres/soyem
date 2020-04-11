<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Nuevo Afiliado</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>

<script LANGUAGE="JavaScript">
 function casado1(){
 if (document.getElementById("estado_civil").value == "casado"){
 document.getElementById("os_esposa").disabled = false;
 } else {
  document.getElementById("os_esposa").disabled = true;
  document.getElementById("nom_os_esposa").disabled = true;
 }
 }
 function casado2(){
 if (document.getElementById("os_esposa").value == "si"){
 document.getElementById("nom_os_esposa").disabled = false;
 } else {
  document.getElementById("nom_os_esposa").disabled = true;
 }
 }

  function casado3(){
 if (document.getElementById("coseguro").value == "no"){
 document.getElementById("motivo_coseguro").disabled = false;
 } else {
  document.getElementById("motivo_coseguro").disabled = true;
 }
 }

   function casado4(){
 if (document.getElementById("dona_sangre").value == "si"){
 document.getElementById("tipo_sangre").disabled = false;
 } else {
  document.getElementById("tipo_sangre").disabled = true;
 }
 }
 </script>


<!-- LINKS NUEVOS PARA VALIDAR CON BOOTSTRAP


<link rel="stylesheet" href="css.css">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/jquery.min.js"></script>


<script src="js/jquery-1.9.1.min.js"></script>

<script>
  $(document).ready(function() {
      $("#resultadoBusqueda").html('<p style="color:red;">Ingrese Legajo...</p>');
  });

  function buscar() {
    //Defino mi variable textoBusqueda con el valor que ingreso en el input de legajo.
    var textoBusqueda = $("input#legajo").val();

     //Si el input de legajo es distinto de vacio, envio por metodo post mi valor ingresado.
     if (textoBusqueda != "") {

        /*

          buscar_legajo.php es mi archivo donde realizo la consulta a la base de datos, consultando
          por el valor ingresado, valorBusqueda es mi nueva variable que recibo por post en buscar_legajo.php. La variable 'mensaje' es la que me devuelve si hay coincidencias o no.

        */
        $.post("buscar_legajo.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            //Guardo el resultado de la busqueda en el input con id 'valor'
            $("input#valor").val(mensaje);
            $("#resultadoBusqueda").html(mensaje);

        });

        //Condicion si encuentro un legajo duplicado ya existente en la base.
        if($("input#valor").val()==1){
          $('#insert').prop("disabled", false);
        }else{
          //Activo el disabled en el boton submit, no puedo enviar formulario.
          $('#insert').prop("disabled", true);

        }


    }
    else {
       $("#resultadoBusqueda").html('');
       $('#insert').prop("disabled", true);

    };
  };
</script>



<!-- FIN LINKS NUEVOS -->





</head>

<body>
<?php
include("top_bar.php");
?>
<?php
include("menu.php");
?>
</div>
</div>
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
<div class="barri"><b><a href="listado_afiliados.php" title="Buscar un afiliado">Buscar Afiliado</a> - <a href="listado_de_afiliados.php" title="Armar listado de afiliados">Armar listados</a></b></div>
<form method="post" action="agrega_afiliado.php" id="reg_form">
<div class="subt"> Nuevo Afiliado: </div>
<div class="etiqueta">Legajo:</div>
<div class="form-group">
  <!--<input name="legajo" type="text" class="p_input" id="legajo" value="<?php echo $_GET['legajo']; ?>" />-->
  <input type="number" name="legajo" id="legajo" onKeyUp="buscar();" class="p_input" />
</div>

<!------------------->
<div id="resultadoBusqueda"></div>
<input type="text" name="valor" id="valor" value="">
<!-------------------->


<div class="etiqueta">Apellido y Nombre:</div>
<div class="form-group">
  <input name="nombre" type="text" class="p_input" id="nombre" />
</div>
  <div class="etiqueta">CUIL:</div>
  <div class="form-group">
    <input name="cuil" type="text" class="p_input" id="cuil" value="<?php echo $dat['cuil']; ?>" />
  </div>
  <div class="etiqueta">Fecha de Nacimiento:</div>
  <div class="form-group">

    <input name="nacimiento" type="text" class="p_input" id="nacimiento" />

  </div>


  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "nacimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>


  <div class="etiqueta">Domicilio:</div>
  <div class="form-group">
    <input name="domicilio" type="text" class="p_input" id="domicilio" />
  </div>
  <div class="etiqueta">Nro de Documento:</div>
  <div class="form-group">
    <input name="documento" type="text" class="p_input" id="documento" />
  </div>
  <div class="etiqueta">Estado Civil:</div>
  <div class="form-group">
    <select name="estado_civil" class="p_input" id="estado_civil" onchange="casado1()">
    <option value="<?php echo $dat['estado_civil']; ?>" selected="selected"><?php echo $dat['estado_civil']; ?></option>
    <option value="soltero">soltero</option>
    <option value="casado">casado</option>
    <option value="viudo">viudo</option>
    <option value="divorciado">divorciado</option>
    </select>
  </div>
  <div class="etiqueta">Su esposa/o tiene obra social?:</div>
  <select name="os_esposa" class="p_input" id="os_esposa" onchange="casado2()">
  <option value="<?php echo $dat['os_esposa']; ?>" selected="selected"><?php echo $dat['os_esposa']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>

<div class="etiqueta">Obra social del esposa/o:</div>
<div class="form-group">
  <input name="nom_os_esposa" type="text" class="p_input" id="nom_os_esposa" value="<?php echo $dat['nom_os_esposa']; ?>" />
</div>
  <div class="etiqueta">Teléfono Fijo:</div>
<div class="form-group">
  <input name="telefono" type="text" class="p_input" id="telefono" />
</div>
   <div class="etiqueta">Teléfono Celular:</div>
<div class="form-group">
  <input name="celular" type="text" class="p_input" id="celular" value="<?php echo $dat['celular']; ?>" />
</div>
  <div class="etiqueta">Correo electronico:</div>
  <div class="form-group">
  <input name="correo" type="text" class="p_input" id="correo" />
  </div>

  <div class="etiqueta">Sector donde trabaja:</div>
  <div class="form-group">
    <input name="sector" type="text" class="p_input" id="sector" value="<?php echo $dat['sector']; ?>" />
  </div>
<div class="etiqueta">Categoria:</div>
<div class="form-group">
  <input name="categoria" type="text" class="p_input" id="categoria" value="<?php echo $dat['categoria']; ?>" />
</div>
  <div class="etiqueta">Antiqüedad:</div>
  <div class="form-group">
  <input name="antiquedad" type="text" class="p_input" id="antiquedad" value="<?php echo $dat['antiquedad']; ?>" />
</div>

   <div class="etiqueta">Afiliado al coseguro:</div>
   <div class="form-group">
  <select name="coseguro" class="p_input" id="coseguro" onchange="casado3()">
  <option value="<?php echo $dat['coseguro']; ?>" selected="selected"><?php echo $dat['coseguro']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>
</div>

  <div class="etiqueta">Porque no esta afiliado al coseguro?:</div>
  <div class="form-group">
  <textarea name="motivo_coseguro" rows="4" class="p_input" id="motivo_coseguro"><?php echo $dat['motivo_coseguro']; ?></textarea>
</div>

   <div class="etiqueta">Dona sangre?:</div>
   <div class="form-group">
  <select name="dona_sangre" class="p_input" id="dona_sangre" onchange="casado4()">
  <option value="<?php echo $dat['dona_sangre']; ?>" selected="selected"><?php echo $dat['dona_sangre']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>
</div>
  <div class="etiqueta">Grupo y Factor:</div>
  <div class="form-group">
  <input name="tipo_sangre" type="text" class="p_input" id="tipo_sangre" value="<?php echo $dat['tipo_sangre']; ?>" />
</div>


  <div class="etiqueta">Fecha de afiliacion:</div>
  <div class="form-group">
  <input name="afiliacion" type="text" class="p_input" id="afiliacion" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "afiliacion",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
</div>

    <div class="etiqueta">Vencimiento del Carnet:</div>
    <div class="form-group">
  <input name="vencimiento" type="text" class="p_input" id="vencimiento" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "vencimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
</div>

  <div class="etiqueta">Nro de IPROSS:</div>
  <div class="form-group">
  <input name="ipross" type="text" class="p_input" id="ipross" />
</div>
  <div class="etiqueta">Sueldo:</div>
  <div class="form-group">
<input name="sueldo" type="text" class="p_input" id="sueldo" />
</div>
  <div class="etiqueta">Es Jubilado:</div>
  <label>
    <div class="form-group">
  <select name="jubilado" class="p_input" id="jubilado">
   <option></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
</div>
   <div class="etiqueta">Es Socio:</div>
  <label>
    <div class="form-group">
  <select name="socioos" class="p_input" id="socioos">
   <option></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
</div>
    <div class="etiqueta">Sugerencias:</div>
    <div class="form-group">
  <textarea name="sugerencias" rows="4" class="p_input" id="sugerencias"><?php echo $dat['sugerencias']; ?></textarea></div>

  <div class="etiqueta">Observaciones:</div>
  <div class="form-group">
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
</div>
   <div class="etiqueta">Fecha de Actualización:</div>
   <div class="form-group">
  <input name="f_actualiza" type="text" class="p_input" id="f_actualiza" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_actualiza",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script></div>
<div>
  <label><br>

    <input type="submit" name="insert" id="insert" value="Agregar" class="btn btn-default" />
	</label>
</div>
</form>
</div>
  </div>



<!-- SCRIPTS PARA VALIDAR CON BOOTSTRAP -->


<!-- PrefixFree -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

        <script src="js/index.js"></script>
<script type="text/javascript">

   $(document).ready(function() {
    $('#reg_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later

        fields: {
            legajo: {
                validators: {
                        numeric: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Por favor ingrese el Legajo'
                    }
                }
            },
            nombre: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese el Nombre y Apellido'
                    }
                }
            },

            cuil: {
                validators: {
                        numeric: {
                        min: 8,
                    },
                        notEmpty: {
                        message: 'Por favor ingrese el Cuil (sin guiones)'
                    }
                }
            },
            nacimiento: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese fecha de nacimiento'
                    }
                }
            },
            domicilio: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese la dirección'
                    }
                }
            },
            documento: {
                validators: {
                     numeric: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese n° documento (sin guiones)'
                    }
                }
            },
            estado_civil: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione un estado'
                    }
                }
            },
            telefono: {
                validators: {
                     numeric: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese Teléfono'
                    },
                    numeric:{
                      message : 'Ingrese sólo números'
                    }
                }
            },
            celular: {
                validators: {
                     numeric: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese Celular'
                    },
                    numeric:{
                      message : 'Ingrese sólo números'
                    }
                }
            },
            correo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ingrese un correo electrónico'
                    },
                    emailAddress: {
                        message: 'Ingrese un correo válido'
                    }
                }
            },
            sector: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese sector de trabajo'
                    }
                }
            },
            categoria: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese la categoría'
                    }
                }
            },
            antiquedad: {
                validators: {
                     numeric: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese la antiguedad'
                    }
                }
            },
            coseguro: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            dona_sangre: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            afiliacion: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese fecha de afiliación'
                    }
                }
            },
            vencimiento: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese fecha de vencimiento'
                    }
                }
            },
            ipross: {
                validators: {
                     numeric: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese n° IPROSS'
                    }
                }
            },
            sueldo: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese Sueldo'
                    }
                }
            },
            jubilado: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            socioos: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            f_actualiza: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese fecha de vencimiento'
                    }
                }
            },


            }
        })


        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#reg_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});



 </script>


<!-- -->

</body>
</html>
