<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "index.php";
        </script>';
}

   include ('conexion.php');
   $hoy = date("Y-m-d");
   $id = $_POST["id"];
   if($id == ""){
      header("Location: preingresos.php?x=modi_err");
   }
  
 $usuario=$_SESSION['usuario_nombre']; 
 $usuario_id= $_SESSION['usuario_id'];
//MODULO 1
$fecha_ingreso = $_POST['fecha_ingreso'];
//MODULO 1
$emp = $_POST['empresa'];


if(isset($_POST['turno'])){
$turno = $_POST['turno'];}else{
$turno=" ";

}
if(isset($_POST['comoinforma'])){
   $comoinforma = $_POST['comoinforma'];}else{
   $comoinforma=" ";
   
   }

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
$observaciones = $_POST['observaciones'];
$observaciones = strtoupper($observaciones);

$reclutamiento = $_POST['reclutamiento'];
$reclutamiento_nombre = $_POST['reclutamiento_nombre'];

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
$discapacidad = $_POST['discapacidad'];

//modulo 3
$prevision = $_POST['prevision'];
$salud = $_POST['salud'];
$banco = $_POST['banco'];
$cta_banco = $_POST['cta_banco'];

// modulo 4
$estudios = $_POST['estudios'];


if(empty($banco) || empty($estudios) || empty($salud) || 
   empty($prevision) || empty($discapacidad)||empty($fecha_ingreso)|| empty($cargo) || 
   empty($faena)|| empty($turno) || empty($transportista)||empty($ex_emple) || empty($estado_civil)){
$estado=1;

}else{

$estado=0;
};

if($_SESSION['usuario_tipo']==1){
   
   $sql =	"	UPDATE preingresos
   SET
                    
                    preingresos_fecha_ingreso='$hoy',
                    preingresos_observaciones ='$observaciones',
                    preingresos_estado='2'
                   


                 

   WHERE preingresos_id = '$id'
";


}else{

$sql =	"	UPDATE preingresos
   SET
                   preingresos_empresa='$emp',
                    preingresos_tipo_reclutador= '$reclutamiento',
                    preingresos_reclutador_nombre = '$reclutamiento_nombre',
					     preingresos_fecha_ingreso = '$fecha_ingreso', 
                    preingresos_tipo_contrato = '$tipo_contrato',
                    preingresos_cargo ='$cargo', 
                    preingresos_comoinforma ='$comoinforma', 
                    preingresos_transportista  ='$transportista',
                    preingresos_transportista_nombre='$trasnportista_nombre', 
                    preingresos_faena ='$faena1',
                    preingresos_faena_cod ='$faena2',
                    preingresos_area ='$area', 
                    preingresos_ex_emple ='$ex_emple', 
                    preingresos_c_temporadas ='$temporadas', 
                    preingresos_observaciones ='$observaciones',

                    preingresos_nombre ='$nombre', 
                    preingresos_apellidop ='$apellidop', 
                    preingresos_apellidom ='$apellidom',
                    preingresos_rut ='$rut', 
                    preingresos_nacionalidad ='$nacionalidad', 
                    preingresos_sexo ='$sexo', 
                    preingresos_fecha_naci ='$fecha_naci', 
                    preingresos_fono ='$fono', 
                    preingresos_direccion ='$direccion', 
                    preingresos_comuna ='$comuna', 
					     preingresos_estado_civil ='$estado_civil',
					     preingresos_correo ='$correo',
                    preingresos_emergencia_nombre ='$nombre_emergencia',
                    preingresos_emergencia_parentesco ='$parentesco_emergencia',
                    preingresos_emergencia_fono ='$fono_emergencia', 
                    preingresos_enfermedad ='$enfermedad', 
                    preingresos_enfermedad_detalle ='$enfermedad_detalle',
                    preingresos_discapacidad ='$discapacidad',

                    preingresos_prevision ='$prevision',
                    preingresos_salud ='$salud', 
                    preingresos_banco ='$banco',
                    preingresos_cta_banco ='$cta_banco', 

                    preingresos_estado='$estado',
                   
                    preingresos_estudios ='$estudios'

                 

   WHERE preingresos_id = '$id'
";


}

$rs	 =	mysqli_query($conexion,$sql);



  
     if ($rs) {
		if ($_SESSION['usuario_tipo'] == 0 or $_SESSION['usuario_tipo'] == 5 or $_SESSION['usuario_tipo'] == 6) {
         header("Location: preingresos.php?x=modi_exi");
		} else {
         header("Location: ingresos.php?x=add_exi");
		}
	} else {
		if ($_SESSION['usuario_tipo'] == 0 or $_SESSION['usuario_tipo'] == 5 or $_SESSION['usuario_tipo'] == 6) {
         header("Location: preingresos.php?x=modi_err");
		} else {

         header("Location: ingresos.php?x=add_err");
		}
	}
   
     
     ?>