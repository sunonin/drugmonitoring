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

$suspects_data = $drcms->fetchStatisticsPopulation($region, $province, $lgu);

$phpExcel = new PHPExcel;

$phpExcel->getProperties()->setTitle("Ratio per status against population");
$phpExcel->getProperties()->setCreator("Official Personnel");
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet();
$sheet->setTitle('masterlist');

// Creating spreadsheet header
$sheet->getStyle('A1:R1')->getFont('Arial Black')->setBold(true)->setSize(11);
$sheet->getCell('A1')->setValue('RATIO PER STATUS AGAINST POPULATION');
$sheet->getCell('A3')->setValue('REGION');
$sheet->getCell('B3')->setValue('PROVINCE');
$sheet->getCell('C3')->setValue('LGU');
$sheet->getCell('D3')->setValue('POPULATION');
$sheet->getCell('E3')->setValue('UNDER INVESTIGATION');
$sheet->getCell('F3')->setValue('SURRENDERED');
$sheet->getCell('G3')->setValue('APPREHENDED');
$sheet->getCell('H3')->setValue('ESCAPED');
$sheet->getCell('I3')->setValue('DECEASED');
$sheet->getStyle('A3:L3')->getAlignment()->setWrapText(true); 

$i = 4;
$x = 1;

foreach ($suspects_data as $id => $dd) {
	$sheet->getCell('A'.$i)->setValue($dd['region']);
	$sheet->getCell('B'.$i)->setValue($dd['province']);
	$sheet->getCell('C'.$i)->setValue($dd['lgu']);
	$sheet->getCell('D'.$i)->setValue($dd['population']);
	$sheet->getCell('E'.$i)->setValue($dd['uiv']);
	$sheet->getCell('F'.$i)->setValue($dd['sur']);
	$sheet->getCell('G'.$i)->setValue($dd['apr']);
	$sheet->getCell('H'.$i)->setValue($dd['esc']);
	$sheet->getCell('I'.$i)->setValue($dd['decs']);

	$i++;
	$x++;
}

header('Content-type: application/vnd.ms-excel');
$filename = 'Masterlist-Report.xls';
header('Content-Disposition: attachment; filename="'.$filename.'"');
$writer->save('php://output');