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

if (isset($_GET['id'])) {
	$route = "route/suspects/update_suspect.php";
	$data = $drcms->findSuspect($_GET['id']);
	$id = $data['id'];
	$provinces = $drcms->generateProvince($data['region_c']);
	$lgus = $drcms->generateLGU($data['province_c']);
} else {
	if (!empty($filter_name)) {
		$data = $drcms->customfetch($filter_name);
	} elseif (!empty($filter_bdate)) {
		$bdate = new DateTime($filter_bdate);
		$data = $drcms->customfetch('', $bdate->format('Y-m-d'));
	} else {
		$data = $drcms->customfetch();
	}
}


