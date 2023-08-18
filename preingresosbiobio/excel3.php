<?php
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include('conexion.php');

$fecha_ficha = $_GET['fecha'];
$empresa_ficha = $_GET['empresa'];

$fecha_filtro = DateTime::createFromFormat('d-m-Y', $fecha_ficha)->format('Y-m-d');
$objPHPExcel = new PHPExcel();
// configuramos las propiedades del documento
$objPHPExcel->getProperties()->setCreator("Prize")
    ->setLastModifiedBy("INFORMATION")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


$y = 1;

/*$objPHPExcel->getActiveSheet()
     ->mergeCells('A1:Z1')
     ->mergeCells('A2:F2')
     ->mergeCells('G2:L2')
     ->mergeCells('M2:O2')
     ->mergeCells('P2:U2')
     ->mergeCells('V2:Z2');
*/
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A1", 'Código Logam')

    ->setCellValue("B1", 'Rut Funcionario')
    ->setCellValue("C1", 'Nombres')
    ->setCellValue("D1", 'Apellido Paterno')
    ->setCellValue("E1", 'Apellido Materno')
    ->setCellValue("F1", 'Fecha No Re-Cont.')

    ->setCellValue("G1", 'Fecha Desde')
    ->setCellValue("H1", 'Fecha Hasta')
    ->setCellValue("I1", 'Fecha Nacimiento')
    ->setCellValue("J1", 'Estado Civil')
    ->setCellValue("K1", 'Dirección')
    ->setCellValue("L1", 'Comuna')
    ->setCellValue("M1", 'Nacionalidad')
    ->setCellValue("N1", 'Telefono')

    ->setCellValue("O1", 'eMail')
    ->setCellValue("P1", 'Área')
    ->setCellValue("Q1", 'Cargo')
    ->setCellValue("R1", 'Planta')
    ->setCellValue("S1", 'Tarjable')
    ->setCellValue("T1", 'Código Serv.')
    ->setCellValue("U1", 'Entidad Contratista')
    ->setCellValue("V1", 'Entidad Contratista')
    ->setCellValue("W1", 'Observaciones');


$objPHPExcel->getActiveSheet()
    ->getStyle('A1:W1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFFFF');




$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
        )
    ),
);
$objPHPExcel->getActiveSheet()
    ->getStyle('A1:W1')
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->applyFromArray($borders);



$objPHPExcel->getActiveSheet()->setTitle('Preingresos ');
//Fuente
$objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
//Tamaño deceldas
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20)->setAutoSize(true);



$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
        )
    ),
);
$objPHPExcel->getActiveSheet()
    ->getStyle('A1:Y1')
    ->applyFromArray($borders);

$objPHPExcel->setActiveSheetIndex(0)
    ->getStyle('A' . $y . ":Y" . $y)
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->applyFromArray($borders);

$rs_preingresos = $conexion->query("SELECT  
`a`.`preingresos_nombre`,
`a`.`preingresos_apellidop`,
`a`.`preingresos_apellidom`,
`a`.`preingresos_rut`,
`a`.`preingresos_fecha_ingreso`,
`a`.`preingresos_turno`,
`a`.`preingresos_cargo`,
`a`.`preingresos_area`,
`a`.`preingresos_fecha_naci`,
`a`.`preingresos_nacionalidad`,
`a`.`preingresos_fono`,
`a`.`preingresos_correo`,
`a`.`preingresos_estado_civil`,
`a`.`preingresos_direccion`,
`a`.`preingresos_comuna`,
`a`.`preingresos_estudios`,
`a`.`preingresos_empresa`,
`a`.`preingresos_sexo`,
`a`.`preingresos_tipo_reclutador`,
`a`.`preingresos_reclutador_nombre`,
`a`.`preingresos_observaciones`,
`b`.`tipo_reclutamiento_rut`,
`b`.`tipo_reclutamiento_razon_social`
FROM bd_contratacion.preingresos as a inner join bd_contratacion.tipo_reclutamiento as b on a.preingresos_reclutador_nombre = b.tipo_reclutamiento_razon_social
where a.preingresos_fecha_ingreso = '$fecha_filtro' and a.preingresos_tipo_reclutador='0' and a.preingresos_estado='0'");
$cont = 0;
while ($row =  $rs_preingresos->fetch_array(MYSQLI_ASSOC)) {
    $cont++;

    $rut                 =    $row['preingresos_rut'];
    $nombre              =    $row['preingresos_nombre'];
    $apellidop           =    $row['preingresos_apellidop'];
    $apellidom           =    $row['preingresos_apellidom'];


    $fecha_naci          =    $row['preingresos_fecha_naci'];
    $fecha_naci = DateTime::createFromFormat('Y-m-d', $fecha_naci)->format('d-m-Y');
    $nacionalidad        =    $row['preingresos_nacionalidad'];
    $email               =    $row['preingresos_correo'];
    $fono                =    $row['preingresos_fono'];
    $estado_civil        =    $row['preingresos_estado_civil'];

    $direccion           =    $row['preingresos_direccion'];
    $comuna              =    $row['preingresos_comuna'];

    $fecha_ingreso        =   $row['preingresos_fecha_ingreso'];
    $fecha_ingreso = DateTime::createFromFormat('Y-m-d', $fecha_ingreso)->format('d-m-Y');


    $cargo              =    $row['preingresos_cargo'];
    $area               =    $row['preingresos_area'];

    $empresa            =    $row['preingresos_empresa'];
    $observaciones = $row['preingresos_observaciones'];

    $razon_social_contra = $row['preingresos_reclutador_nombre'];

    $rut_contratista  = $row['tipo_reclutamiento_rut'];
    $rut_contratista = substr($rut_contratista, 0, -2);

    
    if ($empresa == 'Contratista Requinoa') {

        $planta = 'NR';
    }

    $y++;
    // Bordes a celdas creadas porlaconsulta
    $objPHPExcel->setActiveSheetIndex(0)
        ->getStyle('A' . $y . ":W" . $y)
        ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->applyFromArray($borders);

    // Mostramos los valores
    $objPHPExcel->setActiveSheetIndex(0)

        ->setCellValue('B' . $y, $rut)
        ->setCellValue('C' . $y, $nombre)
        ->setCellValue('D' . $y, $apellidop)
        ->setCellValue('E' . $y, $apellidom)


        ->setCellValue('G' . $y, $fecha_ingreso)

        ->setCellValue('I' . $y, $fecha_naci)
        ->setCellValue('J' . $y, $estado_civil)
        ->setCellValue('K' . $y, $direccion)
        ->setCellValue('L' . $y, $comuna)

        ->setCellValue('M' . $y, $nacionalidad)
        ->setCellValue('N' . $y, $fono)

        ->setCellValue('O' . $y, $email)
        ->setCellValue('P' . $y, $area)
        ->setCellValue('Q' . $y, $cargo)
        ->setCellValue('R' . $y, $planta)
        ->setCellValue('S' . $y, 'SI')

        ->setCellValue('U' . $y, '00'.$rut_contratista)
        ->setCellValue('V' . $y, $razon_social_contra)
        ->setCellValue('W' . $y, $observaciones);
}

// --------------------------------------------------------------------------------------------------------   


//---------------------------------------------------------------------------------------------------------

$objPHPExcel->setActiveSheetIndex(0);
$nombre = "Content-Disposition: attachment;filename=Ficha Contratista para '$fecha_ficha'.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header($nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


return 1;
