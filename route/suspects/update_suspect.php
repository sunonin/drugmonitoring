<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../model/StatusChange.php';
require '../../model/LGUInformation.php';
require '../../manager/DRCMSManager.php';

$sspcts = new Suspects();
$sc = new StatusChange();
$lgui = new LGUInformation();
$drcms = new DRCMSManager();

$date = new DateTime($_POST['birthdate']);
$date = $date->format('Y-m-d');
$id = $_POST['suspect_id'];

$data = [
	'id'			=> $id,
	'lastname'		=> isset($_POST['lastname']) ? $_POST['lastname'] : '',
	'firstname'		=> isset($_POST['firstname']) ? $_POST['firstname'] : '',
	'middlename'	=> isset($_POST['middlename']) ? $_POST['middlename'] : '',
	'gender'		=> isset($_POST['gender']) ? $_POST['gender'] : '',
	'contact_no'	=> isset($_POST['contact_no']) ? $_POST['contact_no'] : '',
	'street'		=> isset($_POST['street']) ? $_POST['street'] : '',
	'region'		=> isset($_POST['region']) ? $_POST['region'] : '',
	'province'		=> isset($_POST['province']) ? $_POST['province'] : '',
	'lgu'			=> isset($_POST['lgu']) ? $_POST['lgu'] : '',
	'current_status'		=> isset($_POST['status']) ? $_POST['status'] : '',
	'prev_status'	=> isset($_POST['prev_status']) ? $_POST['prev_status'] : '',
	'birthdate'		=> $date,
];

$lguinfo = $drcms->findLGUInfo($data);
$last_id = $sspcts->update($data);
$sc->update($data);

if ($data['current_status'] != $data['prev_status']) {
	if ($data['current_status'] != 'Deceased') {
		$population = $lguinfo['population'] + 1;
	} else {
		$population = $lguinfo['population'] - 1;
	}

	$lgui->update($lguinfo['id'], $population);
}

$_SESSION['alert'] = $drcms->addFlash('success', 'Suspect has been updated successfully.');

header('location:../../edit_suspect.php?id='.$id);
