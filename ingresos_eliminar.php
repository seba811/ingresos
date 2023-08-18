<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "index.php";
        </script>';
}

   include ('conexion.php');

   $ingresos_id = $_GET['id'];
   if($usuario_id == ""){
      header("Location: ingresos.php?x=elimin_err");
   }

   $sql =	"DELETE FROM ingresos
            WHERE	ingresos_id = '$ingresos_id'
         ";

  $rs	 =	mysqli_query($conexion,$sql);

   if($rs)
      header("Location: ingresos.php?x=elimin_exi");
   else
      header("Location: ingresos.php?x=elimin_err");
?>