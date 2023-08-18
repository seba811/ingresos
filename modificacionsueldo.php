<?php
include('conexion.php');

$sueldomin=trim($_POST['sueldomini']);
$sueldomax=trim($_POST['sueldomaxi']);


if($sueldomin>$sueldomax){
    echo 1;
}else{
$sqlMax =	"	UPDATE codigos
SET
 codigos_descripcion = '$sueldomax'
WHERE codigos_id = 4391
";
$rs	 =	mysqli_query($conexion,$sqlMax);


$sqlMin =	"	UPDATE codigos
SET
 codigos_descripcion = '$sueldomin'
WHERE codigos_id = 4392
";
$rs	 =	mysqli_query($conexion,$sqlMin);


echo 0;
}

?>

