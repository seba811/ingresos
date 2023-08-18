<?php
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include('conexion.php'); 

$fecha_ficha=$_GET['fecha'];
$empresa=$_GET['empresa'];
$t=$_GET['turno'];
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

$y = 1;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A".$y,'Empresa')
    ->setCellValue("B".$y,'TipoDocumento')
    ->setCellValue("C".$y,'Número')
    ->setCellValue("D".$y,'Correlativo')
    ->setCellValue("E".$y,'Fecha')
    ->setCellValue("F".$y,'Glosa')
    ->setCellValue("G".$y,'Observaciones');
 

    $objPHPExcel->getActiveSheet()
    ->getStyle('A1:G1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFEEEEEE');

$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
            )
        ),
    );
    $objPHPExcel->getActiveSheet()
->getStyle('A7:N7')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);


                $objPHPExcel->getActiveSheet()->setTitle('Documento');

//Fuente
$objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
//Tamaño deceldas
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35)->setAutoSize(true);

$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
            )
        ),
    );
    $objPHPExcel->getActiveSheet()
            ->getStyle('A1:G1')
            ->applyFromArray($borders);

            $objPHPExcel->setActiveSheetIndex(0)
    ->getStyle('A'.$y.":G".$y)
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->applyFromArray($borders);

          $y++;
        // Bordes a celdas creadas porlaconsulta
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('A'.$y.":G".$y)
            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->applyFromArray($borders);

        // Mostramos los valores
        $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$y,$empresa)
                 ->setCellValue('B'.$y,'FICHA DE CONTRATACION')
                 ->setCellValue('C'.$y,'841')
                 ->setCellValue('D'.$y,'841')
                 ->setCellValue('E'.$y,$fecha_ficha)
                 ->setCellValue('F'.$y,'')
                 ->setCellValue('G'.$y,'');

 //LA HOJA NUMERO 2 --------------------------------------------------------------------------------------------------------   
     $objPHPExcel->createSheet(1);
     $y = 1;
$objPHPExcel->setActiveSheetIndex(1)
    ->setCellValue("A".$y,'N°Ficha')
    ->setCellValue("B".$y,'Fecha Ingreso')
    ->setCellValue("C".$y,'Fecha Término')
    ->setCellValue("D".$y,'Turno')
    ->setCellValue("E".$y,'Registra Asist.')
    ->setCellValue("F".$y,'Tipo Contrato')
    ->setCellValue("G".$y,'Cargo')
    ->setCellValue("H".$y,'Transportista(Sí/No)')
    ->setCellValue("I".$y,'Nombre Transportista')
    ->setCellValue("J".$y,'Faena')
    ->setCellValue("K".$y,'Área')
    ->setCellValue("L".$y,'Ex Empleado(Sí/No)')
    ->setCellValue("M".$y,'Cuantas Temporadas')
    ->setCellValue("N".$y,'Observaciones');

    $objPHPExcel->getActiveSheet()
    ->getStyle('A1:N1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFEEEEEE');

$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
            )
        ),
    );
    $objPHPExcel->getActiveSheet()
->getStyle('A1:N1')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);


                $objPHPExcel->getActiveSheet()->setTitle('ENTIDAD_A');
                //Fuente
$objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
//Tamaño deceldas
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10)->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10)->setAutoSize(true);

$borders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_BORDER::BORDER_THIN,
            'color' => array('argb' => '00000000'),
            )
        ),
    );
    $objPHPExcel->getActiveSheet()
            ->getStyle('A1:N1')
            ->applyFromArray($borders);

            $objPHPExcel->setActiveSheetIndex(1)
    ->getStyle('A'.$y.":N".$y)
    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->applyFromArray($borders);

   $fechalarga1=$fecha_filtro.' 00:00:00';
   $fechalarga2=$fecha_filtro.' 15:00:00';
   $fechalarga3=$fecha_filtro.' 15:00:01';
   $fechalarga4=$fecha_filtro.' 23:59:59';
if($t=='dia'){
     $rs_ingresos = $conexion->query("SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga1' and ingresos_fecha_larga<'$fechalarga2'");
    }else{
    $rs_ingresos = $conexion->query(" SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga3' and ingresos_fecha_larga<'$fechalarga4'");
}
     $cont=0;
     while ($row =  $rs_ingresos->fetch_array(MYSQLI_ASSOC)) {
        $cont++;
        $n_ficha            =    strval($cont);
        $fecha_ingreso      =    DateTime::createFromFormat('Y-m-d', $row['ingresos_fecha_ing'])->format('d-m-Y');
        if($row['ingresos_fecha_term']==''){
            $fecha_termino=strval(' ');
        }else{ 
        $fecha_termino      =    strval(DateTime::createFromFormat('Y-m-d', date($row['ingresos_fecha_term']))->format('d-m-Y'));
        }
        $turno              =    $row['ingresos_turno'];
        $registra_asis      =    $row['ingresos_r_asistencia'];
        $tipo_contrato      =    $row['ingresos_tipo_contrato'];
        $cargo              =    $row['ingresos_cargo'];
        $trasportista       =    $row['ingresos_transportista'];
        $trans_nombre       =    $row['ingresos_transportista_nombre'];
        $faena              =    $row['ingresos_faena_cod'];
        $area               =    $row['ingresos_area'];
        $exemple            =    $row['ingresos_exemple'];
        $c_tempor           =    $row['ingresos_c_temporadas'];
        $observa1           =    $row['ingresos_observacion1'];
     
         $y++;
        // Bordes a celdas creadas porlaconsulta
        $objPHPExcel->setActiveSheetIndex(1)
            ->getStyle('A'.$y.":N".$y)
            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->applyFromArray($borders);

        // Mostramos los valores
        $objPHPExcel->setActiveSheetIndex(1)
                 ->setCellValue('A'.$y, $n_ficha)
                 ->setCellValue('B'.$y, $fecha_ingreso)
                 ->setCellValue('C'.$y, $fecha_termino)
                 ->setCellValue('D'.$y, $turno)
                 ->setCellValue('E'.$y, $registra_asis)
                 ->setCellValue('F'.$y, $tipo_contrato)
                 ->setCellValue('G'.$y, $cargo)
                 ->setCellValue('H'.$y, $trasportista)
                 ->setCellValue('I'.$y, $trans_nombre)
                 ->setCellValue('J'.$y, $faena)
                 ->setCellValue('K'.$y, $area)
                 ->setCellValue('L'.$y, $exemple)
                 ->setCellValue('M'.$y, $c_tempor)
                 ->setCellValue('N'.$y, $observa1); 
     }

 //LA HOJA NUMERO 3 --------------------------------------------------------------------------------------------------------   
 $objPHPExcel->createSheet(2);
 $y = 1;
$objPHPExcel->setActiveSheetIndex(2)
->setCellValue("A".$y,'N°Ficha')
->setCellValue("B".$y,'Nombres')
->setCellValue("C".$y,'Apellido Paterno')
->setCellValue("D".$y,'Apellido Materno')
->setCellValue("E".$y,'RUT')
->setCellValue("F".$y,'Nacionalidad')
->setCellValue("G".$y,'Sexo')
->setCellValue("H".$y,'Fecha Nacimiento')
->setCellValue("I".$y,'Dirección')
->setCellValue("J".$y,'Comuna')
->setCellValue("K".$y,'Ciudad')
->setCellValue("L".$y,'Fono Contacto')
->setCellValue("M".$y,'Mail')
->setCellValue("N".$y,'Estado Civil')
->setCellValue("O".$y,'Contacto Emergencia')
->setCellValue("P".$y,'Parentesco Emergencia')
->setCellValue("Q".$y,'Fono Emergencia')
->setCellValue("R".$y,'Enfermedad Crónica')
->setCellValue("S".$y,'Indicar Cuál Enf. Crónica')
->setCellValue("T".$y,'Observaciones');

$objPHPExcel->getActiveSheet()
->getStyle('A1:T1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFEEEEEE');

$borders = array(
'borders' => array(
    'allborders' => array(
        'style' => PHPExcel_Style_BORDER::BORDER_THIN,
        'color' => array('argb' => '00000000'),
        )
    ),
);
$objPHPExcel->getActiveSheet()
->getStyle('A1:T1')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);


            $objPHPExcel->getActiveSheet()->setTitle('ENTIDAD_B');    
               //Fuente
               $objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
               $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
               //Tamaño deceldas
               $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
               $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10)->setAutoSize(true);
               $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10)->setAutoSize(true);
               
               $borders = array(
                   'borders' => array(
                       'allborders' => array(
                           'style' => PHPExcel_Style_BORDER::BORDER_THIN,
                           'color' => array('argb' => '00000000'),
                           )
                       ),
                   );
                   $objPHPExcel->getActiveSheet()
                           ->getStyle('A1:T1')
                           ->applyFromArray($borders);
               
                           $objPHPExcel->setActiveSheetIndex(2)
                   ->getStyle('A'.$y.":T".$y)
                   ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                   ->applyFromArray($borders);
               
                   if($t=='dia'){
                    $rs_ingresos2 = $conexion->query("SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga1' and ingresos_fecha_larga<'$fechalarga2'");
               
                   }else{
                   $rs_ingresos2 = $conexion->query(" SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga3' and ingresos_fecha_larga<'$fechalarga4'");
               }
                    $cont=0;
                    while ($row =  $rs_ingresos2->fetch_array(MYSQLI_ASSOC)) {
                        $cont++;
                        $n_ficha            =    strval($cont);
                       $nombre              =    $row['ingresos_nombre'];
                       $apellidop           =    $row['ingresos_apellidop'];
                       $Apellidom           =    $row['ingresos_apellidom'];
                       $rut                 =    $row['ingresos_rut'];
                       $nacionalidad        =    $row['ingresos_nacionalidad'];
                       $sexo                =    $row['ingresos_sexo'];
                       $nacimiento          =    DateTime::createFromFormat('Y-m-d', $row['ingresos_fecha_naci'])->format('d-m-Y');
                       $fono                =    $row['ingresos_fono'];
                       $direccion           =    $row['ingresos_direccion'];
                       $comuna              =    $row['ingresos_comuna'];
                       $ciudad              =    $row['ingresos_ciudad'];
                       $estado_civil        =    $row['ingresos_estado_civil'];
                       $correo              =    $row['ingresos_mail'];
                       $emerg_nombre        =    $row['ingresos_emergencia_nombre'];
                       $emerg_parentesco    =    $row['ingresos_emergencia_parentesco'];
                       $emerg_fono          =    $row['ingresos_emergencia_fono'];
                       $enfermedad          =    $row['ingresos_enfermedad'];
                       $enfermedad2         =    $row['ingresos_enfermedad_detalle'];
                       $observa2            =    $row['ingresos_observacion2'];
                        $y++;
                       // Bordes a celdas creadas porlaconsulta
                       $objPHPExcel->setActiveSheetIndex(2)
                           ->getStyle('A'.$y.":T".$y)
                           ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                           ->applyFromArray($borders);
               
                       // Mostramos los valores
                       $objPHPExcel->setActiveSheetIndex(2)
                                ->setCellValue('A'.$y, $n_ficha)
                                ->setCellValue('B'.$y, $nombre)
                                ->setCellValue('C'.$y, $apellidop)
                                ->setCellValue('D'.$y, $Apellidom)
                                ->setCellValue('E'.$y, $rut)
                                ->setCellValue('F'.$y, $nacionalidad)
                                ->setCellValue('G'.$y, $sexo)
                                ->setCellValue('H'.$y, $nacimiento)
                                ->setCellValue('I'.$y, $direccion)
                                ->setCellValue('J'.$y, $comuna)
                                ->setCellValue('K'.$y, $ciudad)
                                ->setCellValue('L'.$y, $fono)
                                ->setCellValue('M'.$y, $correo)
                                ->setCellValue('N'.$y, $estado_civil)
                                ->setCellValue('O'.$y, $emerg_nombre)
                                ->setCellValue('P'.$y, $emerg_parentesco)
                                ->setCellValue('Q'.$y, $emerg_fono)
                                ->setCellValue('R'.$y, $enfermedad)
                                ->setCellValue('S'.$y, $enfermedad2)
                                ->setCellValue('T'.$y, $observa2); 
                    }
            
 //----------------------LA HOJA NUMERO 4 --------------------------------------------------------------------------------------------------------   
 $objPHPExcel->createSheet(3);
 $y = 1;
$objPHPExcel->setActiveSheetIndex(3)
->setCellValue("A".$y,'N°Ficha')
->setCellValue("B".$y,'Previsión')
->setCellValue("C".$y,'Salud')
->setCellValue("D".$y,'Plan Salud(UF)')
->setCellValue("E".$y,'Plan Salud(%)')
->setCellValue("F".$y,'Plan Salud($)')
->setCellValue("G".$y,'Centro costo')
->setCellValue("H".$y,'Forma de Pago')
->setCellValue("I".$y,'Banco')
->setCellValue("J".$y,'Cta Banco')
->setCellValue("K".$y,'Sueldo Base')
->setCellValue("L".$y,'Horas Semana')
->setCellValue("M".$y,'Asig. Colacion')
->setCellValue("N".$y,'Asig. Movilización')
->setCellValue("O".$y,'Asig. Prop. días trab.')
->setCellValue("P".$y,'Anticipo Variable')
->setCellValue("Q".$y,'Monto Anticipo Fijo')
->setCellValue("R".$y,'Observaciones');

$objPHPExcel->getActiveSheet()
->getStyle('A1:R1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFEEEEEE');

$borders = array(
'borders' => array(
    'allborders' => array(
        'style' => PHPExcel_Style_BORDER::BORDER_THIN,
        'color' => array('argb' => '00000000'),
        )
    ),
);
$objPHPExcel->getActiveSheet()
->getStyle('A1:R1')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);


            $objPHPExcel->getActiveSheet()->setTitle('ENTIDAD_C'); 

              //Fuente
              $objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
              $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
              //Tamaño deceldas
              $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
              $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10)->setAutoSize(true);
              $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10)->setAutoSize(true);
              
              $borders = array(
                  'borders' => array(
                      'allborders' => array(
                          'style' => PHPExcel_Style_BORDER::BORDER_THIN,
                          'color' => array('argb' => '00000000'),
                          )
                      ),
                  );
                  $objPHPExcel->getActiveSheet()
                          ->getStyle('A1:R1')
                          ->applyFromArray($borders);
              
                          $objPHPExcel->setActiveSheetIndex(3)
                  ->getStyle('A'.$y.":R".$y)
                  ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                  ->applyFromArray($borders);
              
                  if($t=='dia'){
                    $rs_ingresos2 = $conexion->query("SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga1' and ingresos_fecha_larga<'$fechalarga2'");
               
                   }else{
                   $rs_ingresos2 = $conexion->query(" SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga3' and ingresos_fecha_larga<'$fechalarga4'");
               }
                   $cont=0;
                   while ($row =  $rs_ingresos2->fetch_array(MYSQLI_ASSOC)) {
                        $cont++;
                        $n_ficha         =    strval($cont);
                        $prevision       =    $row['ingresos_prevision'];
                        $salud           =    $row['ingresos_salud'];
                        $salud2          =    $row['ingresos_plan_saluduf'];
                        $salud3          =    $row['ingresos_plan_saludporc'];
                        $salud4          =    $row['ingresos_plan_saludpeso'];
                        $centro_costo    =    $row['ingresos_centro_costo'];
                        $sueldo          =    $row['ingresos_sueldo_base'];
                        $horas_semana    =    $row['ingresos_horas_semana'];
                        $forma_pago      =    $row['ingresos_forma_pago'];
                        $banco           =    $row['ingresos_banco'];
                        $cuenta          =    $row['ingresos_cta_banco'];
                        $asig_colacion   =    $row['ingresos_asig_colacion'];
                        $asig_movil      =    $row['ingresos_asig_movil'];
                        $prop_traba      =    $row['ingresos_prop_traba'];
                        $anticipo_var    =    $row['ingresos_anticipo_var'];
                        $anticipo_monto  =    $row['ingresos_anticipo_monto'];
                        $observa3        =    $row['ingresos_observacion3'];
                       $y++;
                      // Bordes a celdas creadas porlaconsulta
                      $objPHPExcel->setActiveSheetIndex(3)
                          ->getStyle('A'.$y.":R".$y)
                          ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                          ->applyFromArray($borders);
              
                      // Mostramos los valores
                      $objPHPExcel->setActiveSheetIndex(3)
                               ->setCellValue('A'.$y, $n_ficha)
                               ->setCellValue('B'.$y, $prevision)
                               ->setCellValue('C'.$y, $salud)
                               ->setCellValue('D'.$y, $salud2)
                               ->setCellValue('E'.$y, $salud3)
                               ->setCellValue('F'.$y, $salud4)
                               ->setCellValue('G'.$y, $centro_costo)
                               ->setCellValue('H'.$y, $forma_pago)
                               ->setCellValue('I'.$y, $banco)
                               ->setCellValue('J'.$y, $cuenta)
                               ->setCellValue('K'.$y, $sueldo)
                               ->setCellValue('L'.$y, $horas_semana)
                               ->setCellValue('M'.$y, $asig_colacion)
                               ->setCellValue('N'.$y, $asig_movil)
                               ->setCellValue('O'.$y, $prop_traba)
                               ->setCellValue('P'.$y, $anticipo_var)
                               ->setCellValue('Q'.$y, $anticipo_monto)
                               ->setCellValue('R'.$y, $observa3); 
                   }
           
             //----------------------LA HOJA NUMERO 4 --------------------------------------------------------------------------------------------------------   
 $objPHPExcel->createSheet(4);
 $y = 1;
$objPHPExcel->setActiveSheetIndex(4)
->setCellValue("A".$y,'N°Ficha')
->setCellValue("B".$y,'Estudios')
->setCellValue("C".$y,'Años Ex Empleador')
->setCellValue("D".$y,'Tipo Trabajador')
->setCellValue("E".$y,'Tope Gratif.')
->setCellValue("F".$y,'Sueldo Diario')
->setCellValue("G".$y,'Tipo Jornada')
->setCellValue("H".$y,'Incluye Sábado')
->setCellValue("I".$y,'Aplica Tarja')
->setCellValue("J".$y,'Observaciones');

$objPHPExcel->getActiveSheet()
->getStyle('A1:J1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('FFEEEEEE');

$borders = array(
'borders' => array(
    'allborders' => array(
        'style' => PHPExcel_Style_BORDER::BORDER_THIN,
        'color' => array('argb' => '00000000'),
        )
    ),
);
$objPHPExcel->getActiveSheet()
->getStyle('A1:J1')
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
->applyFromArray($borders);


            $objPHPExcel->getActiveSheet()->setTitle('ENTIDAD_D');   
                 //Fuente
                 $objPHPExcel->getDefaultStyle()->getfont()->setName("Arial");
                 $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
                 //Tamaño deceldas
                 $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10)->setAutoSize(true);
                 $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10)->setAutoSize(true);
            
                 
                 $borders = array(
                     'borders' => array(
                         'allborders' => array(
                             'style' => PHPExcel_Style_BORDER::BORDER_THIN,
                             'color' => array('argb' => '00000000'),
                             )
                         ),
                     );
                     $objPHPExcel->getActiveSheet()
                             ->getStyle('A1:J1')
                             ->applyFromArray($borders);
                 
                             $objPHPExcel->setActiveSheetIndex(3)
                     ->getStyle('A'.$y.":J".$y)
                     ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                     ->applyFromArray($borders);
                 
                     if($t=='dia'){
                        $rs_ingresos2 = $conexion->query("SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga1' and ingresos_fecha_larga<'$fechalarga2'");
                   
                       }else{
                       $rs_ingresos2 = $conexion->query(" SELECT * FROM ingresos where ingresos_empresa='$empresa' and ingresos_fecha_larga > '$fechalarga3' and ingresos_fecha_larga<'$fechalarga4'");
                   }
                      $cont=0;
                      while ($row =  $rs_ingresos2->fetch_array(MYSQLI_ASSOC)) {
                            $cont++;
                            $n_ficha        =    strval($cont);
                            $estudios       =    $row['ingresos_estudios'];
                            $anos_exemple   =    $row['ingresos_ano_exemple'];
                            $tipo_trabajador=    $row['ingresos_tipo_trabajador'];
                            $tope_gratif    =    $row['ingresos_tope_gratif'];
                            $sueldo_diario  =    $row['ingresos_sueldo_diario'];
                            $tipo_jornada   =    $row['ingresos_tipo_jornada'];
                            $sabados        =    $row['ingresos_sabado'];
                            $tarja          =    $row['ingresos_tarja'];
                            $observa4       =    $row['ingresos_observaciones4'];
                          $y++;
                         // Bordes a celdas creadas porlaconsulta
                         $objPHPExcel->setActiveSheetIndex(4)
                             ->getStyle('A'.$y.":J".$y)
                             ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                             ->applyFromArray($borders);
                 
                         // Mostramos los valores
                         $objPHPExcel->setActiveSheetIndex(4)
                                  ->setCellValue('A'.$y, $n_ficha)
                                  ->setCellValue('B'.$y, $estudios)
                                  ->setCellValue('C'.$y, $anos_exemple)
                                  ->setCellValue('D'.$y, $tipo_trabajador)
                                  ->setCellValue('E'.$y, $tope_gratif)
                                  ->setCellValue('F'.$y, $sueldo_diario)
                                  ->setCellValue('G'.$y, $tipo_jornada)
                                  ->setCellValue('H'.$y, $sabados)
                                  ->setCellValue('I'.$y, $tarja)
                                  ->setCellValue('J'.$y, $observa4); 
                      }    
 //--------------------------------------------------------------------------------

     $objPHPExcel->setActiveSheetIndex(0);
     $nombre="Content-Disposition: attachment;filename=Ficha Contratacion-'$empresa'-'$fecha_ficha'.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header($nombre);
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');


    return 1;
