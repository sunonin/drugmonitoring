<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../manager/DRCMSManager.php';

$region = $_GET['region'] != 'null' ? $_GET['region'] : '';
$province = $_GET['province'] != 'null' ? $_GET['province'] : '';
$lgu = $_GET['lgu'] != 'null' ? $_GET['lgu'] : '';

$spcts = new Suspects();
$drcms = new DRCMSManager();

$suspects_data = $drcms->fetchStatisticsPopulation($region, $province, $lgu);

echo json_encode($suspects_data);