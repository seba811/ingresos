<?php
session_start();

$usuario_id = $_SESSION['usuario_id'];

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {
header("location:index.php");
exit;
}
if ($_SESSION['usuario_tipo'] == 1 || $_SESSION['usuario_tipo'] == 7 || $_SESSION['usuario_tipo'] == 2) {
header("location:ingresos.php");
exit;
}
if ($_SESSION['usuario_tipo'] == 9 || $_SESSION['usuario_tipo'] == 8) {
header("location:preingresosbiobio/preingresos.php");
exit;
}

//Alerta
if (isset($_GET['x'])) {
    switch ($_GET['x']) {
        case 'add_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Preingreso Agregado con éxito";
            $alerta = true;
            break;
        case 'add_err':
            $alerta_tipo = "warning";
            $alerta_titulo = "Error al Agregar Preingreso";
            $alerta = true;
            break;
        case 'modi_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Preingreso Modificado con éxito";
            $alerta = true;
            break;
        case 'modi_err':
            $alerta_tipo = "warning";
            $alerta_titulo = "Error al modificar Preingreso";
            $alerta = true;
            break;
        case 'elimin_exi':
            $alerta_tipo = "success";
            $alerta_titulo = "Preingreso Eliminado con éxito";
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

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Uso de sweetalert2   -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="vendor/select2/dist/js/select2.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <script>
        $(document).ready(function () {
            var alerta = "<?php echo $alerta; ?>";
            var alerta_titulo = "<?php echo $alerta_titulo; ?>";
            var alerta_tipo = "<?php echo $alerta_tipo; ?>";
            console.log("hola alerta = " + alerta_titulo);
            if (alerta == true) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: alerta_tipo,
                    title: alerta_titulo
                })
            }
        });
    </script>

    <title></title>


</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
      <a class="nav-item nav-link active" href="preingresos.php">Preingresos</a>
      </li>
      <li class="nav-item">
      <?php if ($_SESSION['usuario_tipo'] == 0) { ?>
                    <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
                <?php } else if($_SESSION['usuario_tipo'] == 5) { ?>
                    <a class="nav-item nav-link" href="usuarios_pre.php">Usuarios</a>
                <?php } ?>
      </li>
      <li class="nav-item">
      
      </li>
    </ul>
    <a class="nav-item nav-link disable" href="#">
            <?php echo $_SESSION['usuario_nombre'] ?>
        </a>
        <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>
  </div>
</nav>

<br>
    <div class="container">
    <br>
        <div class="row">
            <div class="col-6" >

                <button type="button" class="btn btn-primary btn-lg"  onclick="alerta()">Nuevo Preingreso</button>

            </div>

          

            <div class="col-6" style='text-align: right'>

                <button type="button" class="btn btn-primary btn-lg" onclick="excel()">Exportar Excel</button>

            </div>

        </div>
      

    </div>



    <div class="container">

        <div class="row">
            <div class="dropdown">
                <div class='col-12'>
                    <label>Estado Preingresos</label>
                    <select id="filtro_estado" class="js-example-placeholder-single js-states form-control"
                        name="filtro_estado" onchange="filtrox();">
                        <option value="-1">Todos</option>
                        <option value="0">Listo</option>
                        <option value="1">No Listo</option>
                        <option value="3">Listos e Ingresados</option>
                        <option value="2">Contratistas Ingresados</option>

                    </select>

                </div>


            </div>


        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Fecha Registro</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Rut</th>
                            <th>Empresa</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>


    <!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#tablaUsuarios").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "processing": true,
                "serverSide": true,
                "sAjaxSource": "ServerSide/serverside.php?filtro=-1",
                "columnDefs": [{
                    "data": null
                }]
            });
        });
    </script>

</body>

</html>


<script>
    function alerta() {

        Swal.fire({
            title: 'Ingrese Rut',
            html: '<input id="swal-input1" class="swal2-input" maxlength="10" onkeyup="formato_rut(this)">',
            focusConfirm: false,
            confirmButtonText: 'Confirmar',
            preConfirm: () => {


                console.log('entro aui'),
                    rut = document.getElementById('swal-input1').value


                var valor = clean(rut);

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

                        rut: rut


                    },

                    success: function (results) {
                        console.log("gane: " + results);



                        if (results == 1 || results == 2) {
                            console.log("Tabajado aceptado");
                            Swal.fire({
                                title: 'Trabajador Aceptado',
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            }).then((confirmed) => {
                                if (confirmed) {



                                    Swal.fire({
                                        title: 'Selecciona Empresa',
                                        input: 'select',
                                        inputOptions: {
                                            'Industrial': {
                                                'Prize ProService S.A': 'Prize ProService S.A',
                                                'Agrocomercial Natura S.A': 'Agrocomercial Natura S.A',
                                                'ProService BioBio SPA': 'ProService BioBio SPA'

                                            },
                                            'Comercial': {
                                                'Exportadora Prize S.A': 'Exportadora Prize S.A',
                                                'Transportes ProTrans SPA': 'Transportes ProTrans SPA',
                                                'ComercialPrize SPA': 'ComercialPrize SPA',
                                                'Prize ServiciosCorporativos SPA': 'Prize ServiciosCorporativos SPA',

                                            },
                                            'Otros': {
                                                'Contratista Requinoa': 'Contratista Requinoa',
                                            },
                                        },
                                        inputPlaceholder: 'Selecciona Empresa',
                                        showCancelButton: true,
                                        inputValidator: (value) => {
                                            if (!value) {

                                                return "Por favor Ingrese Una Empresa";
                                            } else {

                                                return undefined;
                                            }




                                        }
                                    })
                                        .then(resultado => {
                                            if (resultado.value) {
                                                let $empresa = resultado.value;
                                                $rut = rut;
                                                window.location.href = "preingresos_nuevo.php?rut=" + $rut + "&empresa=" + $empresa;
                                                console.log("Hola, " + $empresa);
                                            }
                                        });


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
        })
    }

    function formato_rut(rut) {

        rut.value = rut.value.replace(/[.-]/g, '').replace(/^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1$2$3-$4');

        console.log("entro a rut")

    }
</script>
<script>
    function excel() {

        let flatpickrInstance


        Swal.fire({
            title: 'Por Favor Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">',


            stopKeydownPropagation: false,
            preConfirm: () => {

                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),

                    Swal.fire({
                        title: 'Selecciona Empresa',
                        input: 'select',
                        inputOptions: {
                            'Industrial': {
                                'Prize ProService S.A': 'Prize ProService S.A',
                                'Agrocomercial Natura S.A': 'Agrocomercial Natura S.A',
                                'ProService BioBio SPA': 'ProService BioBio SPA'

                            },
                            'Comercial': {
                                'Exportadora Prize S.A': 'Exportadora Prize S.A',
                                'Transportes ProTrans SPA': 'Transportes ProTrans SPA',
                                'ComercialPrize SPA': 'ComercialPrize SPA',
                                'Prize ServiciosCorporativos SPA': 'Prize ServiciosCorporativos SPA',

                            },
                            'Otros': {
                                'Contratista Requinoa': 'Contratista Requinoa',
                                'Contratista Todo': 'Contratista Todo',

                            }
                        },
                        inputPlaceholder: 'Selecciona Empresa',
                        showCancelButton: true,
                        inputValidator: (value) => {
                            $empresa = value;
                            if ($empresa == 'Contratista Requinoa') {

                                window.location.href = "excel3.php?fecha=" + $fecha + "&empresa=" + $empresa;
                            } else if($empresa == 'Contratista Todo'){
                                window.location.href = "excel4.php?fecha=" + $fecha + "&empresa=" + $empresa;

                            } else {

                                window.location.href = "excel2.php?fecha=" + $fecha + "&empresa=" + $empresa;
                            }

                        }
                    })


                console.log($fecha)

            },
            willOpen: () => {
                flatpickrInstance = flatpickr(
                    Swal.getPopup().querySelector('#expiry-date')
                )
            }
        })
    }
</script>

<script>
    function filtrox() {
        var id_estado = document.getElementById("filtro_estado").value;


        console.log("hola - valore id_estado: " + id_estado);

        $(document).ready(function () {
            $("#tablaUsuarios").DataTable().clear().destroy();

            $("#tablaUsuarios").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "processing": true,
                "serverSide": true,
                "sAjaxSource": "ServerSide/serverside.php?filtro="+id_estado,
                "columnDefs": [{
                    "data": null
                }]
            });
        });

    }

    function clean(rut) {
        return typeof rut === 'string' ?
            rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase() :
            ''
    }
</script>