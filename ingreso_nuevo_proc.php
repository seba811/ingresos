<?php
session_start();
include('conexion.php');

$hoy = date("Y-m-d");
$usuario_nom=$_SESSION['usuario_nombre'];

// Traigo la empresa
$empresa=$_POST['empresa'];
//MODULO 1
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_termino = $_POST['fecha_termino'];

if(isset($_POST['turno'])){
$turno = $_POST['turno'];}else{
$turno=" ";

}
$asistencia = $_POST['asistencia'];
$tipo_contrato = $_POST['tipo_contrato'];
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
$observaciones1 = trim($_POST['observaciones_1']);
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
$ciudad = $_POST['ciudad'];
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
$observaciones2 = $_POST['observaciones_2'];
$observaciones2 = strtoupper($observaciones2);

//modulo 3
$prevision = $_POST['prevision'];
$salud = $_POST['salud'];
$saludUF = $_POST['plan_saludUF'];
$salud_porc = $_POST['plan_salud%'];
$salud_peso = $_POST['plan_salud$'];
$centro_costo = $_POST['centro_costos'];
$forma_pago = $_POST['forma_pago'];
$banco = $_POST['banco'];
$cta_banco = $_POST['cta_banco'];
$sueldo_base = $_POST['sueldo_base'];
$horas_semana = $_POST['horas_semana'];
$asig_colacion = $_POST['asig_colacion'];
$asig_movilizacion = $_POST['asig_movilizacion'];
$asig_propia = $_POST['asig_prop_traba'];
$anticipo = $_POST['anticipo_variable'];
$monto_anticipo = $_POST['monto_anticipo'];
$observacion3 = $_POST['observaciones_3'];
$observacion3 = strtoupper($observacion3);

// modulo 4
$estudios = $_POST['estudios'];
$anos_ex = $_POST['anos_exemple'];
$tipo_trabajador = $_POST['tipo_trabajador'];
$tope_gratificacion = $_POST['tope_gratificacion'];
$sueldo_diario = $_POST['sueldo_diario'];
$tipo_jornada = $_POST['tipo_jornada'];
$incluye_sabado = $_POST['incluye_sabado'];
$aplica_tarja = $_POST['aplica_tarja'];
$observaciones4 = $_POST['observaciones_4'];
$observaciones4 = strtoupper($observaciones4);

// se ejecuta la consulta para guardar en la base
$sql =	"	INSERT INTO	ingresos
				(
                    ingresos_empresa,
                    ingresos_fecha,
					ingresos_fecha_ing, 
                    ingresos_fecha_term,
                    ingresos_turno,
                    ingresos_r_asistencia, 
                    ingresos_tipo_contrato, 
                    ingresos_cargo, 
                    ingresos_transportista, 
                    ingresos_transportista_nombre, 
                    ingresos_faena,
                    ingresos_faena_cod,
                    ingresos_area, 
                    ingresos_exemple, 
                    ingresos_c_temporadas, 
                    ingresos_observacion1,

                    ingresos_nombre, 
                    ingresos_apellidop, 
                    ingresos_apellidom,
                    ingresos_rut, 
                    ingresos_nacionalidad, 
                    ingresos_sexo, 
                    ingresos_fecha_naci, 
                    ingresos_fono, 
                    ingresos_direccion, 
                    ingresos_comuna, 
                    ingresos_ciudad,
					ingresos_estado_civil,
					ingresos_mail,
                    ingresos_emergencia_nombre,
                    ingresos_emergencia_parentesco,
                    ingresos_emergencia_fono, 
                    ingresos_enfermedad, 
                    ingresos_enfermedad_detalle,
                    ingresos_observacion2,

                    ingresos_prevision,
                    ingresos_salud, 
                    ingresos_plan_saluduf, 
                    ingresos_plan_saludporc, 
                    ingresos_plan_saludpeso, 
                    ingresos_centro_costo, 
                    ingresos_sueldo_base,
                    ingresos_horas_semana,
                    ingresos_forma_pago, 
                    ingresos_banco,
                    ingresos_cta_banco, 

                    ingresos_asig_colacion, 
                    ingresos_asig_movil, 
                    ingresos_prop_traba, 
                    ingresos_anticipo_var, 
                    ingresos_anticipo_monto, 
                    ingresos_observacion3, 
                    
                    ingresos_estudios, 
                    ingresos_ano_exemple, 
                    ingresos_tipo_trabajador, 
                    ingresos_tope_gratif, 
                    ingresos_sueldo_diario, 
                    ingresos_tipo_jornada, 
                    ingresos_sabado, 
                    ingresos_tarja, 
                    ingresos_observaciones4,
                    ingresos_usuario
				)
				VALUES 
				(
					'$empresa',
                    '$hoy',
                    '$fecha_ingreso',
                    '$fecha_termino',
                    '$turno' ,
                    '$asistencia' ,
                    '$tipo_contrato' ,
                    '$cargo' ,
                    '$transportista' ,
                    '$trasnportista_nombre' ,
                    '$faena1' ,
                    '$faena2',
                    '$area' ,
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
                    '$ciudad' ,
                    '$estado_civil' ,
                    '$correo' ,  
                    '$nombre_emergencia', 
					'$parentesco_emergencia' , 
                    '$fono_emergencia', 
                    '$enfermedad'  , 
                    '$enfermedad_detalle',
                    '$observaciones2' ,

                    '$prevision' ,
                    '$salud' ,
                    '$saludUF' ,
                    '$salud_porc' ,
                    '$salud_peso' ,
                    '$centro_costo',
					'$sueldo_base' ,   
					'$horas_semana',
					'$forma_pago', 
                    '$banco',
                    '$cta_banco' ,  
 
 
                    '$asig_colacion',
                    '$asig_movilizacion' , 
                    '$asig_propia',   
                    '$anticipo' ,
                    '$monto_anticipo',
                    '$observacion3',

                    '$estudios' ,
                    '$anos_ex' ,
                    '$tipo_trabajador', 
                    '$tope_gratificacion',
                    '$sueldo_diario',
                    '$tipo_jornada',
                    '$incluye_sabado',
                    '$aplica_tarja',
                    '$observaciones4',
                    '$usuario_nom' 
				)
			";

$rs	 =	mysqli_query($conexion, $sql);


if ($rs) {

    $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_rut='$rut'");
    $n = $rs_preingresos->num_rows;

   

    if($n!=0){

        $row=$rs_preingresos->fetch_array(MYSQLI_ASSOC);

        $id=$row['preingresos_id'];
        

        $sql_estado=	"	UPDATE preingresos
        SET     
                       
                         preingresos_estado='3'
     
     
        WHERE preingresos_id = '$id' ";
     


     $rs	 =	mysqli_query($conexion,$sql_estado);

    }



header("Location: ingresos.php?x=add_exi");
} else {
header("Location: ingresos.php?x=add_err");
}

?>
