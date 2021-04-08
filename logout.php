<?php
session_start();
require_once './classes/user.php';
$objUser = new User();
// remove all session variables
session_destroy();
$objUser->redirect('index.php');
?>