<?php

session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:index.php");
    exit;
}
include('conexion_qbiz.php');

$id_ingresos = $_GET['id'];




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>

    <meta charset="UTF-8">

    <title>ficha contratacion</title>
</head>

<body>
    <?php
    $hoy = date("dd-mm-yyyy");


    include('conexion.php');

    $rs_ingresos = $conexion->query("SELECT * FROM ingresos where ingresos_id= '$id_ingresos'");
   # echo("SELECT * FROM ingresos where ingresos_id= '$id_ingresos'");
    $row = $rs_ingresos->fetch_array(MYSQLI_ASSOC);

    $m_fecha_ing = $row['ingresos_fecha_ing'];
    $m_fecha_term = $row['ingresos_fecha_term'];
    $m_empresa= $row['ingresos_empresa'];
    $m_turno = $row['ingresos_turno'];
    $m_r_asistencia = $row['ingresos_r_asistencia'];
    $m_tipo_contrato = $row['ingresos_tipo_contrato'];
    $m_cargo = $row['ingresos_cargo'];
    $m_transportista = $row['ingresos_transportista'];
    $m_transportista_nombre = $row['ingresos_transportista_nombre'];
    $m_faena = $row['ingresos_faena'];
    $m_area = $row['ingresos_area'];
    $m_exemple = $row['ingresos_exemple'];
    $m_c_temporadas = $row['ingresos_c_temporadas'];
    $m_observacion1  = $row['ingresos_observacion1'];

    $m_nombre = $row['ingresos_nombre'];
    $m_apellidop  = $row['ingresos_apellidop'];
    $m_apellidom = $row['ingresos_apellidom'];
    $m_rut = $row['ingresos_rut'];
    $m_nacionalidad = $row['ingresos_nacionalidad'];
    $m_sexo = $row['ingresos_sexo'];
    $m_fecha_naci = $row['ingresos_fecha_naci'];
    $m_fono = $row['ingresos_fono'];
    $m_direccion = $row['ingresos_direccion'];
    $m_comuna = $row['ingresos_comuna'];
    $m_ciudad = $row['ingresos_ciudad'];
    $m_estado_civil  = $row['ingresos_estado_civil'];
    $m_mail = $row['ingresos_mail'];
    $m_emergencia_nombre = $row['ingresos_emergencia_nombre'];
    $m_emergencia_parentesco = $row['ingresos_emergencia_parentesco'];
    $m_emergencia_fono = $row['ingresos_emergencia_fono'];
    $m_enfermedad = $row['ingresos_enfermedad'];
    $m_enfermedad_detalle = $row['ingresos_enfermedad_detalle'];
    $m_observacion2 = $row['ingresos_observacion2'];

    $m_prevision = $row['ingresos_prevision'];
    $m_salud = $row['ingresos_salud'];
    $m_plan_saluduf = $row['ingresos_plan_saluduf'];
    $m_plan_saludporc = $row['ingresos_plan_saludporc'];
    $m_plan_saludpeso = $row['ingresos_plan_saludpeso'];
    $m_centro_costo = $row['ingresos_centro_costo'];
    $m_sueldo_base = $row['ingresos_sueldo_base'];
    $m_horas_semana = $row['ingresos_horas_semana'];
    $m_forma_pago = $row['ingresos_forma_pago'];
    $m_banco = $row['ingresos_banco'];
    $m_cta_banco = $row['ingresos_cta_banco'];
    $m_asig_colacion = $row['ingresos_asig_colacion'];
    $m_asig_movil = $row['ingresos_asig_movil'];
    $m_prop_traba = $row['ingresos_prop_traba'];
    $m_anticipo_var = $row['ingresos_anticipo_var'];
    $m_anticipo_monto = $row['ingresos_anticipo_monto'];
    $m_observacion3 = $row['ingresos_observacion3'];

    $m_estudios = $row['ingresos_estudios'];
    $m_ano_exemple = $row['ingresos_ano_exemple'];
    $m_tipo_trabajador = $row['ingresos_tipo_trabajador'];
    $m_tope_gratif = $row['ingresos_tope_gratif'];
    $m_sueldo_diario = $row['ingresos_sueldo_diario'];
    $m_tipo_jornada = $row['ingresos_tipo_jornada'];
    $m_sabado = $row['ingresos_sabado'];
    $m_tarja = $row['ingresos_tarja'];
    $m_observaciones4 = $row['ingresos_observaciones4'];

    $rs_sueldoMax = $conexion->query('SELECT codigos_descripcion FROM codigos where codigos_id = 4391 ');
    $row = $rs_sueldoMax->fetch_array(MYSQLI_ASSOC);
    $sueldoMaximo = $row['codigos_descripcion'];

    $rs_sueldoMin = $conexion->query('SELECT codigos_descripcion FROM codigos where codigos_id = 4392 ');
    $row = $rs_sueldoMin->fetch_array(MYSQLI_ASSOC);
    $sueldoMinimo = $row['codigos_descripcion'];

    ?>

<div class="input-group">
        <input type="number" class="form-control" style="width:30% " id="sueldomin" name="sueldomin" hidden value="<?= $sueldoMinimo ?>">
        <input type="number" class="form-control" style="width:30% " id="sueldomax" name="sueldomax" hidden value="<?= $sueldoMaximo ?>">
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="ingresos.php">Ingresos <span class="sr-only">(current)</span></a>
                <?php if($_SESSION['usuario_tipo']==0){?>
                <a class="nav-item nav-link" href="usuarios.php">Usuarios</a>
                <?php }else { ?>
                    <a class="nav-item nav-link" hidden href="usuarios.php">Usuarios</a>
                <?php } ?>
            </div>
        </div>

        <a class="nav-item nav-link disable" href="#"><?php echo $_SESSION['usuario_nombre'] ?></a>
        <a href="salir.php"><button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar Sesion</button></a>


    </nav>
    <div class="container">
        <h1>Registro de nuevo trabajador paso a paso</h1>

        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <form id="regiration_form" action="ingresos_modificar_proc.php" method="post" onsubmit="return validaCampos();">
            <!--Alerta de menor de edad -->
            <div id=alert_menor class="alert alert-danger  alert-dismissible" role="alert" style="display:none">Trabajador Menor de Edad</div>

            <input type="number" class="form-control" style="width:30% " id="id" name="id" hidden value="<?= $id_ingresos ?>">
            <?php

            ?>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="rut">Rut</label>
                        <div class="input-group">
                            <input type="rut" class="form-control" style="width:30% " id="rut" name="rut" readonly onkeyup="formato_rut(this)" value="<?= $m_rut ?>">

                        </div>
                    </div>
                    <div class="col">
                        <label for="rut">Empresa</label>
                        <div class="input-group">
                            <input type="rut" class="form-control" style="width:30% " id="empresa" name="empresa" readonly value="<?= $m_empresa ?>">

                        </div>
                    </div>
                </div>

                <fieldset>


                    <!--   Formulario De Primera entidad-->
                    <h2>Paso 1: Entidad A</h2>
                    <div class="col-md-12">
                        <div class="form-group">


                            <div class="row">
                                <div class="col">
                                    <!-- input de fecha de ingreso -->
                                    <label for="rut">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="fecha_actual" name="fecha_ingreso" value="<?= $m_fecha_ing?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Fecha de Termino</label>
                                    <input type="date" class="form-control" id="fecha_termino" name="fecha_termino" value="<?= $m_fecha_term?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Turno</label>
                                    <div>
                                        <select class="form-control" name="turno" id="turno" >   
                                            <?php if($m_turno=='DIA') {?>
                                            <option value=""></option>
                                            <option selected value="DIA">DIA</option>
                                            <option value="NOCHE">NOCHE</option>
                                    <?php } else if($m_turno=='NOCHE'){ ?>
                                        <option value=""></option>
                                            <option  value="DIA">DIA</option>
                                            <option selected value="NOCHE">NOCHE</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="DIA">DIA</option>
                                            <option value="NOCHE">NOCHE</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label> Registra Asistencia</label>
                                    <div>
                                        <select class="form-control" name="asistencia" id="asistencia">
                                            <option value="SI" selected>Si</option>
                                            <option value="NO">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label>Tipo Contrato</label>
                                    <div>
                                        <select class="form-control" name="tipo_contrato" id="tipo_contrato">
                                        <?php if($m_tipo_contrato=='POR OBRA') {?>
                                            <option selected value="POR OBRA">POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                    <?php } else if($m_tipo_contrato=='PLAZO FIJO'){ ?>
                                                <option value="POR OBRA" >POR OBRA</option>
                                                <option selected value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                        <?php }else if($m_tipo_contrato=='INDEFINIDO'){ ?>
                                                <option value="POR OBRA" >POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option selected value="INDEFINIDO">INDEFINIDO</option>
                                        <?php }else{?>
                                            <option selected value="" ></option>
                                                <option value="POR OBRA">POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                            <?php } ?>
                                           


                                        </select>
                                    </div>

                                    <?php

                                    $rs_cargo = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "cargo" ');


                                    ?>

                                </div>
                                <div class="col">
                                    <label for="rut">Cargo</label>
                                    <div>
                                        <select class="form-control" name="cargo" id="cargo">
                                            <option value="" disabled selected></option>
                                            <?php
                                            while ($row = $rs_cargo->fetch_array(MYSQLI_ASSOC)) {
                                                if ($row['codigos_nombre'] == $m_cargo) {
                                                    echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                                                     
                                            } else {
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <label style="color: red;">*</label><label> Transportista</label>
                                    <div>
                                        <select class="form-control" name="transportista" id="transportista">
                                        <?php if($m_transportista=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_transportista=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>



                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label>Nombre Trasportista</label>
                                    <input type="text" class="form-control" id="transportista_nombre" name="transportista_nombre" placeholder="Nombre Trasportista" value="<?= $m_transportista_nombre?>">

                                </div>
                            </div>

                            <?php

                            $rs_faena = $conexion->query('SELECT codigos_nombre,codigos_id FROM codigos where codigos_tipo like "faenas" ');
                            //Llamamos el select las faenas de la base

                            ?>

                            <div class="row">

                                <div class="col">
                                    <label for="rut">Faena</label>
                                    <div>
                                        <select class="form-control" name="faena" id="faena">
                                            <option value=" " disabled selected></option>
                                            <?php
                                            while ($row = $rs_faena->fetch_array(MYSQLI_ASSOC)) {

                                                if ($row['codigos_nombre'] == $m_faena) {
                                                    echo '<option selected value="' . $row['codigos_id'] . '">' . $row['codigos_nombre'] . '</option>';
                                                                                     
                                            } else {
                                                echo '<option value="' . $row['codigos_id'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php

                                $rs_area = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "area" ');


                                ?>
                                <div class="col">
                                    <label for="rut">Area</label>
                                    <div>
                                        <select class="form-control" name="area" id="area">
                                            <option value=" " disabled selected></option>
                                            <?php
                                            while ($row = $rs_area->fetch_array(MYSQLI_ASSOC)) {

                                                if ($row['codigos_nombre'] == $m_area) {
                                                    echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                                                     
                                            } else {
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="rut">Ex Empleado</label>
                                    <div>
                                        <select class="form-control" name="ex_emple" id="ex_emple">
                                        <?php if($m_exemple=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_exemple=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Cuantas Temporadas</label>
                                        <input type="number" class="form-control" id="cuantas_temp" name="cuantas_temp" value="<?= $m_c_temporadas?>">
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_1" placeholder="Observaciones" ><?= $m_observacion1?></textarea>
                    </div>

                    <input type="button" name="data[password]" class="next btn btn-info" value="Siguiente" />
                </fieldset>



                <!--   Formulario De segundo entidad-->

                <fieldset>
                    <h2>Paso 2: Entidad B</h2>
                    <div class="col-md-12">

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label>Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $m_nombre ?>">

                                </div>

                                <div class="col">
                                    <label style="color: red;">*</label><label>Apellido Paterno</label>
                                    <input type="text" class="form-control " id="apellidoP" name="apellidoP" value="<?= $m_apellidop ?>">

                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label>Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?= $m_apellidom ?>">
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Fecha de Nacimiento</label>
                                    <!-- <span style="border-image: initial; border: 1px solid red;">Menor de edad</span>
                            -->
                                    <input type="date" class="form-control" id="fecha_naci" name="fecha_naci" onchange="calcularEdad(this)" value="<?= $m_fecha_naci ?>">

                                </div>
                            </div>

                            <div class="row">
                                <?php


                                $rs_nacionalidad = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "nacionalidad" ');


                                ?>
                                <div class="col">
                                    <label style="color: red;">*</label><label>Nacionalidad</label>

                                    <select class="form-control" name="nacionalidad" id="nacionalidad" style="width: 100%;">
                                        <option value="<?php echo $nacionalidad_qbiz ?>" disabled selected></option>
                                        <?php
                                        while ($row = $rs_nacionalidad->fetch_array(MYSQLI_ASSOC)) {
                                            if ($row['codigos_nombre'] == $m_nacionalidad) {
                                                echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            } else {
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>

                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label>Sexo</label>
                                    <div>
                                        <select class="form-control" name="sexo" id="sexo" style="width: 100%;">
                                            <?php if ($m_sexo == 'MASCULINO') { ?>
                                                <option selected value="MASCULINO">Masculino</option>
                                                <option value="FEMENINO">Femenino</option>
                                            <?php } else if ($m_sexo == 'FEMENINO') { ?>
                                                <option value="MASCULINO">Masculino</option>
                                                <option selected value="FEMENINO">Femenino</option>
                                            <?php  } else { ?>
                                                <option value=""></option>
                                                <option value="MASCULINO">Masculino</option>
                                                <option value="FEMENINO">Femenino</option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Fono Contacto</label>
                                    <input type="text" class="form-control" id="fono" name="fono" value="<?= $m_fono ?>">
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label>Mail</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= $m_mail ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label>Estado Civil</label>
                                    <div>
                                        <select class="form-control" name="estado_civil" id="estado_civil" style="width: 100%;">
                                            <?php if ($m_estado_civil == 'SOLTERO(A)') { ?>
                                                <option value=""></option>
                                                <option selected value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } else 
                                        if ($m_estado_civil == 'CASADO(A)') { ?>
                                                <option value=""></option>
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option selected value="CASADO(A)">CASADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } else 
                                        if ($m_estado_civil == 'VIUDO(A)') { ?>
                                                <option value=""></option>
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option selected value="VIUDO(A)">VIUDO(A)</option>
                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } else 
                                        if ($m_estado_civil == 'SEPARADO(A)') { ?>
                                                <option value=""></option>
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                <option selected value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } else if ($m_estado_civil == 'DIVORCIADO(A)') { ?>
                                                <option value=""></option>
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option selected value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } else { ?>
                                                <option value=""></option>
                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                <option value="CASADO(A)">CASADO(A)</option>
                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col">

                                    <label for="address">Direccion</label>
                                    <input class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $m_direccion ?>">
                                </div>
                                <div class="col">
                                    <?php $rs_comuna = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "comuna" '); ?>


                                    <label style="color: red;">*</label><label for="comuna">Comuna</label>
                                    <select class="form-control" name="comuna" id="comuna" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        while ($row = $rs_comuna->fetch_array(MYSQLI_ASSOC)) {
                                            if ($row['codigos_nombre'] == $m_comuna) {
                                                echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            } else {
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col">

                                    <?php $rs_ciudad = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "CIUDAD" '); ?>


                                    <label style="color: red;">*</label><label for="ciudad">Ciudad</label>
                                    <select class="form-control" name="ciudad" id="ciudad" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        while ($row = $rs_ciudad->fetch_array(MYSQLI_ASSOC)) {
                                            if ($row['codigos_nombre'] == $m_ciudad) {
                                                echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            } else {
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Contacto Emergencia</label>
                                    <input type="text" class="form-control" id="nombre_emerg" name="nombre_emergencia" value="<?= $m_emergencia_nombre?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Parentesco Emergencia</label>
                                    <input type="text" class="form-control" id="parentesco_emerg" name="parentesco_emergencia" value="<?= $m_emergencia_parentesco?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Fono Emergencia</label>
                                    <input type="text" class="form-control" id="fono_emergencia" name="fono_emergencia" value="<?= $m_emergencia_fono?>">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Enfermedad Crónica</label>
                                    <div>
                                        <select class="form-control" name="enfermedad" id="enfermedad" style="width: 100%;">
                                    <?php if($m_enfermedad=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_enfermedad=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="rut">Indicar Cual enfermedad Cronica</label>
                                    <input type="text" class="form-control" id="detalle_enfermedad" name="detalle_enfermedad" value="<?= $m_enfermedad_detalle?>">
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_2" placeholder="Observaciones"> <?= $m_observacion2?></textarea>
                    </div>
                    <input type="button" name="previous" class="previous btn btn-default" value="Previo" />
                    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                </fieldset>
                <!--   Formulario De tercera entidad-->
                <fieldset>
                    <h2>Paso 3: Entidad C</h2>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Prevision</label>
                                    <div>
                                        <?php


                                        $rs_prevision = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "prevision" ');


                                        ?>

                                        <select class="form-control" name="prevision" id="prevision" style="width: 100%;" onchange="bloqueoPrevision(this)">
                                            <option value=""></option>
                                            <?php
                                            while ($row = $rs_prevision->fetch_array(MYSQLI_ASSOC)) {
                                                if ($row['codigos_nombre'] == $m_prevision) {
                                                    echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Salud</label>
                                    <div>

                                        <?php


                                        $rs_salud = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "ISAPRE" ');


                                        ?>
                                        <select class="form-control" name="salud" id="salud" onchange="bloqueosalud(this)" style="width: 100%;">
                                            <option value=""></option>
                                            <?php
                                            while ($row = $rs_salud->fetch_array(MYSQLI_ASSOC)) {
                                                if ($row['codigos_nombre'] == $m_salud) {
                                                    echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                } else {

                                                    echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Plan Salud(UF))</label>
                                    <input type="text" class="form-control" id="plan_saludUF" name="plan_saludUF" value="<?= $m_plan_saluduf?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Plan Salud(%)</label>
                                    <input type="text" class="form-control" id="plan_salud%" name="plan_salud%" value="<?= $m_plan_saludporc?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Plan Salud($)</label>
                                    <input type="text" class="form-control" id="plan_salud$" name="plan_salud$" value="<?= $m_plan_saludpeso?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Centro de Costo</label>
                                    <div>

                                        <?php


                                        $rs_centro_costo = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "centro costo" ');


                                        ?>

                                        <select class="form-control" name="centro_costos" id="centro_costos" style="width: 100%;">
                                            <option value=" " selected></option>
                                            <?php
                                            while ($row = $rs_centro_costo->fetch_array(MYSQLI_ASSOC)) {
                                             if($row['codigos_nombre']== $m_centro_costo)
                                             {
                                                echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                             }else{
                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }}
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <?php


$rs_tramos = $conexion->query("SELECT tramos_nombre,tramos_id FROM tramos ");


?>

<div class="col">
<label for="tramo">Tramo</label>
<div>
   <select class="form-control" name="tramo" id="tramo" required style="width: 100%;" onchange="portramos()">
   <option selected value="-1"  selected></option>
       <?php
       while ($row = $rs_tramos->fetch_array(MYSQLI_ASSOC)) {
        
               echo '<option value="' . $row['tramos_id'] . '">' . $row['tramos_nombre'] . '</option>';
                                                
     
   }
   ?>
   </select>
</div>
</div>

                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Sueldo Base</label>
                                    <input type="number" class="form-control" id="sueldo_base" maxlength="8" name="sueldo_base" value="<?= $m_sueldo_base?>" >
                                </div>
                                <div class="col">
                                    <label for="rut">Horas Semana</label>
                                    <input type="text" class="form-control" id="horas_semana" name="horas_semana" value="<?= $m_horas_semana?>">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Forma de Pago</label>
                                    <div>
                                        <select class="form-control" name="forma_pago" id="forma_pago" style="width: 100%;">
                                            <option value=""></option>
                                            <option selected value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Banco</label>
                                    <div>

                                        <?php
                                        mysqli_free_result($rs_centro_costo);

                                        $rs_banco = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "banco" ');


                                        ?>
                                        <select class="form-control" name="banco" id="banco" style="width: 100%;" onchange="bancoestado(this)">
                                            <option value=""></option>
                                            <?php
                                            while ($row = $rs_banco->fetch_array(MYSQLI_ASSOC)) {
                                                if ($row['codigos_nombre'] == $m_banco) {
                                                    echo '<option selected value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                } else {

                                                    echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Cta Banco</label>
                                    <input type="number" class="form-control" id="cta_banco" name="cta_banco" value="<?= $m_cta_banco?>">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Asig. Colacion</label>
                                    <input type="number" class="form-control" id="asig_colacion" name="asig_colacion" value="<?= $m_asig_colacion?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Asig. Movilizacion</label>
                                    <input type="number" class="form-control" id="asig_movilizacion" name="asig_movilizacion" value="<?= $m_asig_movil?>">

                                </div>
                                <div class="col">
                                    <label for="rut">Asig. Prop. Días Trab</label>
                                    <div>
                                        <select class="form-control" name="asig_prop_traba" id="asig_prop_traba" style="width: 100%;">
                                        <?php if($m_prop_traba=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_prop_traba=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Anticipo Variable</label>
                                    <div>
                                        <select class="form-control" name="anticipo_variable" id="anticipo_variable" style="width: 100%;">
                                        <?php if($m_anticipo_var=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_anticipo_var=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Monto Anticipo Fijo</label>
                                    <div>
                                        <select class="form-control" name="monto_anticipo" id="monto_anticipo" style="width: 100%;">
                                        <?php if($m_anticipo_monto=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_anticipo_monto=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>



                        </div>
                    </div>

                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" name="observaciones_3" placeholder="Observaciones"><?= $m_observacion3?></textarea>
                    </div>


                    <input type="button" name="previous" class="previous btn btn-default" value="Previo" />
                    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                </fieldset>


                <!--   Formulario De cuarta entidad-->
                <fieldset>
                    <h2>Paso 4: Modulo D</h2>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Estudios</label>
                                    <div>
                                        <select class="form-control" name="estudios" id="estudios" style="width: 100%;">
                                        <?php if($m_estudios=='BASICOS') {?>
                                         
                                            <option value=""></option>
                                            <option selected value="BASICOS">BASICOS</option>
                                            <option value="SECUNDARIOS">SECUNDARIOS</option>
                                            <option value="TECNICOS">TECNICOS</option>
                                            <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>

                                 <?php } else if($m_estudios=='SECUNDARIOS'){ ?>
                                     
                                    <option value=""></option>
                                            <option value="BASICOS">BASICOS</option>
                                            <option selected value="SECUNDARIOS">SECUNDARIOS</option>
                                            <option value="TECNICOS">TECNICOS</option>
                                            <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>

                                     <?php }else if($m_estudios=='TECNICOS'){?>
                                        <option value=""></option>
                                            <option value="BASICOS">BASICOS</option>
                                            <option value="SECUNDARIOS">SECUNDARIOS</option>
                                            <option selected value="TECNICOS">TECNICOS</option>
                                            <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>

                                         <?php } else if($m_estudios=='UNIVERSITARIOS'){?>
                                        <option value=""></option>
                                            <option value="BASICOS">BASICOS</option>
                                            <option value="SECUNDARIOS">SECUNDARIOS</option>
                                            <option value="TECNICOS">TECNICOS</option>
                                            <option selected value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                         <?php } else {?>   
                                     
                                            <option selected value=""></option>
                                            <option value="BASICOS">BASICOS</option>
                                            <option value="SECUNDARIOS">SECUNDARIOS</option>
                                            <option value="TECNICOS">TECNICOS</option>
                                            <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                         <?php } ?>   

                                        
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="mob">Años Ex Empleador</label>
                                    <input type="text" class="form-control" id="anos_exemple" name="anos_exemple" placeholder="">

                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Tipo Trabajador</label>
                                    <div>
                                        <select class="form-control" name="tipo_trabajador" id="tipo_trabajador" style="width: 100%;">
                                        <?php if($m_tipo_trabajador=='ACTIVO') {?>
                                         
                                            <option value=""></option>
                                            <option selected value="ACTIVO">ACTIVO</option>
                                            <option value="PENSIONADO Y COTIZA">PENSIONADO Y COTIZA</option>
                                            <option value="PENSIONADO Y NO COTI">PENSIONADO Y NO COTIZA</option>

                                    <?php } else if($m_tipo_trabajador=='PENSIONADO COTIZA'){ ?>
                                        
                                            <option value=""></option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option selected value="PENSIONADO Y COTIZA">PENSIONADO Y COTIZA</option>
                                            <option value="PENSIONADO Y NO COTI">PENSIONADO Y NO COTIZA</option>

                                        <?php }else if($m_tipo_trabajador=='PENSIONADO Y NO COTI'){?>
                                            <option value=""></option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="PENSIONADO Y COTIZA">PENSIONADO Y COTIZA</option>
                                            <option selected value="PENSIONADO Y NO COTI">PENSIONADO Y NO COTIZA</option>
                                            <?php } else {?>   
                                        
                                            <option selected value=""></option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="PENSIONADO Y COTIZA">PENSIONADO Y COTIZA</option>
                                            <option value="PENSIONADO Y NO COTI">PENSIONADO Y NO COTIZA</option>
                                            <?php } ?>   


                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Tope Gratificacion</label>
                                    <div>
                                        <select class="form-control" name="tope_gratificacion" id="tope_gratificacion" style="width: 100%;">
                                        <?php if($m_tope_gratif=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_tope_gratif=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Sueldo Diario</label>
                                    <div>
                                        <select class="form-control" name="sueldo_diario" id="sueldo_diario" style="width: 100%;">

                                        <?php if($m_sueldo_diario=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_sueldo_diario=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>  
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Tipo Jornada</label>
                                    <div>
                                        <select class="form-control" name="tipo_jornada" id="tipo_jornada" style="width: 100%;">
                                        <?php if($m_tipo_jornada=='L-V') {?>
                                            <option value=""></option>
                                            <option selected value="L-V">L-V</option>
                                            <option value="L-S">L-S</option>
                                    <?php } else if($m_tipo_jornada=='L-S'){ ?>
                                        <option value=""></option>
                                            <option value="L-V">L-V</option>
                                            <option selected value="L-S">L-S</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="L-V">L-V</option>
                                            <option value="L-S">L-S</option>
                                            <?php } ?>     
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Incluye Sabado</label>
                                    <div>
                                        <select class="form-control" name="incluye_sabado" id="incluye_sabado" style="width: 100%;">
                                        <?php if($m_sabado=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_sabado=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Aplica Tarja</label>
                                    <div>
                                        <select class="form-control" name="aplica_tarja" id="aplica_tarja" style="width: 100%;">
                                        <?php if($m_tarja=='SI') {?>
                                            <option value=""></option>
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                    <?php } else if($m_tarja=='NO'){ ?>
                                        <option value=""></option>
                                            <option  value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        <?php }else{?>
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_4" placeholder="Observacion" ><?= $m_observaciones4?></textarea>
                    </div>
                    <input type="button" name="previous" class="previous btn btn-default" value="Previo" />
                    <input type="submit" name="submit" class="submit btn btn-success" value="Enviar" id="submit_data" />
                </fieldset>
        </form>
    </div>
</body>

</html>

<script type="text/javascript">
    function bancoestado(banco) {
        var est = banco.value;
        var rut = document.getElementById('rut');
        var r = rut.value;
        console.log(est);
        console.log(r);
        var cuenta_rut = r.split("-");
        var ru = cuenta_rut[0];
        if (est == 'ESTADO') {
            console.log("funciona" + ru)
            document.getElementById('cta_banco').value = ru;
        } else {
            console.log("no funciona")
            document.getElementById('cta_banco').value = ' ';

        }


    }



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

    function calcularEdad(fecha_naci) {

        var cumpleanos = new Date(fecha_naci.value);

        var hoy = new Date();

        console.log(hoy);
        console.log(cumpleanos);


        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();
        console.log(hoy);
        console.log(cumpleanos);
        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        if (edad > 17) {
            console.log("mayor");
            cerrar();
            return (true);
        } else {
            console.log("menor");
            mostrar();
            return (false);
        }
    }

    function mostrar() {
        div = document.getElementById('alert_menor');
        div.style.display = '';
    }

    function cerrar() {
        div = document.getElementById('alert_menor');
        div.style.display = 'none';
    }

    window.onload = function() {
     
    };


    $('select').select2({
        theme: 'bootstrap4',
    });
</script>
<script>
    function bloqueoPrevision(previ) {
        var previ = previ.value;
        var select = document.getElementById('tipo_trabajador');
        console.log(previ)
        if (previ == 'JUBILADO') {
            console.log('se bloquea borra activo');

            $('#tipo_trabajador').empty();
            $('#tipo_trabajador').prepend("<option value='' ></option>");
            $('#tipo_trabajador').prepend("<option value='PENSIONADO Y COTIZA' >PENSIONADO Y COTIZA</option>");
            $('#tipo_trabajador').prepend("<option selected value='PENSIONADO Y NO COTI' >PENSIONADO Y NO COTIZA</option>");

        } else {
            console.log('se bloquea borra jubiliado');
            $('#tipo_trabajador').empty();
            $('#tipo_trabajador').prepend("<option value='ACTIVO' >ACTIVO</option>");
        }
    }

    function bloqueosalud(salud) {
        var isapre = salud.value;
        let salud1 = document.getElementById('plan_saludUF');
        var salud2 = document.getElementById('plan_salud%');
        var salud3 = document.getElementById('plan_salud$');


        if (isapre == 'FONASA') {

            console.log('se desactivan los salud');
            salud1.disabled = true;
            salud2.disabled = true;
            salud3.disabled = true;
            salud1.value = '';
            salud2.value = '';
            salud3.value = '';

        } else {

            console.log('se activan los salud');
            salud1.disabled = false;
            salud2.disabled = false;
            salud3.disabled = false;
        }







    };

    function recontratacion() {
        rut = document.getElementById('rut');

        $.ajax({
            type: "POST",
            url: "recontratacionqbiz.php",
            data: {

                rut: rut.value


            },

            success: function(results) {
                console.log("gane: " + results);

                var alerta = document.getElementById("alert_recontra");

                if (results == 1) {
                    alerta.style.display = ''
                    console.log("SI SE MUESTRA");
                } else {
                    alerta.style.display = 'none';
                    console.log("NO SE MUESTRA");
                }

                //console.log("hola xD " + el_body);
                //results = 1 es cuando ta repetido
                //results = 0 es cuando NO ta repetido
                //toastr.error("alerta error");

            },



        });
    }

    function validaCampos() {
        var sMax = parseFloat($("#sueldomax").val());
        var sMin = parseFloat($("#sueldomin").val());

        console.log('sueldo minimo= '+typeof sMin)
        console.log('sueldo maximo= '+typeof sMax)

        

        var nombre = $("#nombre").val();
        var apellidop = $("#apellidoP").val();
        var apellidom = $("#apellidoM").val();
        var asistencia = $("#asistencia").val();
        var tipo_contrato = $("#tipo_contrato").val();
        var cargo = $("#cargo").val();
        var transportista = $("#transportista").val();
        var transportista_nomb = $("#transportista_nombre").val();
        var fecha_naci = $("#fecha_naci").val();
        var sexo = $("#sexo").val();
        var nacionalidad = $("#nacionalidad").val();
        var fono = $("#fono").val();
        var correo = $("#correo").val();
        var civil = $("#estado_civil").val();
        var direccion = $("#direccion").val();
        var comuna = $("#comuna").val();
        var prevision = $("#prevision").val();
        var salud = $("#salud").val();
        var forma_pago = $("#forma_pago").val();
        var banco = $("#banco").val();
        var cta_banco = $("#cta_banco").val();
        var sueldo_base = parseFloat($("#sueldo_base").val());
        var asig_traba = $("#asig_prop_traba").val();
        var anticipo_variable = $("#anticipo_variable").val();
        var estudios = $("#estudios").val();
        var tipo_traba = $("#tipo_trabajador").val();
        var tope_grat = $("#tope_gratificacion").val();
        var sueldo_diario = $("#sueldo_diario").val();
        var incluye_sabad = $("#incluye_sabado").val();
        var jornada = $("#tipo_jornada").val();
        var aplica_tarja = $("#aplica_tarja").val();

        var mensaje = '';
        //validamos campos




        if ($.trim(nombre) == "" ||
            $.trim(apellidom) == "" ||
            $.trim(apellidop) == "" ||
            $.trim(asistencia) == "" ||
            $.trim(tipo_contrato) == "" ||
            $.trim(cargo) == "" ||
            $.trim(fecha_naci) == "" ||
            $.trim(sexo) == "" ||
            $.trim(nacionalidad) == "" ||
            $.trim(fono) == "" ||
            $.trim(correo) == "" ||
            $.trim(civil) == "" ||
            $.trim(direccion) == "" ||
            $.trim(comuna) == "" ||
            $.trim(prevision) == "" ||
            $.trim(salud) == "" ||
            $.trim(forma_pago) == "" ||
            $.trim(banco) == "" ||
            $.trim(cta_banco) == "" ||
            $.trim(sueldo_base) == "" ||
            $.trim(asig_traba) == "" ||
            $.trim(anticipo_variable) == "" ||
            $.trim(estudios) == "" ||
            $.trim(tipo_traba) == "" ||
            $.trim(tope_grat) == "" ||
            $.trim(sueldo_diario) == "" ||
            $.trim(incluye_sabad) == "" ||
            $.trim(jornada) == "" ||
            $.trim(aplica_tarja) == "") {
            if ($.trim(nombre) == "") {

                mensaje = mensaje + '-Nombre'

            }

            if ($.trim(apellidop) == "") {

                mensaje = mensaje + '-Apellido Paterno'
            }
            if ($.trim(apellidom) == "") {

                mensaje = mensaje + '-Apellido Materno'
            }
            if ($.trim(asistencia) == "") {
                mensaje = mensaje + '-Asistencia'

            }
            if ($.trim(tipo_contrato) == "") {
                mensaje = mensaje + '-Tipo de contrato'

            }
            if ($.trim(cargo) == "") {
                mensaje = mensaje + '-Cargo'

            }
            if ($.trim(fecha_naci) == "") {

                mensaje = mensaje + '-Fecha de Nacimiento'
            }
            if ($.trim(sexo) == "") {

                mensaje = mensaje + '-Sexo'
            }
            if ($.trim(nacionalidad) == "") {

                mensaje = mensaje + '-Nacionalidad'
            }
            if ($.trim(fono) == "") {

                mensaje = mensaje + '-Telefono'
            }
            if ($.trim(correo) == "") {

                mensaje = mensaje + '-Correo'
            }
            if ($.trim(civil) == "") {
                mensaje = mensaje + '-Civil'

            }
            if ($.trim(direccion) == "") {
                mensaje = mensaje + '-Direccion'

            }
            if ($.trim(comuna) == "") {
                mensaje = mensaje + '-Comuna'

            }
            if ($.trim(prevision) == "") {
                mensaje = mensaje + '-Prevision'

            }
            if ($.trim(salud) == "") {

                mensaje = mensaje + '-Salud'
            }
            if ($.trim(forma_pago) == "") {

                mensaje = mensaje + '-Forma de Pago'
            }
            if ($.trim(banco) == "") {
                mensaje = mensaje + '-Banco'

            }
            if ($.trim(cta_banco) == "") {

                mensaje = mensaje + '-Cta banco'
            }
            if ($.trim(sueldo_base) == "") {
                mensaje = mensaje + '-Sueldo Base'

            }
            if ($.trim(asig_traba) == "") {

                mensaje = mensaje + '-Asig. Prop. días Trabajados'
            }
            if ($.trim(anticipo_variable) == "") {

                mensaje = mensaje + '-Anticipo variable'
            }

            if ($.trim(estudios) == "") {
                mensaje = mensaje + '-Estudios'

            }
            if ($.trim(tipo_traba) == "") {

                mensaje = mensaje + '-Tipo Trabajador'
            }
            if ($.trim(tope_grat) == "") {

                mensaje = mensaje + '-Tope Gratificacion'
            }
            if ($.trim(sueldo_diario) == "") {
                mensaje = mensaje + '-Sueldo Diario'

            }
            if ($.trim(incluye_sabad) == "") {
                mensaje = mensaje + '-Incluye Sabado'

            }
            if ($.trim(jornada) == "") {

                mensaje = mensaje + '-Tipo Jornada'
            }
            if ($.trim(aplica_tarja) == "") {

                mensaje = mensaje + '-Incluye Tarja'
            }
            cadena = mensaje.slice(1);
            console.log(mensaje);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Datos Faltantes',
                text: cadena,
            })
            return false
        } 


        if (sMax < sueldo_base) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Sueldo mayor al permitido',
            })
            console.log('entro a sueldo maximo')

            return false

        }else if (sueldo_base < sMin) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Sueldo menor al permitido',
            })
            console.log('Sueldo menor al minimo')

            return false

        }


    }
</script>

<script>

function portramos(){

var tramo = document.getElementById('tramo').value;
var sueldo= document.getElementById('sueldo_base')
var movili= document.getElementById('asig_movilizacion')
console.log(tramo)

$.post("llenadosueldo.php",{
        
      
        tramo:tramo
    },function(result){

        var tra=JSON.parse(result);

        
        var s=tra.sueldo;
        var m=tra.movilizacion;

      console.log(s);
      console.log(m);
sueldo.value=s;
movili.value=m;
      })

}

</script>