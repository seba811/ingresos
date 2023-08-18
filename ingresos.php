<?php
session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

  header("location:index.php");
  exit;
}
//Alerta
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
    case 'modi_err':
      $alerta_tipo = "warning";
      $alerta_titulo = "Error al modificar Trabajador";
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


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
  include('conexion.php');

  if (isset($_POST['fecha_buscar'])) {
    $fecha_buscar = ($_POST['fecha_buscar']);
    $empresa_buscar = ($_POST['empresa_buscar']);
    $hoy2 = $fecha_buscar;

    if ($empresa_buscar == '*') {


      if ($_SESSION['usuario_tipo'] == 0 ) {


        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE
                    (ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    ingresos_empresa='ProService BioBio SPA'OR 
                    ingresos_empresa='Exportadora Prize S.A'OR 
                    ingresos_empresa='Transportes ProTrans SPA'OR 
                    ingresos_empresa='ComercialPrize SPA'OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA' OR
                    ingresos_empresa='AgroInvest SPA' OR
                    ingresos_empresa='La Poza' OR
                    ingresos_empresa='Los Gomeros')
                     and ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 1 || $_SESSION['usuario_tipo'] == 7) {
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                    ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    /* ingresos_empresa='ProService BioBio SPA' OR */
                    ingresos_empresa='Exportadora Prize S.A' OR 
                    ingresos_empresa='Transportes ProTrans SPA' OR 
                    ingresos_empresa='ComercialPrize SPA' OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA')
                     and ingresos_fecha = '$hoy2'");
      }
    } else {
      $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_fecha = '$hoy2' and ingresos_empresa='$empresa_buscar'");
    }
  } else if ($_SESSION['usuario_tipo'] == 0 || $_SESSION['usuario_tipo'] == 7) {
    $fecha_buscar = date('Y-m-d');
    $hoy2 = $fecha_buscar;
    $rs_ingresos = $conexion->query("SELECT *
         FROM ingresos 
         WHERE ingresos_fecha = '$hoy2'");
  } else if ($_SESSION['usuario_tipo'] == 1) {
    $fecha_buscar = date('Y-m-d');
    $hoy2 = $fecha_buscar;
    $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                                            ingresos_empresa='Prize ProService S.A' OR 
                                            ingresos_empresa='Agrocomercial Natura S.A' OR 
                                            /* ingresos_empresa='ProService BioBio SPA'OR */
                                            ingresos_empresa='Exportadora Prize S.A'OR 
                                            ingresos_empresa='Transportes ProTrans SPA'OR 
                                            ingresos_empresa='ComercialPrize SPA'OR 
                                            ingresos_empresa='Prize ServiciosCorporativos SPA') 
                                             and ingresos_fecha = '$hoy2'");
  } else if ($_SESSION['usuario_tipo'] == 2) {
    $fecha_buscar = date('Y-m-d');
    $hoy2 = $fecha_buscar;
   // $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='AgroInvest SPA' AND ingresos_fecha = '$hoy2'");
   $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='ProService BioBio SPA' AND ingresos_fecha = '$hoy2'");
  } else if ($_SESSION['usuario_tipo'] == 3) {
    $fecha_buscar = date('Y-m-d');
    $hoy2 = $fecha_buscar;
    $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='La Poza' AND ingresos_fecha = '$hoy2'");
  } else if ($_SESSION['usuario_tipo'] == 4) {
    $fecha_buscar = date('Y-m-d');
    $hoy2 = $fecha_buscar;
    $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='Los Gomeros' AND   ingresos_fecha = '$hoy2'");
  }


  $hoy = date('d-m-y');


  ?>
  <input type="number" class="form-control" style="width:30% " id="usuario_t" name="usuario_t" hidden value="<?= $_SESSION['usuario_tipo'] ?>">
  <?php


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
        <?php if ($_SESSION['usuario_tipo'] == 0 || $_SESSION['usuario_tipo'] == 7) { ?>
          <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
        <?php } else { ?>
          <a class="nav-item nav-link" hidden href="usuarios.php">Usuarios</a>
        <?php } ?>
      </div>
    </div>

    <a class="nav-item nav-link disable" href="#"><?php echo $_SESSION['usuario_nombre'] ?></a>
    <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>


  </nav>

  <div class="col-xs-10">



    <h1>Ingresos</h1>


    <a href="ingresos_nuevo_rut.php">
      <button type="button" class="btn btn-secondary" style="margin-bottom:5px;">Nuevo Ingreso</button>
    </a>
    <div class="row" style="text-align:right">
      <div class="col-md-3">
        <div class="row">
          <form action="ingresos.php" method="post">
            <p>Ingrese Empresa
              <select name="empresa_buscar" id="empresa_buscar" style="width: 50%;">
                <?php
                if ($empresa_buscar) {
                  if ($empresa_buscar != '*') { ?>
                    <option selected><?php echo $empresa_buscar ?></option>
                  <?php }
                } else { ?>

                <?php }
                if ($_SESSION['usuario_tipo']  == 0 || $_SESSION['usuario_tipo'] == 7) { ?>
                  <option  value='*'>Todos</option>
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
                <?php } else if ($_SESSION['usuario_tipo'] == 1) { ?>
                  <option value='*'>Todos</option>
                  <optgroup label="Industrial">
                    <option value='Prize ProService S.A'>Prize ProService S.A</option>
                    <option value='Agrocomercial Natura S.A'>Agrocomercial Natura S.A</option>
                   <!-- <option value='ProService BioBio SPA'>ProService BioBio SPA</option> -->
                  </optgroup>
                  <optgroup label="Comercial">
                    <option value='Exportadora Prize S.A'>Exportadora Prize S.A</option>
                    <option value='Transportes ProTrans SPA'>Transportes ProTrans SPA</option>
                    <option value='ComercialPrize SPA'>ComercialPrize SPA</option>
                    <option value='Prize ServiciosCorporativos SPA'>Prize ServiciosCorporativos SPA</option>
                  </optgroup>
                <?php } else if ($_SESSION['usuario_tipo']    == 2) {  ?>
                  <optgroup label="Industrial">
                    <option selected value='ProService BioBio SPA'>ProService BioBio SPA</option>
                  </optgroup>
                <?php } else if ($_SESSION['usuario_tipo']    == 3) {  ?>
                  <optgroup label="Agricola">

                    <option selected value='La Poza'>La Poza</option>

                  </optgroup>
                <?php } else if ($_SESSION['usuario_tipo']    == 4) {  ?>
                  <optgroup label="Agricola">
                    <option selected value='Los Gomeros'>Los Gomeros</option>
                  </optgroup>
                <?php } ?>
              </select>
            </p>
            <p>Fecha <input type="date" name="fecha_buscar" value="<?= $hoy2 ?>" /> </p>

            <button class="btn btn-success" type="submit">
              <span class="bi bi-search"></span>
            </button>



          </form>

        </div>
      </div>
      <div class="col-md-6">

        <button type="button" class="btn btn-primary btn-lg" onclick="excel2()">Exportar Excel</button>

      </div>

    </div>



    <form id="regiration_form" novalidate action="registro_nuevo_proc.php" method="post">
      <fieldset>
        <input type="button" name="data[password]" class="next btn btn-info" value="Siguiente" />
        <h2>Entidad A</h2>
        <table id="dtBasicExample" class="table table-responsive table-striped table-bordered table-condensed" cellspacing="0" width="100%">
          <thead class="black white-text">
            <tr class="row100 head">
              <th class="th-sm text-center "> <input type="checkbox" id="check1" onclick="todosselect()" /></th>
              <th class="th-sm text-center ">Acciones</th>
              <th class="th-md text-center">Usuario</th>
              <th class="th-md text-center">Nº Ficha</th>
              <th class="th-md text-center ">Fecha Ingreso</th>
              <th class="th-md text-center ">Fecha Termino</th>
              <th class="th-md text-center ">Turno</th>
              <th class="th-md text-center ">Registra Asist.</th>
              <th class="th-sm text-center">Tipo Contrato</th>
              <th class="th-sm text-center ">Cargo</th>
              <th class="th-sm text-center ">Transportista</th>
              <th class="th-sm text-center ">Nombre Transportista</th>
              <th class="th-sm text-center ">Faena</th>
              <th class="th-sm text-center ">Área</th>
              <th class="th-sm text-center ">Ex Empleado</th>
              <th class="th-sm text-center ">Cuantas Temporadas</th>
              <th class="th-sm text-center ">Observaciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            while ($row = $rs_ingresos->fetch_array(MYSQLI_ASSOC)) {
              $cont++;
              $id_ingre =  $row['ingresos_id'];
              $usuario_crea  =   $row['ingresos_usuario'];
              $fecha_ingreso  =   $row['ingresos_fecha_ing'];
              $fecha_termino  =    $row['ingresos_fecha_term'];
              $turno            =    $row['ingresos_turno'];
              $registra_asis    =    $row['ingresos_r_asistencia'];
              $tipo_contrato    =    $row['ingresos_tipo_contrato'];
              $cargo          =    $row['ingresos_cargo'];
              $trasportista    =    $row['ingresos_transportista'];
              $trans_nombre    =    $row['ingresos_transportista_nombre'];
              $faena            =    $row['ingresos_faena'];
              $area             =    $row['ingresos_area'];
              $exemple        =    $row['ingresos_exemple'];
              $c_tempor        =    $row['ingresos_c_temporadas'];
              $observa1        =    $row['ingresos_observacion1'];
            ?>

              <tr>
                <td title="" class="text-center">
                  <input type="checkbox" id='prod-<?= $id_ingre; ?> ' class="check">

                </td>
                <td title="Acciones" class="text-center">

                  <a title="Modificar" href="ingresos_modificar.php?id=<?= $row['ingresos_id'] ?>">
                    <i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
                  </a>
                  <a title="Eliminar" href="ingresos_eliminar.php?id=<?= $row['ingresos_id'] ?>" onclick="javascript: return confirm('¿Desea Eliminar Este Usuario?');">
                    <i class="bi bi-trash-fill fa-2x " style="margin-left:10px;"></i>
                  </a>
                </td>
                <td title="n"><?= $usuario_crea ?></td>
                <td title="n"><?= $cont ?></td>
                <td title="nombre"><?= $fecha_ingreso ?></td>
                <td title="tipo"><?= $fecha_termino ?></td>
                <td title="clave"><?= $turno ?></td>
                <td title="usuario"><?= $registra_asis ?></td>
                <td title="usuario"><?= $tipo_contrato ?></td>
                <td title="usuario"><?= $cargo   ?></td>
                <td title="usuario"><?= $trasportista   ?></td>
                <td title="usuario"><?= $trans_nombre ?></td>
                <td title="usuario"><?= $faena    ?></td>
                <td title="usuario"><?= $area  ?></td>
                <td title="usuario"><?= $exemple ?></td>
                <td title="usuario"><?= $c_tempor    ?></td>
                <td title="usuario"><?= $observa1        ?></td>



              </tr>
            <?php } //Fin while 
            ?>
          </tbody>
        </table>

        <input type="button" name="data[password]" class="next btn btn-info" value="Siguiente" />
      </fieldset>
      <?php
      if (isset($_POST['fecha_buscar'])) {
        $fecha_buscar = ($_POST['fecha_buscar']);
        $empresa_buscar = ($_POST['empresa_buscar']);
        $hoy2 = $fecha_buscar;

        if ($empresa_buscar == '*') {


          if ($_SESSION['usuario_tipo'] == 0) {


            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE
                    (ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    ingresos_empresa='ProService BioBio SPA'OR 
                    ingresos_empresa='Exportadora Prize S.A'OR 
                    ingresos_empresa='Transportes ProTrans SPA'OR 
                    ingresos_empresa='ComercialPrize SPA'OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA' OR
                    ingresos_empresa='AgroInvest SPA' OR
                    ingresos_empresa='La Poza' OR
                    ingresos_empresa='Los Gomeros')
                     and ingresos_fecha = '$hoy2'");
          } else if ($_SESSION['usuario_tipo'] == 1  || $_SESSION['usuario_tipo'] == 7) {
            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                    ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    ingresos_empresa='ProService BioBio SPA' OR 
                    ingresos_empresa='Exportadora Prize S.A' OR 
                    ingresos_empresa='Transportes ProTrans SPA' OR 
                    ingresos_empresa='ComercialPrize SPA' OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA')
                     and ingresos_fecha = '$hoy2'");
          }
        } else {
          $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_fecha = '$hoy2' and ingresos_empresa='$empresa_buscar'");
        }
      } else if ($_SESSION['usuario_tipo'] == 0 ) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT *
         FROM ingresos 
         WHERE ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 1 || $_SESSION['usuario_tipo'] == 7) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                                            ingresos_empresa='Prize ProService S.A' OR 
                                            ingresos_empresa='Agrocomercial Natura S.A' OR 
                                            /* ingresos_empresa='ProService BioBio SPA'OR */ 
                                            ingresos_empresa='Exportadora Prize S.A'OR 
                                            ingresos_empresa='Transportes ProTrans SPA'OR 
                                            ingresos_empresa='ComercialPrize SPA'OR 
                                            ingresos_empresa='Prize ServiciosCorporativos SPA') 
                                             and ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 2) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='ProService BioBio SPA' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 3) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='La Poza' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 4) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='Los Gomeros' AND   ingresos_fecha = '$hoy2'");
      }
      ?>
      <!--   Formulario De segundo entidad-->

      <fieldset>

        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

        <h2>Entidad B</h2>
        <table id="dtBasicExample" class="table table-responsive table-striped table-bordered table-condensed" cellspacing="0" width="100%">
          <thead class="black white-text">
            <tr class="row100 head">
              <th class="th-sm text-center ">Acciones</th>
              <th class="th-md text-center">Nº</th>
              <th class="th-md text-center ">Nombres</th>
              <th class="th-md text-center ">Apellido Paterno</th>
              <th class="th-md text-center ">Apellido Materno</th>
              <th class="th-md text-center ">Rut</th>
              <th class="th-sm text-center">Nacionalidad</th>
              <th class="th-sm text-center ">Sexo</th>
              <th class="th-sm text-center ">Fecha Nacimiento</th>
              <th class="th-sm text-center ">Telefono</th>
              <th class="th-xl text-center ">Direccion</th>
              <th class="th-sm text-center ">Comuna</th>
              <th class="th-sm text-center ">Ciudad</th>
              <th class="th-sm text-center ">Correo</th>
              <th class="th-sm text-center ">Estado Civil</th>
              <th class="th-sm text-center ">Contacto Emergen.</th>
              <th class="th-sm text-center ">Parentesco Emergen.</th>
              <th class="th-sm text-center ">Telefono Emerg</th>
              <th class="th-sm text-center ">Enfermedad Cronica</th>
              <th class="th-sm text-center ">Detalles Enf. Cronica</th>
              <th class="th-sm text-center ">observaciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            while ($row = $rs_ingresos->fetch_array(MYSQLI_ASSOC)) {
              $cont++;
              $nombre           =   $row['ingresos_nombre'];
              $apellidop       =    $row['ingresos_apellidop'];
              $Apellidom         =    $row['ingresos_apellidom'];
              $rut             =    $row['ingresos_rut'];
              $nacionalidad     =    $row['ingresos_nacionalidad'];
              $sexo              =    $row['ingresos_sexo'];
              $nacimiento      =    $row['ingresos_fecha_naci'];
              $fono             =    $row['ingresos_fono'];
              $direccion         =    $row['ingresos_direccion'];
              $comuna             =    $row['ingresos_comuna'];
              $ciudad          =    $row['ingresos_ciudad'];
              $estado_civil     =    $row['ingresos_estado_civil'];
              $correo             =    $row['ingresos_mail'];
              $emerg_nombre     =    $row['ingresos_emergencia_nombre'];
              $emerg_parentesco =    $row['ingresos_emergencia_parentesco'];
              $emerg_fono         =    $row['ingresos_emergencia_fono'];
              $enfermedad         =    $row['ingresos_enfermedad'];
              $enfermedad2     =    $row['ingresos_enfermedad_detalle'];
              $observa2         =    $row['ingresos_observacion2'];


            ?>

              <tr >
                <td title="Acciones" class="text-center">
                  <a title="Modificar" href="ingresos_modificar.php?id=<?= $row['ingresos_id'] ?>">
                    <i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
                  </a>
                  <a title="Eliminar" href="ingresos_eliminar.php?id=<?= $row['ingresos_id'] ?>" onclick="javascript: return confirm('¿Desea Eliminar Este Usuario?');">
                    <i class="bi bi-trash-fill fa-2x " style="margin-left:10px;"></i>
                  </a>
                </td>
                <td title="n"><?= $cont ?></td>
                <td title="nombre"><?= $nombre ?></td>
                <td title="tipo"><?= $apellidop  ?></td>
                <td title="clave"><?= $Apellidom ?></td>
                <td title="usuario"><?= $rut ?></td>
                <td title="usuario"><?= $nacionalidad ?></td>
                <td title="usuario"><?= $sexo    ?></td>
                <td title="usuario"><?= $nacimiento   ?></td>
                <td title="usuario"><?= $fono ?></td>
                <td  width='80' title="usuario"><?= $direccion    ?></td>
                <td title="usuario"><?= $comuna     ?></td>
                <td title="usuario"><?= $ciudad ?></td>
                <td title="usuario"><?= $correo    ?></td>
                <td title="usuario"><?= $estado_civil    ?></td>
                <td title="usuario"><?= $emerg_nombre    ?></td>
                <td title="usuario"><?= $emerg_parentesco    ?></td>
                <td title="usuario"><?= $emerg_fono    ?></td>
                <td title="usuario"><?= $enfermedad    ?></td>
                <td title="usuario"><?= $enfermedad2    ?></td>
                <td title="usuario"><?= $observa2        ?></td>



              </tr>
            <?php } //Fin while 
            ?>
          </tbody>
        </table>
        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
      </fieldset>
      <!--   Formulario De tercera entidad-->
      <?php
      if (isset($_POST['fecha_buscar'])) {
        $fecha_buscar = ($_POST['fecha_buscar']);
        $empresa_buscar = ($_POST['empresa_buscar']);
        $hoy2 = $fecha_buscar;

        if ($empresa_buscar == '*') {


          if ($_SESSION['usuario_tipo'] == 0 ) {


            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE
                      (ingresos_empresa='Prize ProService S.A' OR 
                      ingresos_empresa='Agrocomercial Natura S.A' OR 
                      ingresos_empresa='ProService BioBio SPA'OR 
                      ingresos_empresa='Exportadora Prize S.A'OR 
                      ingresos_empresa='Transportes ProTrans SPA'OR 
                      ingresos_empresa='ComercialPrize SPA'OR 
                      ingresos_empresa='Prize ServiciosCorporativos SPA' OR
                      ingresos_empresa='AgroInvest SPA' OR
                      ingresos_empresa='La Poza' OR
                      ingresos_empresa='Los Gomeros')
                       and ingresos_fecha = '$hoy2'");
          } else if ($_SESSION['usuario_tipo'] == 1 || $_SESSION['usuario_tipo'] == 7) {
            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                      ingresos_empresa='Prize ProService S.A' OR 
                      ingresos_empresa='Agrocomercial Natura S.A' OR 
                     /* ingresos_empresa='ProService BioBio SPA' OR */ 
                      ingresos_empresa='Exportadora Prize S.A' OR 
                      ingresos_empresa='Transportes ProTrans SPA' OR 
                      ingresos_empresa='ComercialPrize SPA' OR 
                      ingresos_empresa='Prize ServiciosCorporativos SPA')
                       and ingresos_fecha = '$hoy2'");
          }
        } else {
          $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_fecha = '$hoy2' and ingresos_empresa='$empresa_buscar'");
        }
      } else if ($_SESSION['usuario_tipo'] == 0 ) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT *
           FROM ingresos 
           WHERE ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 1 || $_SESSION['usuario_tipo'] == 7) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                                              ingresos_empresa='Prize ProService S.A' OR 
                                              ingresos_empresa='Agrocomercial Natura S.A' OR 
                                              /* ingresos_empresa='ProService BioBio SPA'OR */ 
                                              ingresos_empresa='Exportadora Prize S.A'OR 
                                              ingresos_empresa='Transportes ProTrans SPA'OR 
                                              ingresos_empresa='ComercialPrize SPA'OR 
                                              ingresos_empresa='Prize ServiciosCorporativos SPA') 
                                               and ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 2) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='ProService BioBio SPA' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 3) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='La Poza' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 4) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='Los Gomeros' AND   ingresos_fecha = '$hoy2'");
      }
      ?>
      <fieldset>
        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
        <h2>Entidad C</h2>
        <table id="dtBasicExample" class="table table-responsive table-striped table-bordered table-condensed" cellspacing="0" width="100%">
          <thead class="black white-text">
            <tr class="row100 head">
              <th class="th-sm text-center ">Acciones</th>
              <th class="th-md text-center">Nº</th>
              <th class="th-md text-center ">Prevision</th>
              <th class="th-md text-center ">Salud</th>
              <th class="th-md text-center ">Salud(UF)</th>
              <th class="th-md text-center ">Salud(%)</th>
              <th class="th-sm text-center">Salud($)</th>
              <th class="th-sm text-center ">Centro Costo</th>
              <th class="th-sm text-center ">Forma Pago</th>
              <th class="th-sm text-center ">Banco</th>
              <th class="th-sm text-center ">Cta Banco</th>
              <th class="th-sm text-center ">Sueldo Base</th>
              <th class="th-sm text-center ">Horas Semana</th>
              <th class="th-sm text-center ">Asig. Colacion</th>
              <th class="th-sm text-center ">Asig. Movilizacion</th>
              <th class="th-sm text-center ">Asig. Prop. dias Trab.</th>
              <th class="th-sm text-center ">Anticipo Variable</th>
              <th class="th-sm text-center ">Monto Anticipo Fijo</th>
              <th class="th-sm text-center ">observaciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            while ($row = $rs_ingresos->fetch_array(MYSQLI_ASSOC)) {
              $cont++;
              $prevision      =   $row['ingresos_prevision'];
              $salud              =    $row['ingresos_salud'];
              $salud2            =    $row['ingresos_plan_saluduf'];
              $salud3            =    $row['ingresos_plan_saludporc'];
              $salud4            =    $row['ingresos_plan_saludpeso'];
              $centro_costo   =    $row['ingresos_centro_costo'];
              $forma_pago        =    $row['ingresos_forma_pago'];
              $banco            =    $row['ingresos_banco'];
              $cuenta         =    $row['ingresos_cta_banco'];
              $sueldo         =    $row['ingresos_sueldo_base'];
              $horas_semana    =    $row['ingresos_horas_semana'];
              $asig_colacion    =    $row['ingresos_asig_colacion'];
              $asig_movil        =    $row['ingresos_asig_movil'];
              $prop_traba        =    $row['ingresos_prop_traba'];
              $anticipo_var    =    $row['ingresos_anticipo_var'];
              $anticipo_monto    =    $row['ingresos_anticipo_monto'];
              $observa3        =    $row['ingresos_observacion3'];


            ?>

              <tr>
                <td title="Acciones" class="text-center">
                  <a title="Modificar" href="ingresos_modificar.php?id=<?= $row['ingresos_id'] ?>">
                    <i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
                  </a>

                </td>
                <td title="n"><?= $cont ?></td>
                <td title="nombre"><?= $prevision ?></td>
                <td title="tipo"><?= $salud  ?></td>
                <td title="clave"><?= $salud2 ?></td>
                <td title="usuario"><?= $salud3 ?></td>
                <td title="usuario"><?= $salud4 ?></td>
                <td title="usuario"><?= $centro_costo ?></td>
                <td title="usuario"><?= $forma_pago    ?></td>
                <td title="usuario"><?= $banco ?></td>
                <td title="usuario"><?= $cuenta ?></td>
                <td title="usuario"><?= $sueldo   ?></td>
                <td title="usuario"><?= $horas_semana ?></td>
                <td title="usuario"><?= $asig_colacion        ?></td>
                <td title="usuario"><?= $asig_movil        ?></td>
                <td title="usuario"><?= $prop_traba        ?></td>
                <td title="usuario"><?= $anticipo_var    ?></td>
                <td title="usuario"><?= $anticipo_monto        ?></td>
                <td title="usuario"><?= $observa3        ?></td>



              </tr>
            <?php } //Fin while 
            ?>
          </tbody>
        </table>
        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />
        <input type="button" name="next" class="next btn btn-info" value="Siguiente" />



      </fieldset>


      <!--   Formulario De cuarta entidad-->

      <?php
      if (isset($_POST['fecha_buscar'])) {
        $fecha_buscar = ($_POST['fecha_buscar']);
        $empresa_buscar = ($_POST['empresa_buscar']);
        $hoy2 = $fecha_buscar;

        if ($empresa_buscar == '*') {


          if ($_SESSION['usuario_tipo'] == 0 || $_SESSION['usuario_tipo'] == 7) {


            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE
                    (ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    /*ingresos_empresa='ProService BioBio SPA'OR */ 
                    ingresos_empresa='Exportadora Prize S.A'OR 
                    ingresos_empresa='Transportes ProTrans SPA'OR 
                    ingresos_empresa='ComercialPrize SPA'OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA' OR
                    ingresos_empresa='AgroInvest SPA' OR
                    ingresos_empresa='La Poza' OR
                    ingresos_empresa='Los Gomeros')
                     and ingresos_fecha = '$hoy2'");
          } else if ($_SESSION['usuario_tipo'] == 1) {
            $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                    ingresos_empresa='Prize ProService S.A' OR 
                    ingresos_empresa='Agrocomercial Natura S.A' OR 
                    /* ingresos_empresa='ProService BioBio SPA' OR */ 
                    ingresos_empresa='Exportadora Prize S.A' OR 
                    ingresos_empresa='Transportes ProTrans SPA' OR 
                    ingresos_empresa='ComercialPrize SPA' OR 
                    ingresos_empresa='Prize ServiciosCorporativos SPA')
                     and ingresos_fecha = '$hoy2'");
          }
        } else {
          $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_fecha = '$hoy2' and ingresos_empresa='$empresa_buscar'");
        }
      } else if ($_SESSION['usuario_tipo'] == 0 || $_SESSION['usuario_tipo'] == 7) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT *
         FROM ingresos 
         WHERE ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 1) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE (
                                            ingresos_empresa='Prize ProService S.A' OR 
                                            ingresos_empresa='Agrocomercial Natura S.A' OR 
                                            /*ingresos_empresa='ProService BioBio SPA'OR */ 
                                            ingresos_empresa='Exportadora Prize S.A'OR 
                                            ingresos_empresa='Transportes ProTrans SPA'OR 
                                            ingresos_empresa='ComercialPrize SPA'OR 
                                            ingresos_empresa='Prize ServiciosCorporativos SPA') 
                                             and ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 2) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='ProService BioBio SPA' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 3) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='La Poza' AND ingresos_fecha = '$hoy2'");
      } else if ($_SESSION['usuario_tipo'] == 4) {
        $fecha_buscar = date('Y-m-d');
        $hoy2 = $fecha_buscar;
        $rs_ingresos = $conexion->query("SELECT * FROM ingresos WHERE ingresos_empresa='Los Gomeros' AND   ingresos_fecha = '$hoy2'");
      }
      ?>
      <fieldset>
        
        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />
        <h2>Entidad D</h2>

        <table id="dtBasicExample" class="table table-responsive table-striped table-bordered table-condensed" cellspacing="0" width="100%">
          <thead class="black white-text">
            <tr class="row100 head">
              <th class="th-sm text-center ">Acciones</th>
              <th class="th-md text-center">Nº</th>
              <th class="th-md text-center ">Estudios</th>
              <th class="th-md text-center ">Años Ex Empleador</th>
              <th class="th-md text-center ">Tipo Trabajador</th>
              <th class="th-md text-center ">Tope Gratificacion</th>
              <th class="th-sm text-center">Sueldo Diario</th>
              <th class="th-sm text-center ">Tipo Jornada</th>
              <th class="th-sm text-center ">Incluye Sabado</th>
              <th class="th-sm text-center ">Aplica Tarja</th>
              <th class="th-sm text-center ">observaciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $cont = 0;
            while ($row = $rs_ingresos->fetch_array(MYSQLI_ASSOC)) {
              $cont++;
              $estudios  =   $row['ingresos_estudios'];
              $anos_exemple  =    $row['ingresos_ano_exemple'];
              $tipo_trabajador            =    $row['ingresos_tipo_trabajador'];
              $tope_gratif    =    $row['ingresos_tope_gratif'];
              $sueldo_diario    =    $row['ingresos_sueldo_diario'];
              $tipo_jornada        =    $row['ingresos_tipo_jornada'];
              $sabados         =    $row['ingresos_sabado'];
              $tarja    =    $row['ingresos_tarja'];
              $observa4        =    $row['ingresos_observaciones4'];


            ?>

              <tr>
                <td title="Acciones" class="text-center">
                  <a title="Modificar" href="ingresos_modificar.php?id=<?= $row['ingresos_id'] ?>">
                    <i class="bi bi-pencil-fill fa-2x " style="margin-left:10px;"></i>
                  </a>

                </td>
                <td title="n"><?= $cont ?></td>
                <td title="nombre"><?= $estudios ?></td>
                <td title="tipo"><?= $anos_exemple  ?></td>
                <td title="clave"><?= $tipo_trabajador ?></td>
                <td title="usuario"><?= $tope_gratif ?></td>
                <td title="usuario"><?= $sueldo_diario ?></td>
                <td title="usuario"><?= $tipo_jornada ?></td>
                <td title="usuario"><?= $sabados  ?></td>
                <td title="usuario"><?= $tarja ?></td>
                <td title="usuario"><?= $observa4    ?></td>



              </tr>
            <?php } //Fin while 
            ?>
          </tbody>
        </table>
        <input type="button" name="previous" class="previous btn btn-warning" value="Previo" />

      </fieldset>
    </form>
  </div>
  <div class="col-auto  p-5 text-center">
    <button type="button" class="btn btn-success" id="delselected"><i class="bi bi-file-earmark-excel"></i> Exportar seleccionados</button>
  </div>
</body>

</html>
<script type="text/javascript">
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

  function calcularEdad(fecha_naci) {

    var cumpleanos = fecha_naci.value;
    var hoy = new Date();

    console.log(hoy);
    console.log(cumpleanos);
    console.log(cumpleanos.format("DD/MM/YYYY"));

    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    console.log(hoy);
    console.log(cumpleanos);
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
      edad--;
    }
    if (edad > 17) {
      console.log("mayor");
      return (true);
    } else {
      console.log("menor");
      return (false);
    }
  }

  /* window.onload = function() {
       var fecha = new Date(); //Fecha actual
       var mes = fecha.getMonth() + 1; //obteniendo mes
       var dia = fecha.getDate(); //obteniendo dia
       var ano = fecha.getFullYear(); //obteniendo año
       if (dia < 10)
           dia = '0' + dia; //agrega cero si el menor de 10
       if (mes < 10)
           mes = '0' + mes; //agrega cero si el menor de 10
       document.getElementById('fecha_actual').value = ano + "-" + mes + "-" + dia;
   }*/
</script>

<script>
  function excel() {

    //---------------------------------------------------------------------- 
    let flatpickrInstance


    Swal.fire({
      title: 'Por Favor Ingrese Fecha de Ficha',
      html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">' + 
            '<input id="swal2-radio-1" type="radio" name="swal2-radio" value="3">',


      stopKeydownPropagation: false,
      preConfirm: () => {
        if (flatpickrInstance.selectedDates[0] < new Date()) {
          $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
            window.location.href = "excel1.php?fecha=" + $fecha;
          console.log($fecha)
        }
      },
      willOpen: () => {
        flatpickrInstance = flatpickr(
          Swal.getPopup().querySelector('#expiry-date')
        )
      }
    })
  }



  function excel2() {
    usuario_t = $("#usuario_t").val();
    if (usuario_t == 0) {
      Swal.fire({
        title: 'Selecciona Empresa',
        input: 'select',
        inputOptions: {
          'Industrial': {
            'Prize ProService S.A': 'Prize ProService S.A',
            'Agrocomercial Natura S.A': 'Agrocomercial Natura S.A'//,
           // 'ProService BioBio SPA': 'ProService BioBio SPA'

          },
          'Comercial': {
            'Exportadora Prize S.A': 'Exportadora Prize S.A',
            'Transportes ProTrans SPA': 'Transportes ProTrans SPA',
            'ComercialPrize SPA': 'ComercialPrize SPA',
            'Prize ServiciosCorporativos SPA': 'Prize ServiciosCorporativos SPA',

          },
          'Agricola': {
            'AgroInvest SPA': 'AgroInvest SPA',
            'La Poza': 'La Poza',
            'Los Gomeros': 'Los Gomeros',

          }
        },
        inputPlaceholder: 'Selecciona Empresa',
        showCancelButton: true,
        inputValidator: (value) => {
          $empresa = value;
          Swal.fire({
            title: 'Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">'+ 
                  '<input id="swal2-radio" type="checkbox" name="swal2-radio" ><b>PM</b>',
            
        

            stopKeydownPropagation: false,
            preConfirm: () => {
              if (flatpickrInstance.selectedDates[0] < new Date()) {
                var pm = Swal.getPopup().querySelector('#swal2-radio').checked
                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
               
                console.log(pm);
                if(pm){
                $turno='noche';

                }else{
                 $turno='dia' 
                }
               window.location.href = "excel1.php?fecha=" + $fecha + "&empresa=" + $empresa + "&turno=" + $turno;
                console.log($fecha + $empresa + $turno)
              }
            },
            willOpen: () => {
              flatpickrInstance = flatpickr(
                Swal.getPopup().querySelector('#expiry-date')
              )
            }
          })


        }
      })
    } else if (usuario_t == 1) {


      Swal.fire({
        title: 'Selecciona Empresa',
        input: 'select',
        inputOptions: {
          'Industrial': {
            'Prize ProService S.A': 'Prize ProService S.A',
            'Agrocomercial Natura S.A': 'Agrocomercial Natura S.A'//,
           // 'ProService BioBio SPA': 'ProService BioBio SPA'

          },
          'Comercial': {
            'Exportadora Prize S.A': 'Exportadora Prize S.A',
            'Transportes ProTrans SPA': 'Transportes ProTrans SPA',
            'ComercialPrize SPA': 'ComercialPrize SPA',
            'Prize ServiciosCorporativos SPA': 'Prize ServiciosCorporativos SPA',

          }
        },
        inputPlaceholder: 'Selecciona Empresa',
        showCancelButton: true,
        inputValidator: (value) => {
          $empresa = value;
          Swal.fire({
            title: 'Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">'+ 
                  '<input id="swal2-radio" type="checkbox" name="swal2-radio" ><b>PM</b>',
            
        

            stopKeydownPropagation: false,
            preConfirm: () => {
              if (flatpickrInstance.selectedDates[0] < new Date()) {
                var pm = Swal.getPopup().querySelector('#swal2-radio').checked
                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
               
                console.log(pm);
                if(pm){
                $turno='noche';

                }else{
                 $turno='dia' 
                }
               window.location.href = "excel1.php?fecha=" + $fecha + "&empresa=" + $empresa + "&turno=" + $turno;
                console.log($fecha + $empresa + $turno)
              }
            },
            willOpen: () => {
              flatpickrInstance = flatpickr(
                Swal.getPopup().querySelector('#expiry-date')
              )
            }
          })


        }
      })

    } else if (usuario_t == 2) {


      Swal.fire({
        title: 'Selecciona Empresa',
        input: 'select',
        inputOptions: {
          'Agricola': {
            'ProService BioBio SPA': 'ProService BioBio SPA',


          }
        },
        inputPlaceholder: 'Selecciona Empresa',
        showCancelButton: true,
        inputValidator: (value) => {
          $empresa = value;
          Swal.fire({
            title: 'Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">'+ 
                  '<input id="swal2-radio" type="checkbox" name="swal2-radio" ><b>PM</b>',
            
        

            stopKeydownPropagation: false,
            preConfirm: () => {
              if (flatpickrInstance.selectedDates[0] < new Date()) {
                var pm = Swal.getPopup().querySelector('#swal2-radio').checked
                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
               
                console.log(pm);
                if(pm){
                $turno='noche';

                }else{
                 $turno='dia' 
                }
               window.location.href = "excel1.php?fecha=" + $fecha + "&empresa=" + $empresa + "&turno=" + $turno;
                console.log($fecha + $empresa + $turno)
              }
            },
            willOpen: () => {
              flatpickrInstance = flatpickr(
                Swal.getPopup().querySelector('#expiry-date')
              )
            }
          })


        }
      })

    } else if (usuario_t == 3) {


      Swal.fire({
        title: 'Selecciona Empresa',
        input: 'select',
        inputOptions: {
          'Agricola': {

            'La Poza': 'La Poza',


          }
        },
        inputPlaceholder: 'Selecciona Empresa',
        showCancelButton: true,
        inputValidator: (value) => {
          $empresa = value;
          Swal.fire({
            title: 'Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">',


            stopKeydownPropagation: false,
            preConfirm: () => {
              if (flatpickrInstance.selectedDates[0] < new Date()) {
                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
                  window.location.href = "excel1.php?fecha=" + $fecha + "&empresa=" + $empresa;
                console.log($fecha + $empresa)
              }
            },
            willOpen: () => {
              flatpickrInstance = flatpickr(
                Swal.getPopup().querySelector('#expiry-date')
              )
            }
          })


        }
      })

    } else if (usuario_t == 4) {


      Swal.fire({
        title: 'Selecciona Empresa',
        input: 'select',
        inputOptions: {
          'Agricola': {

            'Los Gomeros': 'Los Gomeros',

          }
        },
        inputPlaceholder: 'Selecciona Empresa',
        showCancelButton: true,
        inputValidator: (value) => {
          $empresa = value;
          Swal.fire({
            title: 'Ingrese Fecha de Ficha',
            html: '<input class="swal2-input" id="expiry-date" placeholder="Ingrese Fecha">',


            stopKeydownPropagation: false,
            preConfirm: () => {
              if (flatpickrInstance.selectedDates[0] < new Date()) {
                $fecha = flatpickrInstance.selectedDates[0].getDate() + "-" + (flatpickrInstance.selectedDates[0].getMonth() + 1).toString().padStart(2, "0") + "-" + flatpickrInstance.selectedDates[0].getFullYear(),
                  window.location.href = "excel1.php?fecha=" + $fecha + "&empresa=" + $empresa;
                console.log($fecha + $empresa)
              }
            },
            willOpen: () => {
              flatpickrInstance = flatpickr(
                Swal.getPopup().querySelector('#expiry-date')
              )
            }
          })


        }
      })

    }

  }
</script>

<script type="text/javascript">
  function todosselect() {
    if ($('#check1').prop('checked')) {
      checks = document.querySelectorAll(".check");
      if (checks.length > 0) {
        for (i = 0; i < checks.length; i++) {
          checks[i].checked = true;
        }
      }
      console.log("Checkbox seleccionado");
    } else {
      checks = document.querySelectorAll(".check");
      if (checks.length > 0) {
        for (i = 0; i < checks.length; i++) {
          checks[i].checked = false;
        }
      }
      console.log("Checkbox desseleccionado");
    }
  }

  $(document).ready(function() {



    $("#delselected").click(function() {
      // Obtenenos los ids de los elementos que esten seleccionados "checked"
      checks = document.querySelectorAll(".check:checked");
      // Verificamos que la cantidad de elementos seleccionados sea mayor a 0 (cero)
      if (checks.length > 0) {
        // Si hay elementos seleccionados
        // Le preguntamos al usuario si esta seguro de eliminar
        Swal.fire({
          title: 'Se van a exportar '+checks.length+' Usuarios',
          text: "¿Desea Exportar en excel los usuarios seleccionados?",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI'
        }).then((result) => {
          if (result.isConfirmed) {

            console.log('se confirma ejecucion')
            // Si el usuario esta seguro, procedemos
            // la variable ids contiene los IDs de los elementos seleccionados
            ids = "";
            // En el siguiente ciclo vamos a recorrer los elementos seleccionamos y guardaremos los IDs separados por comas (,) en la variable ids
            for (i = 0; i < checks.length; i++) {
              // Los ids de los productos estan en los checkbox como "producto-ID" entonces tenemos que hacer SPLIT y despues usar el elemento [1] que es el ID, el elemento [0] es "product"
              p = checks[i].id.split("-");
              // agregamos el ID a la variable ids
              ids += p[1] + ",";
            }
            // En la siguiente funcion AJAX vamos a enviar los IDS al archivo delproduct.php
            window.location.href = "archivos/excel3.php?ids=" + ids;

            //fin ajax

            Swal.fire( 'Usuarios Exportados' )

          }
        })




      } else {
        // Si no hay elementos seleccionados
        Swal.fire('No hay usuarios seleccionados')
      }
    });
  });
</script>