<?php

session_start();

if (!$_SESSION['usuario_id'] && !$_SESSION['usuario_usuario']) {

    header("location:index.php");
    exit;
}

include('conexion.php');
require('dao.php');
$a = new Dao();



$rut = $_POST['rut'];

$empresa = $_POST['empresa'];


//$rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_rut='$rut'");
$rs_preingresos = $a->ObtenerDatosPersonas($rut);
$n = $rs_preingresos->num_rows;


if ($n != 0) {

    $row = $rs_preingresos->fetch_array(MYSQLI_ASSOC);

    $qbiz_nombre = $row['preingresos_nombre'];
    $qbiz_apellidop = $row['preingresos_apellidop'];
    $qbiz_apellidom = $row['preingresos_apellidom'];
    $banco_qbiz = $row['preingresos_banco'];
    $cta_banco_qbiz = $row['preingresos_cta_banco'];
    $prevision_qbiz = $row['preingresos_prevision'];
    $salud_qbiz = $row['preingresos_salud'];
    $estudios_qbiz = $row['preingresos_estudios'];
    $nacionalidad_qbiz = $row['preingresos_nacionalidad'];
    $sexo_qbiz = $row['preingresos_sexo'];

    if ($sexo_qbiz == 'MASCULINO') {
        $sexo_qbiz = 'M';
    } else if ($sexo_qbiz == 'FEMENINO') {
        $sexo_qbiz = 'F';
    }

    $edad_qbiz = $row['preingresos_fecha_naci'];
    $estado_civil_qbiz = $row['preingresos_estado_civil'];
    $direccion_qbiz = $row['preingresos_direccion'];

    $comuna_qbiz = $row['preingresos_comuna'];
    $telefono_qbiz = $row['preingresos_fono'];
    $correo_qbiz = $row['preingresos_correo'];

    $pre_faena = $row['preingresos_faena'];
    $pre_faena_cod = $row['preingresos_faena_cod'];

    $pre_area = $row['preingresos_area'];
    $pre_cargo = $row['preingresos_cargo'];
    $pre_turno = $row['preingresos_turno'];

    $pre_exemple =  $row['preingresos_ex_emple'];
    $pre_temporadas =  $row['preingresos_c_temporadas'];

    $pre_emergencia_nombre = $row['preingresos_emergencia_nombre'];
    $pre_emergencia_parentesco = $row['preingresos_emergencia_parentesco'];
    $pre_emergencia_fono = $row['preingresos_emergencia_fono'];

    $pre_enfermedad = $row['preingresos_enfermedad'];
    $pre_enfermedad_detalle = $row['preingresos_enfermedad_detalle'];

    $pre_transportista =    $row['preingresos_transportista'];
    $pre_transportista_nombre =    $row['preingresos_transportista_nombre'];




    //EXTRAS
    $ciudad_qbiz = '';
} else {

    include('conexion_qbiz.php');


    // Se consultan si es que existe los datos del trabajador de base de datos de qbiz con el rut
    $sql2 = "SELECT  TOP 1    e.CodLegal as Rut

,e.RazonSocial as NombreCompleto

,e.TipoContrato as TipoContrato

,case when isnull(e.CentroCosto,'')='' then 'SIN CECO' else e.CentroCosto end   as CentroCosto

,isnull(cc.Descripcion,'SIN CECO')  as CecoDesc

,e.Cargo        as Cargo

,c.Descripcion  as CargoDesc

,e.Area         as Area

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
    //sino se dejan
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
        } /*else if (count($nombre) == 4) { 

            $qbiz_nombre=$nombre[2]." ".$nombre[3];
            $qbiz_apellidop = $nombre[0];
            $qbiz_apellidom = $nombre[1];
        }else{

            $qbiz_nombre=$nombre[2]." ".$nombre[3]." ".$nombre[4];
            $qbiz_apellidop = $nombre[0];
            $qbiz_apellidom = $nombre[1];

        }
*/
        $cargo_qbiz = $rs2->Cargo;
        $area_qbiz = $rs2->Area;
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

        $pre_emergencia_nombre = '';
        $pre_emergencia_parentesco = '';
        $pre_emergencia_fono = '';
        $pre_area = '';
        $pre_cargo = '';
        $pre_turno = '';

        $pre_transportista = '';
        $pre_transportista_nombre = '';

        $pre_exemple = '';
        $pre_temporadas =  '';

        $pre_enfermedad = '';
        $pre_enfermedad_detalle = '';
    } else {

        $qbiz_nombre = ' ';
        $qbiz_apellidop = ' ';
        $qbiz_apellidom = ' ';
        $cargo_qbiz = ' ';
        $area_qbiz = ' ';
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
        $pre_emergencia_nombre = '';
        $pre_emergencia_parentesco = '';
        $pre_emergencia_fono = '';

        $pre_area = '';
        $pre_cargo = '';
        $pre_turno = '';

        $pre_transportista = '';
        $pre_transportista_nombre = '';

        $pre_exemple =  '';
        $pre_temporadas =  '';

        $pre_enfermedad = '';
        $pre_enfermedad_detalle = '';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="sweetalert2.all.min.js"></script> -->

    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>

    <meta charset="UTF-8">

    <title>Formulario para llenar ficha contratacion</title>
</head>

<body>
    <?php
    $hoy = date("dd-mm-yyyy");
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
        <h1>Registro de nuevo trabajador paso a paso</h1>

        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <form id="regiration_form" action="ingreso_nuevo_proc.php" method="post" onsubmit="return validaCampos();">
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
                </div>

                <fieldset>


                    <!--   Formulario De Primera entidad-->
                    <h2>Paso 1: Entidad A</h2>
                    <div class="col-md-12">
                        <div class="form-group">


                            <div class="row">
                                <div class="col">
                                    <!-- input de fecha de ingreso -->
                                    <label style="color: red;">*</label><label for="rut">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="fecha_actual" name="fecha_ingreso" value="">
                                </div>
                                <div class="col">
                                    <label for="rut">Fecha de Termino</label>
                                    <input type="date" class="form-control" id="fecha_termino" name="fecha_termino">
                                </div>
                                <div class="col">
                                    <label for="rut">Turno</label>
                                    <div>
                                        <select class="form-control" name="turno" id="turno">
                                            <?php if ($pre_turno == 'DIA') { ?>
                                                <option value=""></option>
                                                <option selected value="DIA">DIA</option>
                                                <option value="NOCHE">NOCHE</option>
                                            <?php } else if ($pre_turno == 'NOCHE') { ?>
                                                <option value=""></option>
                                                <option value="DIA">DIA</option>
                                                <option selected value="NOCHE">NOCHE</option>
                                            <?php } else { ?>
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
                                                if ($row['codigos_nombre'] == $pre_cargo) {
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
                                            <?php if ($pre_transportista == 'SI') { ?>
                                                <option value=""></option>
                                                <option selected value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            <?php } else if ($pre_transportista == 'NO') { ?>
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
                                    <input type="text" class="form-control" id="transportista_nombre" name="transportista_nombre" placeholder="Nombre Trasportista" value="<?= $pre_transportista_nombre ?>">

                                </div>
                            </div>

                            <?php

                            $rs_faena = $conexion->query('SELECT codigos_nombre, codigos_descripcion,codigos_id FROM codigos where codigos_tipo like "faenas" ');
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

                                                if ($row['codigos_nombre'] == $pre_faena) {
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

                                                if ($row['codigos_nombre'] == $pre_area) {
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
                                            <?php if ($pre_exemple == 'SI') { ?>
                                                <option value=""></option>
                                                <option selected value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            <?php } else if ($pre_exemple == 'NO') { ?>
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
                                        <input type="number" class="form-control" id="cuantas_temp" name="cuantas_temp" placeholder="" value="<?= $pre_temporadas ?>">
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_1" placeholder="Observaciones"></textarea>
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
                                    <label style="color: red;">*</label><label>Estado Civil</label>
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
                                            <?php } else
                                            if ($estado_civil_qbiz == 'DIVORCIADO(A)') { ?>
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
                                <div class="col">

                                    <?php $rs_ciudad = $conexion->query('SELECT codigos_nombre FROM codigos where codigos_tipo like "CIUDAD" '); ?>


                                    <label for="ciudad">Ciudad</label>
                                    <select class="form-control" name="ciudad" id="ciudad" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        while ($row = $rs_ciudad->fetch_array(MYSQLI_ASSOC)) {
                                            if ($row['codigos_nombre'] == $ciudad_qbiz) {
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
                                    <input type="text" class="form-control" id="nombre_emerg" name="nombre_emergencia" value="<?= $pre_emergencia_nombre ?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Parentesco Emergencia</label>
                                    <input type="text" class="form-control" id="parentesco_emerg" name="parentesco_emergencia" value="<?= $pre_emergencia_parentesco ?>">
                                </div>
                                <div class="col">
                                    <label for="rut">Fono Emergencia</label>
                                    <input type="text" class="form-control" id="fono_emergencia" name="fono_emergencia" value="<?= $pre_emergencia_fono ?>">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Enfermedad Crónica</label>
                                    <div>
                                        <select class="form-control" name="enfermedad" id="enfermedad" style="width: 100%;">

                                            <?php if ($pre_enfermedad == 'SI') { ?>
                                                <option value=""></option>
                                                <option selected value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            <?php } else if ($pre_enfermedad == 'NO') { ?>
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
                                    <input type="text" class="form-control" id="detalle_enfermedad" name="detalle_enfermedad" value="<?= $pre_enfermedad_detalle ?>">
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_2" placeholder="Observaciones"></textarea>
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
                                    <label style="color: red;">*</label><label for="rut">Salud</label>
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
                                    <label for="rut">Plan Salud(UF))</label>
                                    <input type="text" class="form-control" id="plan_saludUF" name="plan_saludUF" onchange="bloqueoisapre1()">
                                </div>
                                <div class="col">
                                    <label for="rut">Plan Salud(%)</label>
                                    <input type="text" class="form-control" id="plan_salud%" name="plan_salud%" onchange="bloqueoisapre2()">
                                </div>
                                <div class="col">
                                    <label for="rut">Plan Salud($)</label>
                                    <input type="text" class="form-control" id="plan_salud$" name="plan_salud$" onchange="bloqueoisapre3()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Centro de Costo</label>
                                    <div>

                                        <?php


                                        $rs_centro_costo = $conexion->query("SELECT codigos_nombre FROM codigos where codigos_tipo like 'centro costo' and codigos_empresa ='$empresa' ");


                                        ?>

                                        <select class="form-control" name="centro_costos" id="centro_costos" style="width: 100%;">
                                            <option value=" "></option>
                                            <?php
                                            while ($row = $rs_centro_costo->fetch_array(MYSQLI_ASSOC)) {

                                                echo '<option value="' . $row['codigos_nombre'] . '">' . $row['codigos_nombre'] . '</option>';
                                            }
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
                                    <input type="number" class="form-control" id="sueldo_base" maxlength="8" name="sueldo_base">
                                </div>
                                <div class="col">
                                    <label for="rut">Horas Semana</label>
                                    <input type="text" class="form-control" id="horas_semana" name="horas_semana" value="45">
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
                                    <label style="color: red;">*</label><label for="rut">Cta Banco</label>
                                    <input type="number" class="form-control" id="cta_banco" name="cta_banco" value="<?= $cta_banco_qbiz ?>">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Asig. Colacion</label>
                                    <input type="number" class="form-control" id="asig_colacion" name="asig_colacion">
                                </div>
                                <div class="col">
                                    <label for="rut">Asig. Movilizacion</label>
                                    <input type="number" class="form-control" id="asig_movilizacion" name="asig_movilizacion">

                                </div>
                                <div class="col">
                                    <label for="rut">Asig. Prop. Días Trab</label>
                                    <div>
                                        <select class="form-control" name="asig_prop_traba" id="asig_prop_traba" style="width: 100%;">
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Anticipo Variable</label>
                                    <div>
                                        <select class="form-control" name="anticipo_variable" id="anticipo_variable" style="width: 100%;">
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="rut">Monto Anticipo Fijo</label>
                                    <div>
                                        <select class="form-control" name="monto_anticipo" id="monto_anticipo" style="width: 100%;">
                                            <option selected value=""></option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
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
                        <textarea class="form-control" name="observaciones_3" placeholder="Observaciones"></textarea>
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
                                    <label for="mob">Años Ex Empleador</label>
                                    <input type="text" class="form-control" id="anos_exemple" name="anos_exemple" placeholder="">

                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Tipo Trabajador</label>
                                    <div>
                                        <select class="form-control" name="tipo_trabajador" id="tipo_trabajador" style="width: 100%;">
                                            <option value=""></option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="PENSIONADO Y COTIZA">PENSIONADO Y COTIZA</option>
                                            <option value="PENSIONADO Y NO COTI">PENSIONADO Y NO COTIZA</option>



                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Tope Gratificacion</label>
                                    <div>
                                        <select class="form-control" name="tope_gratificacion" id="tope_gratificacion" style="width: 100%;">
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="color: red;">*</label><label for="rut">Sueldo Diario</label>
                                    <div>
                                        <select class="form-control" name="sueldo_diario" id="sueldo_diario" style="width: 100%;">

                                            <option value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Tipo Jornada</label>
                                    <div>
                                        <select class="form-control" name="tipo_jornada" id="tipo_jornada" style="width: 100%;">
                                            <option selected value=""></option>
                                            <option value="L-V">L-V</option>
                                            <option value="L-S">L-S</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Incluye Sabado</label>
                                    <div>
                                        <select class="form-control" name="incluye_sabado" id="incluye_sabado" style="width: 100%;">
                                            <option value="SI">SI</option>
                                            <option selected value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">

                                    <label style="color: red;">*</label><label for="rut">Aplica Tarja</label>
                                    <div>
                                        <select class="form-control" name="aplica_tarja" id="aplica_tarja" style="width: 100%;">
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Observaciones</label>
                        <textarea class="form-control" name="observaciones_4" placeholder="Observacion"></textarea>
                    </div>
                    <input type="button" name="previous" class="previous btn btn-default" value="Previo" />
                    <input type="submit" name="submit" class="submit btn btn-success" value="Enviar" id="submit_data" />
                </fieldset>
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
    function bloqueoPrevision() {
        var previ = $("#prevision").val();
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

    function bloqueosalud() {
        var isapre = $("#salud").val();
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

    function bloqueoisapre1() {
        console.log('entra a bloqueo isapre');
        let salud1 = document.getElementById('plan_saludUF');
        var salud2 = document.getElementById('plan_salud%');
        var salud3 = document.getElementById('plan_salud$');

        var saluduf = salud1.value
        var saludporc = salud2.value
        var saludpeso = salud3.value

        if (saluduf.length != 0) {
            console.log('se bloquea 2 y 3');
            salud2.disabled = true;
            salud3.disabled = true;
            salud2.value = '';
            salud3.value = '';
        } else {
            console.log(' se desbloquea 2 y 3');
            salud2.disabled = false;
            salud3.disabled = false;


        }

    }

    function bloqueoisapre2() {
        console.log('entra a bloqueo isapre');
        let salud1 = document.getElementById('plan_saludUF');
        var salud2 = document.getElementById('plan_salud%');
        var salud3 = document.getElementById('plan_salud$');

        var saluduf = salud1.value
        var saludporc = salud2.value
        var saludpeso = salud3.value

        if (saludporc.length != 0) {
            console.log('se bloquea 1 y 3');
            salud1.disabled = true;
            salud3.disabled = true;
            salud1.value = '';
            salud3.value = '';
        } else {
            console.log(' se desbloquea 1 y 3');
            salud1.disabled = false;
            salud3.disabled = false;


        }

    }

    function bloqueoisapre3() {
        console.log('entra a bloqueo isapre');
        let salud1 = document.getElementById('plan_saludUF');
        var salud2 = document.getElementById('plan_salud%');
        var salud3 = document.getElementById('plan_salud$');

        var saluduf = salud1.value
        var saludporc = salud2.value
        var saludpeso = salud3.value

        if (saludpeso.length != 0) {
            console.log('se bloquea 2 y 3');
            salud2.disabled = true;
            salud1.disabled = true;
            salud2.value = '';
            salud1.value = '';
        } else {
            console.log(' se desbloquea 2 y 3');
            salud2.disabled = false;
            salud1.disabled = false;


        }

    }




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

        console.log('sueldo minimo= ' + typeof sMin)
        console.log('sueldo maximo= ' + typeof sMax)



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
        var sueldo_base2 = $("#sueldo_base").val();
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

        } else if (sueldo_base < sMin) {

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