<?php
require_once dirname(__FILE__) . '../../Classes/PHPExcel.php';
include('conexion.php'); 

$fecha_ficha=$_GET['fecha'];
$empresa_ficha=$_GET['empresa'];

$fecha_filtro=DateTime::createFromFormat('d-m-Y', $fecha_ficha)->format('Y-m-d');
$objPHPExcel = new PHPExcel();
    // configuramos las propiedades del documento
    $objPHPExcel->getProperties()->setCreator("Prize")
                                 ->setLastModifiedBy("INFORMATION")
                                 ->setTitle("Office 2007 XLSX Test Document")
                                 ->setSubject("Office 2007 XLSX Test Document")
                                 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                 ->setKeywords("office 2007 openxml php")
                                 ->setCategory("Test result file");


$y = 4;

$objPHPExcel->getActiveSheet()
     ->mergeCells('A1:Z1')
     ->mergeCells('A2:F2')
     ->mergeCells('G2:L2')
     ->mergeCells('M2:O2')
     ->mergeCells('P2:U2')
     ->mergeCells('V2:Z2');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A1",'Campos Obligatorios marcados con (*)')

    ->setCellValue("A2",'Informacion Minima')
    ->setCellValue("G2",'Informacion Personal')
    ->setCellValue("M2",'Direccion Particular del Empleado')
    ->setCellValue("P2",'Informacion Laboral')
    ->setCellValue("V2",'Informacion Previcional')

    ->setCellValue("A3",'rut')
    ->setCellValue("A4",'*')
    ->setCellValue("B3",'nombre')
    ->setCellValue("B4",'*')
    ->setCellValue("C3",'apellidoPaterno')
    ->setCellValue("C4",'*')
    ->setCellValue("D3",'apellidoMaterno')
    ->setCellValue("D4",'*')

    ->setCellValue("E3",'sexo')
    ->setCellValue("E4",'*')
    ->setCellValue("F3",'fechaNacimiento')
    ->setCellValue("G3",'nacionalidad')
    ->setCellValue("H3",'emailPersonal')
    ->setCellValue("I3",'celular')
    ->setCellValue("J3",'estadoCivil')
    ->setCellValue("K3",'banco')
    ->setCellValue("L3",'Nº de cuenta ')

    ->setCellValue("M3",'direccionCalle')
    ->setCellValue("N3",'direccionComuna')

    ->setCellValue("O3",'empleadorRazonSocial')
    ->setCellValue("P3",'sucursal')
    ->setCellValue("Q3",'cargo')
    ->setCellValue("R3",'centroCosto')
    ->setCellValue("S3",'tipoContrato')
    ->setCellValue("T3",'faena')
    ->setCellValue("U3",'desde')
    ->setCellValue("V3",'afp')
    ->setCellValue("W3",'isapre')
    ->setCellValue("X3",'montoPactadoIsapre')
    ->setCellValue("Y3",'esPensionado')


    
    ;
   

    $objPHPExcel->getActiveSheet()
    ->getStyle('A1:X1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFFFF');

    
    $objPHPExcel->getActiveSheet()
    ->getStyle('A2:F2')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FBFF00');

    $objPHPExcel->getActiveSheet()
    ->getStyle('A3:F3')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FBFF00');


    
    $objPHPExcel->getActiveSheet()
    ->getStyle('A1:Y1')
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
->getStyle('A2:Y2')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);

$objPHPExcel->getActiveSheet()
->getStyle('A3:Y3')
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
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20)->setAutoSize(true);


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
    ->getStyle('A'.$y.":Y".$y)
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->applyFromArray($borders);

     $rs_preingresos = $conexion->query("SELECT * FROM preingresos where preingresos_fecha_ingreso = '$fecha_filtro' and preingresos_estado=0 and preingresos_empresa='$empresa_ficha'");
     $cont=0;
     while ($row =  $rs_preingresos->fetch_array(MYSQLI_ASSOC)) {
        $cont++;
        
       $rut                 =    $row['preingresos_rut'];
       $nombre              =    $row['preingresos_nombre'];
       $apellidop           =    $row['preingresos_apellidop'];
       $apellidom           =    $row['preingresos_apellidom'];
       $sexo                =    $row['preingresos_sexo'];

       $fecha_naci          =    $row['preingresos_fecha_naci'];
       $nacionalidad        =    $row['preingresos_nacionalidad'];
       $email               =    $row['preingresos_correo'];
       $fono                =    $row['preingresos_fono'];
       $estado_civil        =    $row['preingresos_estado_civil'];

       if($sexo=='MASCULINO'){
$estado_civil= substr("$estado_civil",0,-3);
       }else{
        $estado_civil= substr("$estado_civil",0,-4);
$estado_civil=$estado_civil.'A';
       }
       $banco               =    $row['preingresos_banco'];
       $banco_cuenta        =    $row['preingresos_cta_banco'];
       $direccion           =    $row['preingresos_direccion'];
       $comuna              =    $row['preingresos_comuna'];
       $afp                 =    $row['preingresos_prevision'];
       $isapre              =    $row['preingresos_salud'];
       $fecha_ingreso        =   $row['preingresos_fecha_ingreso'];
      if($afp=='PENSIONADO'){
        $espensionado  = 'SI'; //$row['preingresos_apellidom'];

      }else{
       $espensionado  = 'NO' ;//$row['preingresos_apellidom'];
      } 
       $faena               =    $row['preingresos_faena'];
        $cargo              =    $row['preingresos_cargo'];
        $area               =    $row['preingresos_area'];
   
        $empresa            =    $row['preingresos_empresa'];
        
        $empresa= str_replace('.','',$empresa);
        $usuario            =    $row['preingresos_usuario'];
        $tipo_contrato      = $row['preingresos_tipo_contrato'];
        $tiporeclutador= $row['preingresos_tipo_reclutador'];
if($tiporeclutador==0){

    $tiporeclutadornom='CONTRATISTA';
}else if($tiporeclutador==1){
    $tiporeclutadornom='ENGANCHE';

}else {

    $tiporeclutadornom='PLANTA';
}

        $nombrereclutador= $row['preingresos_reclutador_nombre'];
   
         $y++;
        // Bordes a celdas creadas porlaconsulta
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('A'.$y.":Y".$y)
            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->applyFromArray($borders);

        // Mostramos los valores
        $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$y, $rut)
                 ->setCellValue('B'.$y, $nombre)
                 ->setCellValue('C'.$y, $apellidop)
                 ->setCellValue('D'.$y, $apellidom)
                 ->setCellValue('E'.$y, $sexo)
                 ->setCellValue('F'.$y, $fecha_naci)

                 ->setCellValue('G'.$y, $nacionalidad)
                 ->setCellValue('H'.$y, $email)
                 ->setCellValue('I'.$y, $fono)
                 ->setCellValue('J'.$y, $estado_civil)
                 ->setCellValue('K'.$y, $banco)
                 ->setCellValue('L'.$y, $banco_cuenta)

                 ->setCellValue('M'.$y, $direccion)
                 ->setCellValue('N'.$y, $comuna)

                 ->setCellValue('O'.$y, $empresa)
                 ->setCellValue('P'.$y, 'Natura Chillan')
                 ->setCellValue('Q'.$y, $cargo)
                 ->setCellValue('R'.$y, $area)
                 ->setCellValue('S'.$y, $tipo_contrato)
                 ->setCellValue('T'.$y, $faena)
                 ->setCellValue('U'.$y, $fecha_ingreso)
                 ->setCellValue('V'.$y, $afp)
                 ->setCellValue('W'.$y, $isapre)
                 ->setCellValue('X'.$y, '')
                 ->setCellValue('Y'.$y, $espensionado)
                 ->setCellValue('Z'.$y,  $usuario)
                 ->setCellValue('AA'.$y, $tiporeclutadornom)
                 ->setCellValue('AB'.$y,  $nombrereclutador);
                 
     }

 // --------------------------------------------------------------------------------------------------------   
    

 //---------------------------------------------------------------------------------------------------------

     $objPHPExcel->setActiveSheetIndex(0);
     $nombre="Content-Disposition: attachment;filename=Ficha Preingresos para '$fecha_ficha'.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header($nombre);
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');


    return 1;
