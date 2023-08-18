<?php
session_start();

$usuario_id = $_SESSION['usuario_id'];

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

  header("location:../index.php");
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
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.foundation.min.css">
  <!--Uso de sweetalert2   -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>

  <!-- Data tables -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
      display: none;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('#table_id').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          },
          "columnDefs": [{
            "className": "dt-center",
            "targets": "_all"
          }],
          "bSort": false
        }

      );



    });
  </script>
  <script>
    $(document).ready(function() {
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

  <title>Preingresos</title>
</head>

<body>

  <?php
  include('conexion.php');

  ?>



  <?php
  if ($_SESSION['usuario_tipo'] == 0 or $_SESSION['usuario_tipo'] == 9) {
    $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_empresa= 'Agrocomercia Natura S.A BIOBIO' and preingresos_empresa='ProService BioBio SPA' ORDER BY preingresos_fecha_registro DESC");
  } else {

    $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_usuario_id='$usuario_id' ORDER BY preingresos_fecha_registro DESC");
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand"><img src="../assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="preingresos.php">Preingresos</a>
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
  <div class="container">
    <div class="row float-right">
      <dic class="col">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Configuraciones
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="usuarios_pre.php">Agregar nuevo Usuario</a></li>
            <li><a class="dropdown-item" onclick="excel()">Exportar Excel</a></li>
            <li></li>
          </ul>
        </div>
      </dic>
    </div>
  </div>
  <div class="container" style="padding:50px 50px;">
    <div class="row">
      <div class="col">

      </div>


    </div>
    <div class="row">
      <div class="col-8">

        <button type="button" class="btn btn-primary btn-lg" onclick="alerta()">Nuevo Preingreso</button>

      </div>

      <div class="dropdown">
        <div class='col-2'>
          <label>Estado Preingreos</label>
          <select id="filtro_estado" class="mdb-select colorful-select  md-form " name="filtro_estado" onchange="filtrox();">
            <option value="2">Todos</option>
            <option value="0">Listo</option>
            <option value="1">No Listo</option>

          </select>

        </div>
      </div>


    </div>
    <table id="table_id" class="table  table-bordered cell-border" style="width:100%">
      <thead>
        <tr>
          <th>Fecha Registro</th>
          <th>Nombre</th>
          <th>Rut</th>
          <th>Usuario</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody id="el_body">
        <?php
        while ($row = $rs_preingresos->fetch_array(MYSQLI_ASSOC)) {
          $preingresos_usuario   = $row['preingresos_usuario'];
          $preingresos_nombre   = $row['preingresos_nombre'];
          $preingresos_apellido   = $row['preingresos_apellidop'];
          $preingresos_rut = $row['preingresos_rut'];
          $preingresos_estado = $row['preingresos_estado'];
          $preingresos_fecha_registro = $row['preingresos_fecha_registro']

        ?>

          <tr>
            <td title="ingreso"><?= $preingresos_fecha_registro ?></td>
            <td title="nombre"><?= $preingresos_nombre . ' ' . $preingresos_apellido ?></td>
            <td title="rut"><?= $preingresos_rut ?></td>
            <td title="usuario"><?= $preingresos_usuario ?></td>
            <td title="estado" class="text-center">
              <?php
              if ($preingresos_estado == 0) { ?>
                <a title="Modificar" href="preingresos_modificar.php?id=<?= $row['preingresos_id'] ?>">
                  <i width="50" height="50" class="bi bi-check-circle-fill fa-2x " style="font-size: 1.5rem; margin-left:10px;color: green"></i>
                </a>
              <?php } else {  ?>
                <a title="Modificar" href="preingresos_modificar.php?id=<?= $row['preingresos_id'] ?>">
                  <i class="bi bi-exclamation-circle-fill fa-2x " style="font-size: 1.5rem; margin-left:10px;color: orange"></i>
                </a>
              <?php } ?>
              <a title="Eliminar" href="preingresos_eliminar.php?id=<?= $row['preingresos_id'] ?>" onclick="javascript: return confirm('¿Desea Eliminar Este Usuario?');">
                <i class="bi bi-trash-fill fa-2x " style="font-size: 1.5rem;margin-left:10px;color:red"></i>

              </a>
            </td>


          </tr>
        <?php } //Fin while 
        ?>
      </tbody>

    </table>

  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
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

          success: function(results) {
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
                       
                          
                            'ProService BioBio SPA': 'ProService BioBio SPA'

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
          
                'ProService BioBio SPA': 'ProService BioBio SPA'

              },
            },
            inputPlaceholder: 'Selecciona Empresa',
            showCancelButton: true,
            inputValidator: (value) => {
              $empresa = value;
if($empresa=='Contratista Requinoa'){

  window.location.href = "excel3.php?fecha=" + $fecha + "&empresa=" + $empresa;
}else{

  window.location.href = "excel4.php?fecha=" + $fecha + "&empresa=" + $empresa;
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

    $.ajax({
      type: "POST",
      url: "filtro.php",
      data: {
        id_estado: id_estado

      },

      success: function(results) {
        console.log("gane: " + results);

        var el_body = document.getElementById("el_body");
        //console.log("hola xD " + el_body);
        $(document).ready(function() {
          $('#table_id').DataTable().clear().destroy();
          el_body.innerHTML = results;
          $('#table_id').dataTable({
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              },
              "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
              }],
            }

          );
          $('.dataTables_length').addClass('bs-select');




        }); // fin document.ready del succes
      },
    }); //fin ajax


  }

  function clean(rut) {
    return typeof rut === 'string' ?
      rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase() :
      ''
  }
</script>