<?php 
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// le CSV
$objReader = PHPExcel_IOFactory::createReader('CSV')->setDelimiter(',')
                                                    ->setEnclosure('"')
                                                    ->setLineEnding("\r\n")
                                                    ->setSheetIndex(0);
$objPHPExcelFromCSV = $objReader->load(str_replace('.php', '.csv', __FILE__));

// da saida


$objWriter2007 = PHPExcel_IOFactory::createWriter($objPHPExcelFromCSV, 'Excel2007');
$objWriter2007->save(str_replace('.php', '.xlsx', __FILE__));

?>
<a href="inscricoes-imprensa.xlsx">baixar arquivo</a>