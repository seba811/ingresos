<?php
session_start();
   include ('conexion.php');


   $estado = trim($_REQUEST['id_estado']);

   
   //echo "<br>hola estado: $estado_id 
   $filtros = "";
   if($estado==2){
    $rs_preingresos = $conexion->query("SELECT * FROM preingresos ");

   }else{
   $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_estado= '$estado'");
   }

   $html = "";
   $comilla=' " ';
     
    while ($row = $rs_preingresos->fetch_array(MYSQLI_ASSOC)) {
        $preingresos_usuario   = $row['preingresos_usuario'];
        $preingresos_nombre   = $row['preingresos_nombre'];
        $preingresos_apellido   = $row['preingresos_apellidop'];
        $preingresos_rut = $row['preingresos_rut'];
        $preingresos_estado = $row['preingresos_estado'];
        $preingresos_fecha_registro = $row['preingresos_fecha_registro'];
        $preingresos_id=$row['preingresos_id'];
        $eliminar ="javascript: return confirm($comilla ¿Desea Eliminar Este Usuario?$comilla)";

        if($preingresos_estado==1){
            $icono="width='50' height='50' class='bi bi-exclamation-circle-fill fa-2x ' style='font-size: 1.5rem; margin-left:10px;color: orange'";

        }else if($preingresos_estado==0 ){

            $icono="width='50' height='50' class='bi bi-check-circle-fill fa-2x ' style='font-size: 1.5rem; margin-left:10px;color: green'";
        }else {

            $icono="Hola";
        }

   $html .= "   
   <tr>
      <td>$preingresos_fecha_registro</td>
      <td>$preingresos_nombre $preingresos_apellido</td>
      <td>$preingresos_rut</td>
      <td>$preingresos_usuario</td>

      
      
      <td title='Estado' class='texto-centro'>
      
        <a title='Modificar' href='preingresos_modificar.php?id=$preingresos_id'>
        <i$icono > </i>
        </a>
      <a title='Eliminar' href='preingresos_eliminar.php?id=$preingresos_id' onclick='javascript: return confirm('¿Desea Eliminar Este Usuario?');'>
        <i class='bi bi-trash-fill fa-2x ' style='font-size: 1.5rem;margin-left:10px;color:red'></i>

      </a>
      </td>
   </tr>";
   }
   echo $html;
   ?>