<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "../index.php";
        </script>';
}

   include ('conexion.php');

   $id = $_POST["id"];
   if($id == ""){
      header("Location: usuarios.php?x=modi_err");
   }
   $usuario = $_POST["usuario"];
   $nombre = $_POST["nombre"];
   $tipo = $_POST["estado"];
   $clave = $_POST["clave1"]; 
 
   $sql =	"	UPDATE usuarios
   SET
    usuario_usuario = '$usuario',
    usuario_nombre = '$nombre',
       usuario_tipo = '$tipo',
       usuario_clave = '$clave'
   WHERE usuario_id = '$id'
";
$rs	 =	mysqli_query($conexion,$sql);

if ($rs) {
 
      header("Location: usuarios_pre.php?x=modi_exi");

} else {
 
      header("Location: usuarios_pre.php?x=modi_err");
  
}
?>

