<?php 
session_start();
if(!$_SESSION){
    print '<script language="javascript">
        alert("Error: Usuario No Autenticado"); 
        self.location = "../index.php";
        </script>';
}

   include ('conexion.php');

   $preingresos_id = $_GET['id'];
   if($usuario_id == ""){
      header("Location: preingresos.php?x=elimin_err");
   }

   $sql =	"DELETE FROM preingresos
            WHERE	preingresos_id = '$preingresos_id'
         ";

  $rs	 =	mysqli_query($conexion,$sql);

   if($rs)
      header("Location: preingresos.php?x=elimin_exi");
   else
      header("Location: preingresos.php?x=elimin_err");
?>