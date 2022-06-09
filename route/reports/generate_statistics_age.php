<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../library/PHPExcel-1.8/Classes/PHPExcel.php';
require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../manager/DRCMSManager.php';

$region = $_GET['region'] != 'null' ? $_GET['region'] : '';
$province = $_GET['province'] != 'null' ? $_GET['province'] : '';
$lgu = $_GET['lgu'] != 'null' ? $_GET['lgu'] : '';

$spcts = new Suspects();
$drcms = new DRCMSManager();

$suspects_data = $drcms->fetchStatisticsAge($region, $province, $lgu);

$phpExcel = new PHPExcel;

$phpExcel->getProperties()->setTitle("Disaggregate by age bracket (0-12, 13-18,19-
25, 26-35, 36-50, 51-65, 66 and above)");
$phpExcel->getProperties()->setCreator("Official Personnel");
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet();
$sheet->setTitle('masterlist');

// Creating spreadsheet header
$sheet->getStyle('A1:R1')->getFont('Arial Black')->setBold(true)->setSize(11);
$sheet->getCell('A1')->setValue('DISAGGREGATE BY AGE BRACKET');
$sheet->getCell('A3')->setValue('REGION');
$sheet->getCell('B3')->setValue('PROVINCE');
$sheet->getCell('C3')->setValue('LGU');
$sheet->getCell('D3')->setValue('AGE (0-12)');
$sheet->getCell('E3')->setValue('AGE (13-18)');
$sheet->getCell('F3')->setValue('AGE (19-25)');
$sheet->getCell('G3')->setValue('AGE (26-35)');
$sheet->getCell('H3')->setValue('AGE (36-50)');
$sheet->getCell('I3')->setValue('AGE (51-65)');
$sheet->getCell('J3')->setValue('AGE (66 AND ABOVE)');
$sheet->getStyle('A3:L3')->getAlignment()->setWrapText(true); 

$i = 4;
$x = 1;

foreach ($suspects_data as $id => $dd) {
	$sheet->getCell('A'.$i)->setValue($dd['region']);
	$sheet->getCell('B'.$i)->setValue($dd['province']);
	$sheet->getCell('C'.$i)->setValue($dd['lgu']);
	$sheet->getCell('D'.$i)->setValue($dd['bracket1']);
	$sheet->getCell('E'.$i)->setValue($dd['bracket2']);
	$sheet->getCell('F'.$i)->setValue($dd['bracket3']);
	$sheet->getCell('G'.$i)->setValue($dd['bracket4']);
	$sheet->getCell('H'.$i)->setValue($dd['bracket5']);
	$sheet->getCell('I'.$i)->setValue($dd['bracket6']);
	$sheet->getCell('J'.$i)->setValue($dd['bracket7']);

	$i++;
	$x++;
}

header('Content-type: application/vnd.ms-excel');
$filename = 'Masterlist-Report.xls';
header('Content-Disposition: attachment; filename="'.$filename.'"');
$writer->save('php://output');