<?php

session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:index.php");
    exit;
}






include('conexion.php');

if (isset($_GET['x'])) {
    switch ($_GET['x']) {
      case 'add_exi':
        $alerta_tipo = "success";
        $alerta_titulo = "trabajador Agregado con éxito";
        $alerta = true;
        break;
      case 'add_err':
        $alerta_tipo = "warning";
        $alerta_titulo = "Error al Agregar Trabajador";
        $alerta = true;
        break;
      case 'modi_exi':
        $alerta_tipo = "success";
        $alerta_titulo = "Trabajador Modificado con éxito";
        $alerta = true;
        break;
      case 'no_pre':
        $alerta_tipo = "warning";
        $alerta_titulo = "Trabajador contratista no en Preingresos";
        $alerta = true;
        break;
      case 'elimin_exi':
        $alerta_tipo = "success";
        $alerta_titulo = "Trabajador Eliminado con éxito";
        $alerta = true;
        break;
      case 'elimin_err':
        $alerta_tipo = "warning";
        $alerta_titulo = "Error al Eliminar ";
        $alerta = true;
        break;
      case 'add_usu':
        $alerta_tipo = "warning";
        $alerta_titulo = "Usuario ya Ocupado";
        $alerta = true;
        break;
      default:
        $alerta = false;
        break;
    }
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   <!-- <script src="sweetalert2.all.min.js"></script> -->

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>

<script>
    $(document).ready(function() {
      var alerta = "<?php echo $alerta; ?>";
      var alerta_titulo = "<?php echo $alerta_titulo; ?>";
      var alerta_tipo = "<?php echo $alerta_tipo; ?>";
      console.log("hola alerta = " + alerta_titulo);
      if (alerta == true) {
if(alerta_tipo=='warning'){

  Swal.fire({

icon: alerta_tipo,
title: alerta_titulo,
showConfirmButton: true,

})

}else {
        Swal.fire({

          icon: alerta_tipo,
          title: alerta_titulo,
          showConfirmButton: false,
          timer: 1500
        })
      }}
    });
  </script>

    <title>Formulario para llenar ficha contratacion</title>
</head>

<body>

    <?php
    $hoy = date("dd-mm-yyyy");

    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="ingresos.php">Ingresos <span class="sr-only">(current)</span></a>
                <?php if ($_SESSION['usuario_tipo'] == 0) { ?>
                    <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
                <?php } else { ?>
                    <a class="nav-item nav-link" hidden href="usuarios.php">Usuarios</a>
                <?php } ?>
            </div>
        </div>

        <a class="nav-item nav-link disable" href="#"><?php echo $_SESSION['usuario_nombre'] ?></a>
        <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>


    </nav>

    <form id="form_rut" action="ingresos_nuevo.php" method="post" onkeyPress="">
        <div class="form-row">
            <div class="input-group input-group-lg col-md-3 mx-auto">
                <h1 class="display-5">FORMULARIO INGRESOS</h1>
            </div>
        </div>
        <div class="col">
            <div class="input-group input-group-lg col-md-3 mx-auto">

                <h2 class="display-8">Ingrese Empresa</h2>
                <div class="input-group">
                    <select class="form-control" name="empresa" id="empresa" onchange="cambioform()" style="width: 100%;">
                           <?php if ($_SESSION['usuario_tipo']    == 0) { ?>
                            <option></option>
                                    <optgroup label="Industrial">
                                        <option value='Prize ProService S.A'>Prize ProService S.A</option>
                                        <option value='Agrocomercial Natura S.A'>Agrocomercial Natura S.A</option>
                                        <option value='ProService BioBio SPA'>ProService BioBio SPA</option>
                                    </optgroup>
                                    <optgroup label="Comercial">
                                        <option value='Exportadora Prize S.A'>Exportadora Prize S.A</option>
                                        <option value='Transportes ProTrans SPA'>Transportes ProTrans SPA</option>
                                        <option value='ComercialPrize SPA'>ComercialPrize SPA</option>
                                        <option value='Prize ServiciosCorporativos SPA'>Prize ServiciosCorporativos SPA</option>
                                    </optgroup>
                                    <optgroup label="Agricola">
                                        <option value='AgroInvest SPA'>AgroInvest SPA</option>
                                        <option value='La Poza'>La Poza</option>
                                        <option value='Los Gomeros'>Los Gomeros</option>
                                    </optgroup>
                                    <optgroup label="OTROS">
                                        <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                        <option value='Contratista Chillan'>Contratista Chillan</option>
                                    </optgroup>
                                <?php } else if ($_SESSION['usuario_tipo']    == 1 || $_SESSION['usuario_tipo'] == 7) { ?>
                                    <optgroup label="Industrial">
                                        <option value='Prize ProService S.A'>Prize ProService S.A</option>
                                        <option selected value='Agrocomercial Natura S.A'>Agrocomercial Natura S.A</option>
                                        <!-- <option value='ProService BioBio SPA'>ProService BioBio SPA</option> -->
                                    </optgroup>
                                    <optgroup label="Comercial">
                                        <option value='Exportadora Prize S.A'>Exportadora Prize S.A</option>
                                        <option value='Transportes ProTrans SPA'>Transportes ProTrans SPA</option>
                                        <option value='ComercialPrize SPA'>ComercialPrize SPA</option>
                                        <option value='Prize ServiciosCorporativos SPA'>Prize ServiciosCorporativos SPA</option>
                                    </optgroup>
                                    <optgroup label="OTROS">
                                        <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                        <option value='Contratista Chilllan'>Contratista Chillan</option>
                                    </optgroup>
                                <?php } else if ($_SESSION['usuario_tipo']    == 2) {  ?>
                                    <optgroup label="Industrial">
                                        <option value='ProService BioBio SPA'>ProService BioBio SPA</option>
                                    </optgroup>
                                    <optgroup label="OTROS">
                                        <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                        <option value='Contratista Chilllan'>Contratista Chillan</option>
                                    </optgroup>
                                <?php } else if ($_SESSION['usuario_tipo']    == 3) {  ?>
                                    <optgroup label="Agricola">
                               
                                        <option value='La Poza'>La Poza</option>
                                    
                                    </optgroup>
                                <?php } else if ($_SESSION['usuario_tipo']    == 4) {  ?>
                                    <optgroup label="Agricola">
                                        <option value='Los Gomeros'>Los Gomeros</option>
                                    </optgroup>
                                <?php } ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group input-group-lg col-md-3 mx-auto">
                <h2 class="display-8">Ingrese Rut</h2>
                <div class="input-group">

                    <input type="rut" class="form-control" style="width:30% " id="rut" maxlength="10" name="rut" required onkeyup="formato_rut(this)">

                    <button type="button" class="btn btn-success" onclick="recontratacion()">
                        <span class="bi bi-search"></span>
                    </button>



                </div>
            </div>
        </div>

    </form>
</body>

</html>
<script type="text/javascript">
    function formato_rut(cliente) {
        cliente.value = cliente.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1$2$3-$4');
    }

    $(document).ready(function() {
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });
</script>
<script>

function cambioform(){
    
    empre =document.getElementById("empresa").value ;
    console.log('entro a la funcion cambia action');
if(empre=='Contratista Requinoa'){
    document.getElementById("form_rut").action='contratista.php';
console.log('cabio a contratista')
}else{
    document.getElementById("form_rut").action ='ingresos_nuevo.php' ;
    console.log('cabio a normal')
}    
}


    
    function recontratacion() {
        var rut = document.getElementById('rut');
        var formula = document.getElementById('form_rut')
        var empresa = document.getElementById('empresa')


        var valor = clean(rut.value);

cuerpo = valor.slice(0, -1);
dv = valor.slice(-1).toUpperCase();


// Calcular Dígito Verificador "Método del Módulo 11"
suma = 0;
multiplo = 2;

// Para cada dígito del Cuerpo
for (i = 1; i <= cuerpo.length; i++) {
    // Obtener su Producto con el Múltiplo Correspondiente
    index = multiplo * valor.charAt(cuerpo.length - i);

    // Sumar al Contador General
    suma = suma + index;

    // Consolidar Múltiplo dentro del rango [2,7]
    if (multiplo < 7) {
        multiplo = multiplo + 1;
    } else {
        multiplo = 2;
    }
}
// Calcular Dígito Verificador en base al Módulo 11
dvEsperado = 11 - (suma % 11);

// Casos Especiales (0 y K)
dv = dv == "K" ? 10 : dv;
dv = dv == 0 ? 11 : dv;

// Validar que el Cuerpo coincide con su Dígito Verificador
if (dvEsperado != dv) {

    Swal.fire({
                title: 'Rut invalido',
                icon: 'warning',
                confirmButtonText: 'Confirmar'
            })


            console.log("ingresa rut invalido ");

    return false;
}


       $.ajax({
            type: "POST",
            url: "recontratacionqbiz.php",
            data: {

                rut: rut.value


            },

            success: function(results) {
                console.log("gane: " + results);


                if (results == 1) {
                    console.log("Tabajado aceptado");
                    Swal.fire({
                            title: 'Trabajador Aceptado',
                            icon: 'success',
                            confirmButtonText: 'Confirmar'
                        }).then((confirmed) => {
                            if (confirmed) {
                                $('#form_rut').submit(); // << here
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        });


                } else if (results == 0) {
                    Swal.fire({
                        title: 'No se ingresó Rut',
                        icon: 'warning',
                        confirmButtonText: 'Confirmar'
                    })


                    console.log("No ingresa rut");


                } else if (results == 2) {
                    Swal.fire({
                        title: 'Trabajador ya Ingresado el dia de hoy',
                        icon: 'warning',
                        confirmButtonText: 'Confirmar'
                    })


                    console.log("ye se ingreso hoy");



                } else if (results == 3) {
                    Swal.fire({
                        title: 'Trabajador Contratista no Preingresado',
                        icon: 'warning',
                        confirmButtonText: 'Confirmar'
                    })


                    console.log("ye se ingreso hoy");



                } else {


                    Swal.fire({
                        title: 'Trabajador Bloqueado',
                        text: 'Motivo:' + results,
                        icon: 'error',
                        confirmButtonText: 'Confirmar'
                    })


                    console.log("trabajador rechazado");

                }
                //console.log("hola xD " + el_body);
                //results = 1 es cuando ta repetido
                //results = 0 es cuando NO ta repetido
                //toastr.error("alerta error");

            },



        });
    }

    function clean (rut) {
  return typeof rut === 'string'
    ? rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase()
    : ''
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=rut]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
  </script>