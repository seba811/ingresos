<?php


include('conexion.php');


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



    <title>Ingreso de Rut</title>
</head>

<body>

    <?php
    $hoy = date("dd-mm-yyyy");

    ?>
 

    <form id="form_rut" action="ingresos_nuevo.php" method="post">
        <div class="form-row">
            <div class="input-group input-group-lg col-md-3 mx-auto">
                <h1 class="display-5">FORMULARIO INGRESOS</h1>
            </div>
        </div>
        <div class="col">
           
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