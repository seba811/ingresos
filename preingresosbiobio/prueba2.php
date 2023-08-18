<?php

include('conexion.php');

$estado_id = trim($_POST['id_estado']);

if ($estado_id == '') {
    echo 0;
} else if($estado_id=='2') {

    echo '<option  value=""> </option>';
}else{
    $rs = $conexion->query("  SELECT * FROM tipo_reclutamiento WHERE tipo_reclutamiento_tipo ='$estado_id'");


    echo '<option  value=""></option>';
    while ($row = $rs->fetch_array(MYSQLI_ASSOC)) {
       
            echo '<option  value="'. $row['tipo_reclutamiento_razon_social'].'">'. $row['tipo_reclutamiento_razon_social'].'</option>';
        
    }
  
}
?>
