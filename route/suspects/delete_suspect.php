<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Suspects.php';
require '../../manager/DRCMSManager.php';

$suspect = new Suspects();
$drcms = new DRCMSManager();
$id = $_GET['id'];

$suspect->delete($id);

$_SESSION['alert'] = $drcms->addFlash('success', 'Suspect has been deleted successfully.');

header('location:../../suspects.php');

