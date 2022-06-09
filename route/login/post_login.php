<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Users.php';
require '../../manager/DRCMSManager.php';

$users = new Users();
$drcms = new DRCMSManager();

$uname = $_POST['username'];
$pword = $_POST['password'];

$data = $users->getUser($uname, $pword);

if (!empty($data)) {
	$_SESSION['currentuser'] = $data;

	$_SESSION['currentuser']['profile'] = 'public/_images/logo.png';

	$path = '../suspects.php';
	$type = 'success';
	$msg = 'Login Successful.';
} else {
	unset($_SESSION['currentuser']);
	$path = '../index.php';
	$type = 'warning';
	$msg = 'Default credentials admin, admin';
}

$_SESSION['alert'] = $drcms->addFlash($type, $msg);

header('location:../'.$path);