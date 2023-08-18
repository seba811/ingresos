<?php

session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:index.php");
    exit;
}
include('conexion.php');

$id = $_GET['id'];



$rs_ingresos = $conexion->query("SELECT * FROM preingresos where preingresos_id= '$id'");
# echo("SELECT * FROM ingresos where ingresos_id= '$id_ingresos'");
$row = $rs_ingresos->fetch_array(MYSQLI_ASSOC);

$rut = $row['preingresos_rut'];
$empresa = $row['preingresos_empresa'];
$reclutamiento_tipo = $row['preingresos_tipo_reclutador'];
$reclutamiento_nombre = $row['preingresos_reclutador_nombre'];
$nombre = $row['preingresos_nombre'];
$apellidop = $row['preingresos_apellidop'];
$apellidom = $row['preingresos_apellidom'];
$nacimiento = $row['preingresos_fecha_naci'];
$nacionalidad = $row['preingresos_nacionalidad'];
$sexo = $row['preingresos_sexo'];
$telefono = $row['preingresos_fono'];
$correo = $row['preingresos_correo'];
$estudios = $row['preingresos_estudios'];
$estado_civil = $row['preingresos_estado_civil'];
$direccion = $row['preingresos_direccion'];
$comuna = $row['preingresos_comuna'];
$banco = $row['preingresos_banco'];
$cta_banco = $row['preingresos_cta_banco'];
$prevision = $row['preingresos_prevision'];
$salud = $row['preingresos_salud'];
$emergencia_nombre = $row['preingresos_emergencia_nombre'];
$emergencia_parentesco = $row['preingresos_emergencia_parentesco'];
$emergencia_fono = $row['preingresos_emergencia_fono'];
$enfermedad = $row['preingresos_enfermedad'];
$enfermedad_detalle = $row['preingresos_enfermedad_detalle'];
$discapacidad = $row['preingresos_discapacidad'];
$observaciones = $row['preingresos_observaciones'];


$fecha_ingreso = $row['preingresos_fecha_ingreso'];
$tipo_contrato = $row['preingresos_tipo_contrato'];
$comoinforma = $row['preingresos_comoinforma'];
$faena = $row['preingresos_faena'];
$cargo = $row['preingresos_cargo'];
$transportista = $row['preingresos_transportista'];
$transportista_nombre = $row['preingresos_transportista_nombre'];
$area = $row['preingresos_area'];
$ex_emple = $row['preingresos_ex_emple'];
$temporadas = $row['preingresos_c_temporadas'];




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

    <!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="sweetalert2.all.min.js"></script> -->
    <script language="javascript">
        $(document).ready(function() {
            $("#reclutamiento").change(function() {

                $('#reclutamiento_nombre').find('option').remove().end().append('<option value="whatever">lo deja vacio</option>').val('whatever');

                $("#reclutamiento option:selected").each(function() {
                    id_estado = $(this).val();
                    console.log(id_estado)
                    $.ajax({
                        type: "POST",
                        url: "prueba2.php",
                        data: {

                            id_estado: id_estado


                        },

                        success: function(results) {
                            console.log("gane: " + results);

                            $("#reclutamiento_nombre").html(results);
                        },
                    });
                })
            })
        });
    </script>

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>

    <meta charset="UTF-8">

    <title>Formulario para llenar ficha Preingreso</title>
</head>

<body>
   

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="preingresos.php">PreIngresos <span class="sr-only">(current)</span></a>
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
        <h1>Preingreso</h1>

        <form id="regiration_form" action="preingresos_modificar_proc.php" method="post" onsubmit="return validaCampos();">
            <!--Alerta de menor de edad -->
            <div id=alert_menor class="alert alert-danger  alert-dismissible" role="alert" style="display:none">Trabajador Menor de Edad</div>
            <input type="number" class="form-control" style="width:30% " id="id" name="id" hidden value="<?= $id ?>">
            <?php

            ?>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="rut">Rut</label>
                        <div class="input-group">
                            <input type="rut" class="form-control" style="width:30% " id="rut" name="rut" readonly onkeyup="formato_rut(this)" value="<?= $rut ?>">

                        </div>
                    </div>
                    <div class="col">
                        <label for="rut">Empresa</label>
                        <div>
                            <select class="form-control" name="empresa" id="empresa">
                             <?php if($empresa=='Agrocomercial Natura S.A'){?>   
                                <option value=" "></option>
                                <option selected value="Agrocomercial Natura S.A">Agrocomercial Natura S.A</option>
                                <option value="Prize ProService S.A">Prize ProService S.A</option>
                                <option value="Exportadora Prize S.A">Exportadora Prize S.A</option>
                                 <option value="ComercialPrize SPA">ComercialPrize SPA</option>
                                <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                <?php }else if($empresa=='Prize ProService S.A'){ ?>
                                    <option value=" "></option>
                                <option value="Agrocomercial Natura S.A">Agrocomercial Natura S.A</option>
                                <option selected value="Prize ProService S.A">Prize ProService S.A</option>
                                <option value="Exportadora Prize S.A">Exportadora Prize S.A</option>
                                <option value="ComercialPrize SPA">ComercialPrize SPA</option>
                                <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                <?php }else if($empresa=='Exportadora Prize S.A'){ ?>
                                    <option value=" "></option>
                                <option value="Agrocomercial Natura S.A">Agrocomercial Natura S.A</option>
                                <option value="Prize ProService S.A">Prize ProService S.A</option>
                                <option selected value="Exportadora Prize S.A">Exportadora Prize S.A</option>
                                <option value="ComercialPrize SPA">ComercialPrize SPA</option>
                                <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                <?php }else if($empresa=='Contratista Requinoa'){ ?>
                                    <option value=" "></option>
                                <option value="Agrocomercial Natura S.A">Agrocomercial Natura S.A</option>
                                <option value="Prize ProService S.A">Prize ProService S.A</option>
                                <option value="Exportadora Prize S.A">Exportadora Prize S.A</option>
                                <option value="ComercialPrize SPA">ComercialPrize SPA</option>
                                <option selected value='Contratista Requinoa'>Contratista Requinoa</option>
                                <?php } else if($empresa=='ComercialPrize SPA'){ ?>
                                    <option value=" "></option>
                                <option value="Agrocomercial Natura S.A">Agrocomercial Natura S.A</option>
                                <option value="Prize ProService S.A">Prize ProService S.A</option>
                                <option value="Exportadora Prize S.A">Exportadora Prize S.A</option>
                                <option selected value="ComercialPrize SPA">ComercialPrize SPA</option>
                                <option value='Contratista Requinoa'>Contratista Requinoa</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label style="color: red;">*</label><label for="turno">Tipo de Reclutamiento</label>
                        <div>
                            <select class="form-control" name="reclutamiento" id="reclutamiento">
                             '<?php if($reclutamiento_tipo==0){?>   
                            
                                <option value=" "></option>
                                <option selected value="0">CONTRATISTA</option>
                                <option value="1">ENGANCHE</option>
                                <option value="2">PLANTA</option>
                                <?php }else if($reclutamiento_tipo==1){ ?>
                                    <option value=" "></option>
                                <option value="0">CONTRATISTA</option>
                                <option selected value="1">ENGANCHE</option>
                                <option value="2">PLANTA</option>
                                <?php }else if($reclutamiento_tipo==2){ ?>
                                    <option value=" "></option>
                                <option value="0">CONTRATISTA</option>
                                <option value="1">ENGANCHE</option>
                                <option selected value="2">PLANTA</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label for="nombre_reclu">Nombre Tipo Reclutamiento</label>
                        <div>
                            <select class="form-control" name="reclutamiento_nombre" id="reclutamiento_nombre">
                                <option selected value=" <?= $reclutamiento_nombre ?>"><?= $reclutamiento_nombre ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!--   Formulario De segundo entidad-->


            <h2>Datos Personales</h2>
            <div class="col-md-12">

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label style="color: red;">*</label><label>Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre ?>">

                        </div>

                        <div class="col">
                            <label style="color: red;">*</label><label>Apellido Paterno</label>
                            <input type="text" class="form-control " id="apellidoP" name="apellidoP" value="<?= $apellidop ?>">

                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label>Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?= $apellidom ?>">
                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label for="rut">Fecha de Nacimiento</label>
                            <!-- <span style="border-image: initial; border: 1px solid red;">Menor de edad</span>
                            -->
                            <input type="date" class="form-control" id="fecha_naci" name="fecha_naci" onchange="calcularEdad()" value="<?= $nacimiento ?>">

                        </div>
                    </div>

                    <div class="row">
                        <?php


                        $rs_nacionalidad = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "nacionalidad" ');


                        ?>
                        <div class="col">
                            <label style="color: red;">*</label><label>Nacionalidad</label>

                            <select class="form-control" name="nacionalidad" id="nacionalidad" style="width: 100%;">
                                <option value=" "></option>
                                <?php
                                while ($row = $rs_nacionalidad->fetch_array(MYSQLI_ASSOC)) {
                                    if ($row['codigos_nombre'] == $nacionalidad) {
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
                                    <?php if ($sexo == 'MASCULINO') { ?>
                                        <option selected value="MASCULINO">Masculino</option>
                                        <option value="FEMENINO">Femenino</option>
                                    <?php } else if ($sexo == 'FEMENINO') { ?>
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
                            <input type="text" class="form-control" id="fono" name="fono" value="<?= $telefono ?>">
                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label>Mail</label>
                            <input type="text" class="form-control" id="correo" name="correo" value="<?= $correo ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="rut">Estudios</label>
                            <div>
                                <select class="form-control" name="estudios" id="estudios" style="width: 100%;">
                                    <?php if ($estudios == 'BASICOS') { ?>
                                        <option value=""></option>
                                        <option selected value="BASICOS">BASICOS</option>
                                        <option value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios == 'SECUNDARIOS') { ?>
                                        <option value=""></option>
                                        <option value="BASICOS">BASICOS</option>
                                        <option selected value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios == 'TECNICOS') { ?>
                                        <option value=""></option>
                                        <option value="BASICOS">BASICOS</option>
                                        <option value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option selected value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios == 'UNIVERSITARIOS') { ?>
                                        <option value=""></option>
                                        <option value="BASICOS">BASICOS</option>
                                        <option value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option value="TECNICOS">TECNICOS</option>
                                        <option selected value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else { ?>
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

                            <label>Estado Civil</label>
                            <div>
                                <select class="form-control" name="estado_civil" id="estado_civil" style="width: 100%;">
                                    <?php if ($estado_civil == 'SOLTERO(A)') { ?>
                                        <option value=""></option>
                                        <option selected value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil == 'CASADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option selected value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil == 'VIUDO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option selected value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil == 'SEPARADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option selected value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else
                                    if ($estado_civil == 'DIVORCIADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value selected="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else { ?>
                                        <option selected value=""></option>
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

                            <label style="color: red;">*</label><label for="address">Direccion</label>
                            <input class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $direccion ?>">
                        </div>
                        <div class="col">
                            <?php $rs_comuna = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "comuna" '); ?>


                            <label style="color: red;">*</label><label for="comuna">Comuna</label>
                            <select class="form-control" name="comuna" id="comuna" style="width: 100%;">
                                <option value=""></option>
                                <?php
                                while ($row = $rs_comuna->fetch_array(MYSQLI_ASSOC)) {
                                    if ($row['codigos_nombre'] == $comuna) {
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
                            <label for="rut">Banco</label>
                            <div>

                                <?php


                                $rs_banco = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "banco" ');


                                ?>
                                <select class="form-control" name="banco" id="banco" style="width: 100%;" onchange="bancoestado(this)">
                                    <option value=""></option>
                                    <?php
                                    while ($row = $rs_banco->fetch_array(MYSQLI_ASSOC)) {
                                        if ($row['codigos_nombre'] == $banco) {
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
                            <label for="rut">Cta Banco</label>
                            <input type="number" class="form-control" id="cta_banco" name="cta_banco" value="<?= $cta_banco ?>">

                        </div>

                        <div class="col">
                            <label for="rut">Prevision</label>
                            <div>
                                <?php


                                $rs_prevision = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "prevision" ');


                                ?>

                                <select class="form-control" name="prevision" id="prevision" style="width: 100%;" onchange="bloqueoPrevision()">
                                    <option value=""></option>
                                    <?php
                                    while ($row = $rs_prevision->fetch_array(MYSQLI_ASSOC)) {
                                        if ($row['codigos_nombre'] == $prevision) {
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
                            <label for="rut">Salud</label>
                            <div>

                                <?php


                                $rs_salud = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "ISAPRE" ');


                                ?>
                                <select class="form-control" name="salud" id="salud" onchange="bloqueosalud()" style="width: 100%;">
                                    <option value=""></option>
                                    <?php
                                    while ($row = $rs_salud->fetch_array(MYSQLI_ASSOC)) {
                                        if ($row['codigos_nombre'] == $salud) {
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
                            <label for="rut">Contacto Emergencia</label>
                            <input type="text" class="form-control" id="nombre_emerg" name="nombre_emergencia" value="<?= $emergencia_nombre ?>">
                        </div>
                        <div class="col">
                            <label for="rut">Parentesco Emergencia</label>
                            <input type="text" class="form-control" id="parentesco_emerg" name="parentesco_emergencia" value="<?= $emergencia_parentesco ?>">
                        </div>
                        <div class="col">
                            <label for="rut">Fono Emergencia</label>
                            <input type="text" class="form-control" id="fono_emergencia" name="fono_emergencia" value="<?= $emergencia_fono ?>">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="rut">Enfermedad Crónica</label>
                            <div>
                                <select class="form-control" name="enfermedad" id="enfermedad" style="width: 100%;">

                                    <?php if ($enfermedad == 'SI') { ?>
                                        <option value=""></option>
                                        <option selected value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } else if ($enfermedad == 'NO') { ?>
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option selected value="NO">NO</option>
                                    <?php } else { ?>
                                        <option selected value=""></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label for="rut">Indicar Cual enfermedad Cronica</label>
                            <input type="text" class="form-control" id="detalle_enfermedad" name="detalle_enfermedad" value="<?= $enfermedad_detalle ?>">
                        </div>
                        <div class="col">
                            <label for="rut">Discapacidad Certificada</label>
                            <div>
                                <select class="form-control" name="discapacidad" id="discapacidad" style="width: 100%;">
                                    <?php if ($discapacidad == 'SI') { ?>
                                        <option value=""></option>
                                        <option selected value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } else if ($discapacidad == 'NO') { ?>
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option selected value="NO">NO</option>
                                    <?php } else { ?>
                                        <option selected value=""></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <label>¿Como se enteró de la oferta laboral?</label>
                                    <div>
                                        <select class="form-control" name="comoinforma" id="comoinforma">
                                        <?php if($comoinforma=='LLAMADO TELEFONICO') {?>
                                            <option value="" ></option>
                                            <option selected value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                    <?php } else if($comoinforma=='REDES SOCIALES'){ ?>
                                        <option value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option selected value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                        <?php }else if($comoinforma=='FERIA LABORAL'){ ?>
                                            <option value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option selected value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                        <?php }else if($comoinforma=='AVISO RADIAL'){ ?>
                                            <option value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option selected value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                        <?php }else if($comoinforma=='AVISO PUBLICITARIO'){ ?>
                                            <option value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option selected value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                        <?php }elseif($comoinforma=='DATO DE AMIGO O FAMILIAR'){ ?>
                                            <option value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option selected value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                        <?php }else{?>
                                            <option selected value="" ></option>
                                                <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                                                <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                <option value="FERIA LABORAL">FERIA LABORAL</option>
                                                <option value="AVISO RADIAL">AVISO RADIAL</option>
                                                <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                                                <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>
                                            <?php } ?>
                                           
                                        

                                        </select>
                                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Observaciones</label>
                    <textarea class="form-control" name="observaciones" placeholder="Observaciones"><?= $observaciones ?></textarea>
                </div>

            </div>



            <!--   Formulario De Ingreso-->
            <h2>Datos Ingreso</h2>
            <div class="col-md-12">
                <div class="form-group">
                    <?php

                    $rs_faena = $conexion->query('SELECT codigos_nombre, codigos_descripcion,codigos_id FROM codigos where codigos_tipo like "faenas" ');
                    //Llamamos el select las faenas de la base

                    ?>

                    <div class="row">
                        <div class="col">
                            <!-- input de fecha de ingreso -->
                            <label for="rut">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_actual" name="fecha_ingreso" value="<?= $fecha_ingreso ?>">
                        </div>
                        <div class="col">
                        <label style="color: red;">*</label><label>Tipo Contrato</label>
                                    <div>
                                        <select class="form-control" name="tipo_contrato" id="tipo_contrato">
                                        <?php if($tipo_contrato=='POR OBRA') {?>
                                            <option selected value="POR OBRA">POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                    <?php } else if($tipo_contrato=='PLAZO FIJO'){ ?>
                                                <option value="POR OBRA" >POR OBRA</option>
                                                <option selected value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                        <?php }else if($tipo_contrato=='INDEFINIDO'){ ?>
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
                        </div>
                        <?php

                        $rs_cargo = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "cargo" ');


                        ?>

                        <div class="col">
                            <label for="rut">Faena</label>
                            <div>
                                <select class="form-control" name="faena" id="faena">
                                    <option value=" " disabled selected></option>
                                    <?php
                                    while ($row = $rs_faena->fetch_array(MYSQLI_ASSOC)) {

                                        if ($row['codigos_nombre'] == $faena) {
                                            echo '<option selected value="' . $row['codigos_id'] . '">' . $row['codigos_nombre'] . '</option>';
                                        } else {
                                            echo '<option value="' . $row['codigos_id'] . '">' . $row['codigos_nombre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col">
                            <label for="rut">Cargo</label>
                            <div>
                                <select class="form-control" name="cargo" id="cargo">
                                    <option value="" disabled selected></option>
                                    <?php
                                    while ($row = $rs_cargo->fetch_array(MYSQLI_ASSOC)) {
                                        if ($row['codigos_nombre'] == $cargo) {
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
                            <label> Transportista</label>
                            <div>
                                <select class="form-control" name="transportista" id="transportista">
                                    <?php if ($transportista == 'SI') { ?>
                                        <option value=""></option>
                                        <option selected value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } else if ($transportista == 'NO') { ?>
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option selected value="NO">NO</option>
                                    <?php } else { ?>
                                        <option selected value=""></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } ?>
                                </select>
                            </div>



                        </div>
                        <div class="col">
                            <label>Nombre Trasportista</label>
                            <input type="text" class="form-control" id="transportista_nombre" name="transportista_nombre" placeholder="Nombre Trasportista" value="<?= $transportista_nombre ?>">

                        </div>
                    </div>

                    <div class="row">


                        <?php

                        $rs_area = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "area" ');


                        ?>
                        <div class="col">
                            <label for="area">Area</label>
                            <div>
                                <select class="form-control" name="area" id="area">
                                <option value=" " disabled selected></option>
                                            <?php
                                            while ($row = $rs_area->fetch_array(MYSQLI_ASSOC)) {

                                                if ($row['codigos_nombre'] == $area) {
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
                                    <?php if ($ex_emple == 'SI') { ?>
                                        <option value=""></option>
                                        <option selected value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    <?php } else if ($ex_emple == 'NO') { ?>
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option selected value="NO">NO</option>
                                    <?php } else { ?>
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
                                <input type="number" class="form-control" id="cuantas_temp" name="cuantas_temp" value=<?= $temporadas ?>>
                            </div>
                        </div>


                    </div>
                </div>


            </div>



            <input type="submit" name="submit" class="submit btn btn-success" value="Enviar" id="submit_data" />

        </form>
    </div>

    <script>


    </script>
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

    function calcularEdad() {

        var cumpleanos = $("#fecha_naci").val();
        var cumpleanos = new Date(cumpleanos);

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



    $('select').select2({
        theme: 'bootstrap4',
    });
</script>
<script>
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

        var mensaje = '';
        //validamos campos




        if ($.trim(nombre) == "" ||
            $.trim(apellidom) == "" ||
            $.trim(apellidop) == "" ||
            $.trim(fecha_naci) == "" ||
            $.trim(sexo) == "" ||
            $.trim(nacionalidad) == "" ||
            $.trim(fono) == "" ||
            $.trim(correo) == "" ||
            $.trim(direccion) == "" ||
            $.trim(comuna) == "") {
            if ($.trim(nombre) == "") {

                mensaje = mensaje + '-Nombre'

            }

            if ($.trim(apellidop) == "") {

                mensaje = mensaje + '-Apellido Paterno'
            }
            if ($.trim(apellidom) == "") {

                mensaje = mensaje + '-Apellido Materno'
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

            if ($.trim(direccion) == "") {
                mensaje = mensaje + '-Direccion'

            }
            if ($.trim(comuna) == "") {
                mensaje = mensaje + '-Comuna'

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




    }
</script>