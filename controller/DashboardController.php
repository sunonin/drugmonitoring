<?php
require_once 'model/Connection.php';
require_once 'model/Users.php';
require_once 'manager/DRCMSManager.php';

$rims = new DRCMSManager();
$user = new Users();

$userid = $_SESSION['currentuser']['id'];

$data = $user->find($userid);

 