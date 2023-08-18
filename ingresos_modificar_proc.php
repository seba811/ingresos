<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "index.php";
        </script>';
}

   include ('conexion.php');

   $id = $_POST["id"];
   if($id == ""){
      header("Location: ingresos.php?x=modi_err");
   }
  
 $usuario=$_SESSION['usuario_nombre'];  
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
$observaciones1 = $_POST['observaciones_1'];
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

 
$sql =	"	UPDATE ingresos
   SET
                    
                  
					ingresos_fecha_ing = '$fecha_ingreso', 
                    ingresos_fecha_term = '$fecha_termino',
                    ingresos_turno = '$turno',
                    ingresos_r_asistencia = '$asistencia', 
                    ingresos_tipo_contrato ='$tipo_contrato', 
                    ingresos_cargo ='$cargo', 
                    ingresos_transportista  ='$transportista',
                    ingresos_transportista_nombre='$trasnportista_nombre', 
                    ingresos_faena ='$faena1',
                    ingresos_faena_cod ='$faena2',
                    ingresos_area ='$area', 
                    ingresos_exemple ='$ex_emple', 
                    ingresos_c_temporadas ='$temporadas', 
                    ingresos_observacion1 ='$observaciones1',

                    ingresos_nombre ='$nombre', 
                    ingresos_apellidop ='$apellidop', 
                    ingresos_apellidom ='$apellidom',
                    ingresos_rut ='$rut', 
                    ingresos_nacionalidad ='$nacionalidad', 
                    ingresos_sexo ='$sexo', 
                    ingresos_fecha_naci ='$fecha_naci', 
                    ingresos_fono ='$fono', 
                    ingresos_direccion ='$direccion', 
                    ingresos_comuna ='$comuna', 
                    ingresos_ciudad ='$ciudad',
					ingresos_estado_civil ='$estado_civil',
					ingresos_mail ='$correo',
                    ingresos_emergencia_nombre ='$nombre_emergencia',
                    ingresos_emergencia_parentesco ='$parentesco_emergencia',
                    ingresos_emergencia_fono ='$fono_emergencia', 
                    ingresos_enfermedad ='$enfermedad', 
                    ingresos_enfermedad_detalle ='$enfermedad_detalle',
                    ingresos_observacion2 ='$observaciones2',

                    ingresos_prevision ='$prevision',
                    ingresos_salud ='$salud', 
                    ingresos_plan_saluduf ='$saludUF', 
                    ingresos_plan_saludporc ='$salud_porc', 
                    ingresos_plan_saludpeso ='$salud_peso', 
                    ingresos_centro_costo ='$centro_costo', 
                    ingresos_sueldo_base ='$sueldo_base',
                    ingresos_horas_semana ='$horas_semana',
                    ingresos_forma_pago ='$forma_pago', 
                    ingresos_banco ='$banco',
                    ingresos_cta_banco ='$cta_banco', 

                    ingresos_asig_colacion ='$asig_colacion',  
                    ingresos_asig_movil ='$asig_movilizacion', 
                    ingresos_prop_traba ='$asig_propia', 
                    ingresos_anticipo_var ='$anticipo', 
                    ingresos_anticipo_monto ='$monto_anticipo', 
                    ingresos_observacion3 ='$observacion3', 
                    
                    ingresos_estudios ='$estudios', 
                    ingresos_ano_exemple ='$anos_ex', 
                    ingresos_tipo_trabajador ='$tipo_trabajador', 
                    ingresos_tope_gratif ='$tope_gratificacion', 
                    ingresos_sueldo_diario ='$sueldo_diario', 
                    ingresos_tipo_jornada ='$tipo_jornada', 
                    ingresos_sabado ='$incluye_sabado', 
                    ingresos_tarja ='$aplica_tarja', 
                    ingresos_observaciones4 ='$observaciones4',
                    ingresos_usuario ='$usuario'

   WHERE ingresos_id = '$id'
";
$rs	 =	mysqli_query($conexion,$sql);

   if($rs)
      header("Location: ingresos.php?x=modi_exi");
   else
      header("Location: ingresos.php?x=modi_err");
?>