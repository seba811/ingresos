<?php
session_start();

include('conexion.php');

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$estado = $_POST['estado'];
$clave = $_POST['clave1'];

$rs_usuario = $conexion->query("SELECT usuario_usuario FROM usuarios where usuario_usuario ='$usuario'");
$usu = $rs_usuario->fetch_array(MYSQLI_ASSOC);

if ($usu['usuario_usuario'] == $usuario) {



		header("Location: usuarios_pre.php?x=add_usu");
	
	
} else {

	$sql =	"	INSERT INTO	usuarios
				(
					usuario_usuario,
					usuario_clave,
                    usuario_tipo,
					usuario_nombre
				)
				VALUES 
				(
                    '$usuario',
					'$clave',
                    '$estado',
                    '$nombre'
				)
			";
	$rs	 =	mysqli_query($conexion, $sql);


	if ($rs) {
		
			header("Location: usuarios_pre.php?x=add_exi");
	
			
	
	} else {
	
			header("Location: usuarios_pre.php?x=add_err");

	}
}
