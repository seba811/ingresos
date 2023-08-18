<?php
include('conexion.php');

$tramo= $_POST['tramo'];


$consulta= "SELECT * FROM tramos WHERE tramos_id=$tramo ";
$resultado	 =	mysqli_query($conexion, $consulta);

$row=$resultado->fetch_array(MYSQLI_ASSOC);
if(isset($row['tramos_sueldobase'])){
$sueldo=$row['tramos_sueldobase'];
$movilizacion=$row['tramos_movilizacion'];
}else{

    $sueldo=0;
    $movilizacion=0;
}
echo json_encode(array('sueldo'=>$sueldo,'movilizacion'=>$movilizacion));