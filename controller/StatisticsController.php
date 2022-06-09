<?php
require_once 'model/Connection.php';
require_once 'model/Suspects.php';
require_once 'manager/DRCMSManager.php';

$spcts = new Suspects();
$drcms = new DRCMSManager();
$filter_name = isset($_GET['name']) ? $_GET['name'] : '';
$filter_bdate = isset($_GET['bdate']) ? $_GET['bdate'] : '';
$id = '';
$route = "route/suspects/post_suspect.php";
$regions = $drcms->generateRegions();
$data = $drcms->fetchStatisticsStatus();
$population = $drcms->fetchStatisticsPopulation();
$age_bracket = $drcms->fetchStatisticsAge();


