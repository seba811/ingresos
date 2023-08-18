<?php

include('conexion.php');

if (!isset($_SESSION)) {
	session_start();
}

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$consulta = "SELECT *
				 FROM usuarios
				 WHERE usuario_usuario = '$usuario'
				 AND usuario_clave = '$clave'
				 ";
$rs_usuarios = $conexion->query($consulta);
$row = $rs_usuarios->fetch_array(MYSQLI_ASSOC);


if ($row['usuario_usuario'] == '' || $row['usuario_clave'] == '') {

	header("location: index.php?x=1");
} else {

	$_SESSION['usuario_id'] 		= $row['usuario_id'];
	$_SESSION['usuario_usuario'] 	= $row['usuario_usuario'];
	$_SESSION['usuario_nombre'] 	= $row['usuario_nombre'];
	$_SESSION['usuario_tipo']		= $row['usuario_tipo'];
// dividimos donde iniciar dependiendo el tipo de usuario
	if ($_SESSION['usuario_tipo'] == 5 || $_SESSION['usuario_tipo']== 6) {

		header("location: preingresos.php");
	} else if($_SESSION['usuario_tipo'] == 9 || $_SESSION['usuario_tipo']== 8 ) {
		 header("location: preingresosbiobio/preingresos.php");
	} else {
		header("location: ingresos.php");
	}
}
