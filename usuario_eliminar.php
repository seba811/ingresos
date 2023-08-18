<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "index.php";
        </script>';
}

   include ('conexion.php');

   $usuario_id = $_GET['id'];
   if($usuario_id == ""){
      header("Location: usuarios.php?x=elimin_err");
   }

   $sql =	"DELETE FROM usuarios
            WHERE	usuario_id = '$usuario_id'
         ";

  $rs	 =	mysqli_query($conexion,$sql);

   if($rs)
      header("Location: usuarios.php?x=elimin_exi");
   else
      header("Location: usuarios.php?x=elimin_err");
?>