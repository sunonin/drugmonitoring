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

$suspects_data = $drcms->fetchSuspects($region, $province, $lgu);

$phpExcel = new PHPExcel;

$phpExcel->getProperties()->setTitle("Masterlist of Personal Information");
$phpExcel->getProperties()->setCreator("Official Personnel");
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet();
$sheet->setTitle('masterlist');

// Creating spreadsheet header
$sheet->getStyle('A1:R1')->getFont('Arial Black')->setBold(true)->setSize(11);
$sheet->getCell('A1')->setValue('MASTERLIST OF PERSONAL INFORMATION');
$sheet->getCell('A3')->setValue('NAME');
$sheet->getCell('B3')->setValue('GENDER');
$sheet->getCell('C3')->setValue('BIRTHDATE');
$sheet->getCell('D3')->setValue('AGE');
$sheet->getCell('E3')->setValue('STREET');
$sheet->getCell('F3')->setValue('LGU');
$sheet->getCell('G3')->setValue('PROVINCE');
$sheet->getCell('H3')->setValue('REGION');
$sheet->getCell('I3')->setValue('CONTACT #');
$sheet->getCell('J3')->setValue('STATUS');
$sheet->getStyle('A3:L3')->getAlignment()->setWrapText(true); 

$i = 4;
$x = 1;

foreach ($suspects_data as $id => $dd) {
	$sheet->getCell('A'.$i)->setValue($dd['name']);
	$sheet->getCell('B'.$i)->setValue($dd['gender']);
	$sheet->getCell('C'.$i)->setValue($dd['birthdate']);
	$sheet->getCell('D'.$i)->setValue($dd['age']);
	$sheet->getCell('E'.$i)->setValue($dd['street']);
	$sheet->getCell('F'.$i)->setValue($dd['lgu']);
	$sheet->getCell('G'.$i)->setValue($dd['province']);
	$sheet->getCell('H'.$i)->setValue($dd['region']);
	$sheet->getCell('I'.$i)->setValue($dd['contact_no']);
	$sheet->getCell('J'.$i)->setValue($dd['status']);

	$i++;
	$x++;
}

header('Content-type: application/vnd.ms-excel');
$filename = 'Masterlist-Report.xls';
header('Content-Disposition: attachment; filename="'.$filename.'"');
$writer->save('php://output');