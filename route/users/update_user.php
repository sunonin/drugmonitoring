<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Users.php';
require '../../manager/RIMSManager.php';

$user = new Users();
$rims = new RIMSManager();

$user_id = $_POST['user_id'];
$username = $_POST['uname'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$uploads = $_FILES['file'];

if ($password == $confirm_password) {
	$data = [
		'id'		=> $user_id,
		'user_type'	=> isset($_POST['user_type']) ? $_POST['user_type'] : '',
		'fullname'	=> isset($_POST['fullname']) ? $_POST['fullname'] : '',
		'position'	=> isset($_POST['position']) ? $_POST['position'] : '',	
		'status'	=> isset($_POST['user_status']) ? 'active' : 'inactive'
	];

	$user->update($data);

	if ($uploads['size'] > 0) {
	    $user->removePicture($user_id);
		$profilepic = $user->insertPicture($uploads, $user_id);
	}

	if (!empty($password) AND !empty($confirm_password)) {
		$user->updatePassword($user_id, $username, $password);
	}

	$type = 'success';
	$msg = 'Login Successful.';

} else {
	$type = 'warning';
	$msg = 'Either incorrect username and password or account has not been approved.';
}

$_SESSION['alert'] = $rims->addFlash($type, $msg);

header('location:../../user_edit.php?id='.$user_id);
