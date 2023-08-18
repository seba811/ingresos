<?php
include('conexion_qbiz.php');

include('conexion.php');
$fechahoy= date("Y-m-d");

$rut=trim($_POST['rut']);

//$rs_preingre= $conexion->query("SELECT * FROM preingresos where preingresos_rut='$rut' ");
//$m = $rs_preingre->num_rows;


$rs_ingrehoy = $conexion->query("SELECT * FROM ingresos where ingresos_rut='$rut' and ingresos_fecha_ing='$fechahoy'");
 $n = $rs_ingrehoy->num_rows;
 
if($rut==''){
    echo 0;
}else if($n!=0){

echo 2;

} else {


$sql = "   SELECT  TOP 1
                 Replace(e.RazonSocial, ',', ' ')   as NombreCompleto
                 ,e.CodLegal as Rut
                 ,e.Clasif17 as Recontratacion
                 ,e.Texto1   as JustifNo
                 ,e.FechaDesde   as FechaInicio
                 ,e.FechaHasta   as FechaTermino
                 from   Entidad e
                 where e.TipoEntidad='funcionario'
                 and e.Entidad <> '(APROBACION)'
                 and LEN(e.Entidad)<9 and e.CodLegal=?
                 ORDER BY e.FechaHasta DESC";

$consulta = $base_de_datos->prepare($sql);
$consulta->execute([$rut]);
$rs = $consulta->fetchObject();
if($rs!=NULL){
$dato1=$rs->JustifNo;
$dato2=$rs->Recontratacion;

}
else{
$dato1=1;
$dato2=1;

}
if($dato2!='NO'){

    echo 1;

}
else{
 echo $dato1;
}
}
?>

