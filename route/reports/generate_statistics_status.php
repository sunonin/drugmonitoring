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

$suspects_data = $drcms->fetchSuspectsByStatus($region, $province, $lgu);

$phpExcel = new PHPExcel;

$phpExcel->getProperties()->setTitle("Masterlist of Personal Information");
$phpExcel->getProperties()->setCreator("Official Personnel");
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet();
$sheet->setTitle('masterlist');

// Creating spreadsheet header
$sheet->getStyle('A1:R1')->getFont('Arial Black')->setBold(true)->setSize(11);
$sheet->getCell('A1')->setValue('TOTAL NUMBER OF ENCODED PERSONAL INFORMATION BY STATUS');
$sheet->getCell('A3')->setValue('REGION');
$sheet->getCell('B3')->setValue('PROVINCE');
$sheet->getCell('C3')->setValue('LGU');
$sheet->getCell('D3')->setValue('STATUS');
$sheet->getCell('E3')->setValue('HEAD_COUNT');
$sheet->getStyle('A3:L3')->getAlignment()->setWrapText(true); 

$i = 4;
$x = 1;

foreach ($suspects_data as $id => $dd) {
	$sheet->getCell('A'.$i)->setValue($dd['region']);
	$sheet->getCell('B'.$i)->setValue($dd['province']);
	$sheet->getCell('C'.$i)->setValue($dd['lgu']);
	$sheet->getCell('D'.$i)->setValue($dd['current_status']);
	$sheet->getCell('E'.$i)->setValue($dd['head_count']);

	$i++;
	$x++;
}

header('Content-type: application/vnd.ms-excel');
$filename = 'Statistics-Status-Report.xls';
header('Content-Disposition: attachment; filename="'.$filename.'"');
$writer->save('php://output');