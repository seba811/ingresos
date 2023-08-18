<?php
session_start();
include('conexion.php');

$hoy = date("Y-m-d");
$usuario_nom=$_SESSION['usuario_nombre'];
$usuario_id=$_SESSION['usuario_id'];


$reclutamiento_tipo=$_POST['reclutamiento_tipo'];
$reclutamiento_nombre=$_POST['reclutamiento_nombre'];
// Traigo la empresa
$empresa=$_POST['empresa'];
$comoinforma= $_POST['comoinforma'];
//MODULO 1
$fecha_ingreso = $_POST['fecha_ingreso'];
$cargo = $_POST['cargo'];
$transportista = $_POST['transportista'];
$trasnportista_nombre = $_POST['transportista_nombre'];

if(isset($_POST['faena'])){
$faena = $_POST['faena'];

$rs_faena = $conexion->query("SELECT * FROM codigos where codigos_id= '$faena'");
# echo("SELECT * FROM ingresos where ingresos_id= '$id_ingresos'");
 $row = $rs_faena->fetch_array(MYSQLI_ASSOC);

$faena1=$row['codigos_nombre'];
$faena2=$row['codigos_descripcion'];

}else{
    $faena1=" ";
    $faena2='';
}
$area = $_POST['area'];
$ex_emple = $_POST['ex_emple'];
$temporadas = $_POST['cuantas_temp'];
$observaciones1 = $_POST['observaciones'];
$observaciones1 = strtoupper($observaciones1);

// MODULO 2
$nombre = $_POST['nombre'];
$nombre = strtoupper($nombre);
$apellidop = $_POST['apellidoP'];
$apellidop = strtoupper($apellidop);
$apellidom = $_POST['apellidoM'];
$apellidom = strtoupper($apellidom);
$rut = $_POST['rut'];
$sexo = $_POST['sexo'];
$nacionalidad = $_POST['nacionalidad'];
$fecha_naci = $_POST['fecha_naci'];
$direccion = $_POST['direccion'];
$direccion = strtoupper($direccion);
$comuna = $_POST['comuna'];
$fono = $_POST['fono'];
$estado_civil = $_POST['estado_civil'];
$correo = $_POST['correo'];
$correo = strtoupper($correo);
$nombre_emergencia = $_POST['nombre_emergencia'];
$nombre_emergencia = strtoupper($nombre_emergencia);
$fono_emergencia = $_POST['fono_emergencia'];
$parentesco_emergencia = $_POST['parentesco_emergencia'];
$parentesco_emergencia = strtoupper($parentesco_emergencia);
$enfermedad = $_POST['enfermedad'];
$enfermedad = strtoupper($enfermedad);
$enfermedad_detalle = $_POST['detalle_enfermedad'];
$enfermedad_detalle = strtoupper($enfermedad_detalle);
$discapacidad=$_POST['discapacidad'];

//modulo 3
$estudios = $_POST['estudios'];
$prevision = $_POST['prevision'];
$salud = $_POST['salud'];

$banco = $_POST['banco'];
if(isset($_POST['cta_banco'])){
    $cta_banco = $_POST['cta_banco'];
}else{
    $cta_banco=0;

}
$tipo_contrato= $_POST['tipo_contrato'];



if(empty($banco) || empty($estudios) || empty($salud) || 
   empty($prevision) || empty($discapacidad)||empty($fecha_ingreso)|| empty($cargo) || 
   empty($faena)||  empty($transportista)||empty($ex_emple) || empty($estado_civil)){
$estado=1;

}else{

$estado=0;
};
// se ejecuta la consulta para guardar en la base
$sql =	"	INSERT INTO	preingresos
				(
                    preingresos_empresa,
                    preingresos_fecha_registro,
					preingresos_fecha_ingreso,
                    preingresos_tipo_reclutador,
                    preingresos_reclutador_nombre, 

          
                    preingresos_cargo, 
                    preingresos_transportista, 
                    preingresos_transportista_nombre, 

                    preingresos_faena,
                    preingresos_faena_cod,
                    preingresos_area, 
                    preingresos_ex_emple, 
                    preingresos_c_temporadas, 
                    preingresos_observaciones,

                    preingresos_nombre, 
                    preingresos_apellidop, 
                    preingresos_apellidom,
                    preingresos_rut, 
                    preingresos_nacionalidad, 
                    preingresos_sexo, 
                    preingresos_fecha_naci, 
                    preingresos_fono, 
                    preingresos_direccion, 
                    preingresos_comuna, 
                    preingresos_estado_civil,
					preingresos_correo,
                    preingresos_emergencia_nombre,
                    preingresos_emergencia_parentesco,
                    preingresos_emergencia_fono, 
                    preingresos_enfermedad, 
                    preingresos_enfermedad_detalle,
                    preingresos_discapacidad,
                    preingresos_tipo_contrato,
                    preingresos_comoinforma,
        

                    preingresos_prevision,
                    preingresos_salud, 
                    preingresos_banco,
                    preingresos_cta_banco, 
                    
                    preingresos_estudios, 
                    preingresos_usuario,
                    preingresos_usuario_id,
                    preingresos_estado
				)
				VALUES 
				(
					'$empresa',
                    '$hoy',
                    '$fecha_ingreso',
                    '$reclutamiento_tipo',
                    '$reclutamiento_nombre',

                   
                    '$cargo' ,
                    '$transportista' ,
                    '$trasnportista_nombre',

                    '$faena1',
                    '$faena2',
                    '$area',
                    '$ex_emple' ,
                    '$temporadas',
                    '$observaciones1' ,

                    '$nombre', 
                    '$apellidop' ,
                    '$apellidom' ,
                    '$rut' ,
					'$nacionalidad' ,
					'$sexo',
                    '$fecha_naci', 
					'$fono',
				    '$direccion', 
                    '$comuna' ,
                    '$estado_civil' ,
                    '$correo' ,  
                    '$nombre_emergencia', 
					'$parentesco_emergencia' , 
                    '$fono_emergencia', 
                    '$enfermedad'  , 
                    '$enfermedad_detalle',
                    '$discapacidad',
                    '$tipo_contrato',
                    '$comoinforma',

                    '$prevision' ,
                    '$salud' ,

                    '$banco',
                    '$cta_banco' ,  

                    '$estudios' ,
                    '$usuario_nom',
                    '$usuario_id',
                    '$estado' 
				)
			";




$rs	 =	mysqli_query($conexion, $sql);
if ($rs) {
	header("Location: preingresos.php?x=add_exi");
} else {
	header("Location: preingresos.php?x=add_err");
}

?>
