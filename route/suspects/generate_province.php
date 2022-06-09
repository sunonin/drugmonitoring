<?php
session_start();
date_default_timezone_set('Asia/Manila');
require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../manager/DRCMSManager.php';

$sspcts = new Suspects();
$drcms = new DRCMSManager();

$region = $_GET['region'];
$data = $drcms->generateProvince($region);

echo json_encode($data);