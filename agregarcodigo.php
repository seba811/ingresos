<?php

include('conexion.php');

$codigotipo = $_POST['codigotipo'];
$codigonombre= $_POST['nombrecodigo']; 
$codigodetalle= $_POST['detallecodigo']; 
$codigoempresa=$_POST['empresacodigo']; 

$rs_codigo = $conexion->query("SELECT codigos_nombre,codigos_descripcion FROM codigos where codigos_tipo ='$codigotipo'");
$cod = $rs_codigo->fetch_array(MYSQLI_ASSOC);
if($cod['codigos_nombre']==$codigonombre ){

echo 1;

}else{

	$sql =	"	INSERT INTO	codigos
				(
					codigos_nombre,
					codigos_tipo,
                    codigos_descripcion,
					codigos_empresa
				)
				VALUES 
				(
                    '$codigonombre',
					'$codigotipo',
                    '$codigodetalle',
					'$codigoempresa'
               
				)
			";
	$rs	 =	mysqli_query($conexion,$sql);
    if($rs)
	{
        echo 0;
	}
	else
	{
	echo 2;
	}}
?>