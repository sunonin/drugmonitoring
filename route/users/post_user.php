<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Users.php';
require '../../manager/RIMSManager.php';

$user = new Users();
$rims = new RIMSManager();

$data = [
	'user_type'	=> isset($_POST['user_type']) ? $_POST['user_type'] : '',
	'fullname'	=> isset($_POST['fullname']) ? $_POST['fullname'] : '',
	'position'	=> isset($_POST['position']) ? $_POST['position'] : '',
	'username'	=> isset($_POST['uname']) ? $_POST['uname'] : '',
	'password'	=> isset($_POST['password']) ? $_POST['password'] : '',
	'status'	=> isset($_POST['user_status']) ? 'active' : 'inactive'
];

$last_id = $user->insert($data);

$uploads = $_FILES['file'];

if ($uploads['size'] > 0) {
    $user->removePicture($last_id);
	$profilepic = $user->insertPicture($uploads, $last_id);
}

$_SESSION['alert'] = $rims->addFlash('success', 'User has been created successfully.');

header('location:../../user_edit.php?id='.$last_id);
