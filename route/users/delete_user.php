<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../model/Connection.php';
require '../../model/Users.php';
require '../../manager/RIMSManager.php';

$user = new Users();
$rims = new RIMSManager();
$id = $_GET['id'];

$user->delete($id);

$_SESSION['alert'] = $rims->addFlash('success', 'User has been deleted successfully.');

header('location:../../users.php');

