<?php

session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:../index.php");
    exit;
}


$rut = $_GET['rut'];

$empresa = $_GET['empresa'];
include('conexion.php');






include('conexion_qbiz.php');

// Se consultan si es que existe los datos del trabajador de base de datos de qbiz con el rut
$sql2 = "SELECT  TOP 1    e.CodLegal as Rut

,e.RazonSocial  as NombreCompleto

,e.FormaPago    as FormaPago

,e.Banco        as Banco

,e.CuentaBanco  as CtaBanco

,e.Clasif1      as Prevision

,e.Clasif2      as Salud

,e.Clasif12     as Estudios

,e.Clasif11     as Nacionalidad

,e.Clasif7      as TipoTrabPrev

,e.Clasif17     as Recontrata

,e.Sexo         as Sexo

,e.FechaNacimiento as FechaNacimiento

,e.EstadoCivil  as EstadoCivil

,e.Direccion    as Direccion

,e.Ciudad       as Ciudad

,ci.Descripcion as CiudadDesc

,e.Comuna       as Comuna

,co.Descripcion as ComunaDesc

,e.Fono         as Telefono

,e.Email        as Mail    

from		Entidad e 
left join	(select ev.Empresa, ev.Entidad, ev.Monto, max(ev.FechaDesde)Fecha  From EntidadVal ev WITH(NOLOCK) where ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='anticipo.variablesi' group by ev.Empresa,ev.Entidad,ev.Monto) a ON a.Empresa=e.Empresa and e.Entidad=a.Entidad
left join	Codigo c WITH(NOLOCK)		on	e.Empresa=c.Empresa 	and	c.TipoCodigo='(RH.Cargo)'		and	e.cargo=c.codigo
left join	Codigo cc WITH(NOLOCK)		on	e.Empresa=cc.Empresa	and	cc.TipoCodigo='(CentroCosto)'	and	e.CentroCosto=cc.codigo
left join 	Codigo ca WITH(NOLOCK) 		on	cc.Empresa=ca.Empresa 	and ca.TipoCodigo='(CentroCosto_N2)' and ca.Codigo=cc.Clasif2
left join 	Codigo ci WITH(NOLOCK)		on 	ci.Empresa=e.Empresa 	and ci.TipoCodigo='(Ciudad)' 		and ci.Codigo=e.Ciudad
left join 	Codigo co WITH(NOLOCK)		on 	co.Empresa=e.Empresa 	and co.TipoCodigo='(Comuna)' 		and co.Codigo=e.Comuna
left join 	SeccionInfo si WITH(NOLOCK) on	si.Empresa=e.Empresa 	and si.Tabla='ENTIDAD'	and si.SubTabla='FUNCIONARIO' and si.Seccion='TRATO' and si.Id=e.Entidad
left join 	Codigo fa WITH(NOLOCK)		on 	fa.Empresa=si.Empresa 	and fa.TipoCodigo='FAENAS' 		and fa.Codigo=si.Clasif6
left join	Codigo ct WITH(NOLOCK) on ct.Empresa=e.Empresa and ct.TipoCodigo='RH.TURNOS' and ct.Codigo=e.Clasif8
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='ANTICIPO ESTANDAR' and ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='anticipos' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='ANTICIPO ESTANDAR' And v.Nombre='anticipos' And v.Entidad=ev.Entidad)) af ON af.Empresa=e.Empresa and e.Entidad=af.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.COLACIONVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.COLACIONVALOR' And v.Entidad=ev.Entidad)) colm ON colm.Empresa=e.Empresa and e.Entidad=colm.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.COLACIONDIARIAV' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.COLACIONDIARIAV' And v.Entidad=ev.Entidad)) cold ON cold.Empresa=e.Empresa and e.Entidad=cold.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.MOVILIZVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.MOVILIZVALOR' And v.Entidad=ev.Entidad) ) movm ON movm.Empresa=e.Empresa and e.Entidad=movm.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='ASIG.MOVILIZDIARIAV' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='ASIG.MOVILIZDIARIAV' And v.Entidad=ev.Entidad)) movd ON movd.Empresa=e.Empresa and e.Entidad=movd.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='VIATICO.MONTO' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='VIATICO.MONTO' And v.Entidad=ev.Entidad)) viatico ON viatico.Empresa=e.Empresa and e.Entidad=viatico.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='BONO.DESEMPVALOR' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='BONO.DESEMPVALOR' And v.Entidad=ev.Entidad)) bonofijo ON bonofijo.Empresa=e.Empresa and e.Entidad=bonofijo.Entidad
left join	(select ev.Empresa, ev.Entidad, ev.Monto From EntidadVal ev WITH(NOLOCK) where	 ev.TipoDocumento='SUELDO ESTANDAR' and	ev.TipoEntidad='FUNCIONARIO' and ev.Nombre='SALUD.UFPACTADO' and ev.FechaDesde = (Select max(v.FechaDesde) from EntidadVal v Where  v.TipoDocumento='SUELDO ESTANDAR' And v.Nombre='SALUD.UFPACTADO' And v.Entidad=ev.Entidad)) saluduf ON saluduf.Empresa=e.Empresa and e.Entidad=saluduf.Entidad
where		 e.TipoEntidad='funcionario'
AND ('«Vigente»' <> 'S' OR e.Vigencia = 'S')
and e.Entidad <> '(APROBACION)'
and LEN(e.Entidad)<9
and LEFT(e.Entidad,3) <> 'SFT' and e.CodLegal=?
ORDER BY e.Entidad DESC";


$consulta2 = $base_de_datos->prepare($sql2);
$consulta2->execute([$rut]);
$rs2 = $consulta2->fetchObject();
// Si la consulta es exitosa se rellenan las varibables con los datos encontrados
//sino se dejan vacios
if ($rs2 != NULL) {
    $nombre_qbiz = $rs2->NombreCompleto;
    $nombre = explode(",", $nombre_qbiz);
    //solo nombre y un apellido
    if (count($nombre) == 2) {
        $qbiz_nombre = $nombre[1];
        $qbiz_apellidop = $nombre[0];
        $qbiz_apellidom = ' ';
    } //solo nombre y dos apellidos
    else if (count($nombre) == 3) {
        $qbiz_nombre = $nombre[2];
        $qbiz_apellidop = $nombre[0];
        $qbiz_apellidom = $nombre[1];
    }

    $formaPago_qbiz = $rs2->FormaPago;
    $banco_qbiz = $rs2->Banco;
    $cta_banco_qbiz = $rs2->CtaBanco;
    $prevision_qbiz = $rs2->Prevision;
    $salud_qbiz = $rs2->Salud;
    $estudios_qbiz = $rs2->Estudios;
    $nacionalidad_qbiz = $rs2->Nacionalidad;
    $sexo_qbiz = $rs2->Sexo;
    $nacimiento_qbizfecha = $rs2->FechaNacimiento;
    $nacimiento_q = explode(' ', $nacimiento_qbizfecha);
    $edad_qbiz = $nacimiento_q[0];
    $estado_civil_qbiz = $rs2->EstadoCivil;
    $direccion_qbiz = $rs2->Direccion;
    $ciudad_qbiz = $rs2->Ciudad;
    $comuna_qbiz = $rs2->Comuna;
    $telefono_qbiz = $rs2->Telefono;
    $correo_qbiz = $rs2->Mail;
} else {

    $qbiz_nombre = ' ';
    $qbiz_apellidop = ' ';
    $qbiz_apellidom = ' ';
    $formaPago_qbiz = '';
    $banco_qbiz = '';
    $cta_banco_qbiz = '';
    $prevision_qbiz = '';
    $salud_qbiz = '';
    $estudios_qbiz = '';
    $nacionalidad_qbiz = '';
    $sexo_qbiz = '';
    $nacimiento_qbizfecha = '';
    $nacimiento_q = '';
    $edad_qbiz = '';
    $estado_civil_qbiz = '';
    $direccion_qbiz = '';
    $ciudad_qbiz = '';
    $comuna_qbiz = '';
    $telefono_qbiz = '';
    $correo_qbiz = '';
}



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
            $("#reclutamiento_tipo").change(function() {

                $('#reclutamiento_nombre').find('option').remove().end().append('<option value="whatever">lo deja vacio</option>').val('whatever');

                $("#reclutamiento_tipo option:selected").each(function() {
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



<?php
    $hoy = date("dd-mm-yyyy");
  
    $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_rut='$rut'");
    $n = $rs_preingresos->num_rows;
   
    if($n!=0){
   
   $row=$rs_preingresos->fetch_array(MYSQLI_ASSOC);
   
   $usu=$row['preingresos_usuario'];
   
    }else {

        $usu='';
    }
   


    ?>
  <div class="input-group">

    <input type="number" class="form-control" style="width:30% " id="usupre" name="usupre" hidden value="<?= $usu ?>">
</div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="../assets/img/logo.png" width="60" class="brand_logo" alt="Logo">
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

        <form id="regiration_form" action="preingresos_nuevo_proc.php" method="post" onsubmit="return validaCampos();">
            <!--Alerta de menor de edad -->
            <div id=alert_menor class="alert alert-danger  alert-dismissible" role="alert" style="display:none">Trabajador Menor de Edad</div>
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
                        <div class="input-group">
                            <input type="rut" class="form-control" style="width:30% " id="empresa" name="empresa" readonly value="<?= $empresa ?>">

                        </div>
                    </div>
                    <div class="col">
                    <label style="color: red;">*</label><label for="turno">Tipo de Reclutamiento</label>
                        <div>
                            <select class="form-control" name="reclutamiento_tipo" id="reclutamiento_tipo">
                                <option selected value=" "></option>
                                <option value="0">CONTRATISTA</option>
                                <option value="1">ENGANCHE</option>
                                <option value="2">PLANTA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                   <label for="nombre_reclu">Nombre Tipo Reclutamiento</label>
                        <div>
                            <select class="form-control" name="reclutamiento_nombre" id="reclutamiento_nombre">
                                <option selected value="">Selecciones antes tipo reclutamiento</option>
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
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $qbiz_nombre ?>">

                        </div>

                        <div class="col">
                            <label style="color: red;">*</label><label>Apellido Paterno</label>
                            <input type="text" class="form-control " id="apellidoP" name="apellidoP" value="<?= $qbiz_apellidop ?>">

                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label>Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?= $qbiz_apellidom ?>">
                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label for="rut">Fecha de Nacimiento</label>
                            <!-- <span style="border-image: initial; border: 1px solid red;">Menor de edad</span>
                            -->
                            <input type="date" class="form-control" id="fecha_naci" name="fecha_naci" onchange="calcularEdad()" value="<?= $edad_qbiz ?>">

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
                                    if ($row['codigos_nombre'] == $nacionalidad_qbiz) {
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
                                    <?php if ($sexo_qbiz == 'M') { ?>
                                        <option selected value="MASCULINO">Masculino</option>
                                        <option value="FEMENINO">Femenino</option>
                                    <?php } else if ($sexo_qbiz == 'F') { ?>
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
                            <input type="text" class="form-control" id="fono" name="fono" value="<?= $telefono_qbiz ?>">
                        </div>
                        <div class="col">
                            <label style="color: red;">*</label><label>Mail</label>
                            <input type="text" class="form-control" id="correo" name="correo" value="<?= $correo_qbiz ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="rut">Estudios</label>
                            <div>
                                <select class="form-control" name="estudios" id="estudios" style="width: 100%;">
                                    <?php if ($estudios_qbiz == 'BASICOS') { ?>
                                        <option value=""></option>
                                        <option selected value="BASICOS">BASICOS</option>
                                        <option value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios_qbiz == 'SECUNDARIOS') { ?>
                                        <option value=""></option>
                                        <option value="BASICOS">BASICOS</option>
                                        <option selected value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios_qbiz == 'TECNICOS') { ?>
                                        <option value=""></option>
                                        <option value="BASICOS">BASICOS</option>
                                        <option value="SECUNDARIOS">SECUNDARIOS</option>
                                        <option selected value="TECNICOS">TECNICOS</option>
                                        <option value="UNIVERSITARIOS">UNIVERSITARIOS</option>
                                    <?php } else 
                                        if ($estudios_qbiz == 'UNIVERSITARIOS') { ?>
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
                                    <?php if ($estado_civil_qbiz == 'SOLTERO(A)') { ?>
                                        <option value=""></option>
                                        <option selected value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil_qbiz == 'CASADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option selected value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil_qbiz == 'VIUDO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option selected value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php } else 
                                        if ($estado_civil_qbiz == 'SEPARADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option selected value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                    <?php }
                                    if ($estado_civil_qbiz == 'DIVERCIADO(A)') { ?>
                                        <option value=""></option>
                                        <option value="SOLTERO(A)">SOLTERO(A)</option>
                                        <option value="CASADO(A)">CASADO(A)</option>
                                        <option value="VIUDO(A)">VIUDO(A)</option>
                                        <option value="SEPARADO(A)">SEPARADO(A)</option>
                                        <option value selected="DIVORCIADO(A)">DIVORCIADO(A)</option>
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

                            <label style="color: red;">*</label><label for="address">Direccion</label>
                            <input class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $direccion_qbiz ?>">
                        </div>
                        <div class="col">
                            <?php $rs_comuna = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "comuna" '); ?>


                            <label style="color: red;">*</label><label for="comuna">Comuna</label>
                            <select class="form-control" name="comuna" id="comuna" style="width: 100%;">
                                <option value=""></option>
                                <?php
                                while ($row = $rs_comuna->fetch_array(MYSQLI_ASSOC)) {
                                    if ($row['codigos_nombre'] == $comuna_qbiz) {
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
                                        if ($row['codigos_nombre'] == $banco_qbiz) {
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
                            <input type="number" class="form-control" id="cta_banco" name="cta_banco" value="<?= $cta_banco_qbiz ?>">

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
                                        if ($row['codigos_nombre'] == $prevision_qbiz) {
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
                                        if ($row['codigos_nombre'] == $salud_qbiz) {
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
                            <input type="text" class="form-control" id="nombre_emerg" name="nombre_emergencia">
                        </div>
                        <div class="col">
                            <label for="rut">Parentesco Emergencia</label>
                            <input type="text" class="form-control" id="parentesco_emerg" name="parentesco_emergencia">
                        </div>
                        <div class="col">
                            <label for="rut">Fono Emergencia</label>
                            <input type="text" class="form-control" id="fono_emergencia" name="fono_emergencia">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="rut">Enfermedad Crónica</label>
                            <div>
                                <select class="form-control" name="enfermedad" id="enfermedad" style="width: 100%;">

                                    <option selected value=""></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label for="rut">Indicar Cual enfermedad Cronica</label>
                            <input type="text" class="form-control" id="detalle_enfermedad" name="detalle_enfermedad">
                        </div>
                        <div class="col">
                            <label for="rut">Discapacidad Certificada</label>
                            <div>
                                <select class="form-control" name="discapacidad" id="discapacidad" style="width: 100%;">

                                    <option selected value=""></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col">
<div class='row'>
<div class='col'>
               <label>¿Como se entero de la oferta laboral?</label>
               <div>
                   <select class="form-control" name="comoinforma" id="comoinforma">
                   
                           <option value=" "></option>
                           <option value="LLAMADO TELEFONICO">LLAMADO TELEFONICO</option>
                           <option value="REDES SOCIALES">REDES SOCIALES</option>
                           <option value="FERIA LABORAL">FERIA LABORALO</option>
                           <option value="AVISO RADIAL">AVISO RADIAL</option>
                           <option value="AVISO PUBLICITARIO">AVISO PUBLICITARIO</option>
                           <option value="DATO DE AMIGO O FAMILIAR">DATO DE AMIGO O FAMILIAR</option>

                   
                   </select>
               </div>
               </div>
               </div>

</div>


                </div>

                <div class="form-group">
                    <label for="address">Observaciones</label>
                    <textarea class="form-control" name="observaciones" placeholder="Observaciones"></textarea>
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
                            <input type="date" class="form-control" id="fecha_actual" name="fecha_ingreso" value="">
                        </div>
                        <div class="col">
                        <label>Tipo Contrato</label>
                                    <div>
                                        <select class="form-control" name="tipo_contrato" id="tipo_contrato">
                                            <?php
                                            if ($_SESSION['usuario_tipo'] == 1) {
                                            ?>
                                                <option value=" "></option>
                                                <option value="POR OBRA" selected>POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>
                                            <?php } else { ?>

                                                <option selected value=""></option>
                                                <option value="POR OBRA">POR OBRA</option>
                                                <option value="PLAZO FIJO">PLAZO FIJO</option>
                                                <option value="INDEFINIDO">INDEFINIDO</option>

                                            <?php  }  ?>
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
                                    <option value='' selected></option>
                                    <?php
                                    while ($row = $rs_faena->fetch_array(MYSQLI_ASSOC)) {

                                        echo '<option value="' . $row['codigos_id'] . '">' . $row['codigos_nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col">
                        <label style="color: blue;">*</label><label for="rut">Cargo</label>
                            <div>
                                <select class="form-control" name="cargo" id="cargo">
                                    <option selected value=""></option>
                                    <?php
                                    while ($row = $rs_cargo->fetch_array(MYSQLI_ASSOC)) {

                                        echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <label> Transportista</label>
                            <div>
                                <select class="form-control" name="transportista" id="transportista">
                                    <option value=" "></option>
                                    <option value="SI">Si</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>



                        </div>
                        <div class="col">
                            <label>Nombre Trasportista</label>
                            <input type="text" class="form-control" id="transportista_nombre" name="transportista_nombre" placeholder="Nombre Trasportista">

                        </div>
                    </div>

                    <div class="row">


                        <?php

                        $rs_area = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "area" ');


                        ?>
                        <div class="col">
                        <label style="color: blue;">*</label><label for="area">Area</label>
                            <div>
                                <select class="form-control" name="area" id="area">
                                    <option value=" " selected></option>
                                    <?php
                                    while ($row = $rs_area->fetch_array(MYSQLI_ASSOC)) {

                                        echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                        <label style="color: blue;">*</label><label for="rut">Ex Empleado</label>
                            <div>
                                <select class="form-control" name="ex_emple" id="ex_emple">
                                    <option value=" " selected></option>
                                    <option value="SI">Si</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Cuantas Temporadas</label>
                                <input type="number" class="form-control" id="cuantas_temp" name="cuantas_temp" placeholder="">
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

    window.onload = function() {
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth() + 1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if (dia < 10)
            dia = '0' + dia; //agrega cero si el menor de 10
        if (mes < 10)
            mes = '0' + mes //agrega cero si el menor de 10
        document.getElementById('fecha_actual').value = ano + "-" + mes + "-" + dia;

        // funciones que se deben ejecutar cuando el trabajador ya estaba antes y hay que verificar datos
        bloqueoPrevision();
        bloqueosalud();

    };


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
<script>


window.onload = function() {


        yaenpreingreso()

    };


function yaenpreingreso(){
    var usua = $("#usupre").val();
    console.log('entro a yaenpreingreso')
if(usua!=''){

    console.log('entro a la alerta yaenpreingreso')
    Swal.fire({
                        title: 'Trabajador Ya Ingresado',
                        text: 'Por:'+usua,
                        icon: 'error',
                        confirmButtonText: 'Confirmar'
                    }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  window.location.href = "preingresos.php";
})
                }

}



</script>