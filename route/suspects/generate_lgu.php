<?php
session_start();
date_default_timezone_set('Asia/Manila');
require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../manager/DRCMSManager.php';

$sspcts = new Suspects();
$drcms = new DRCMSManager();

$province = $_GET['province'];
$data = $drcms->generateLGU($province);

echo json_encode($data);