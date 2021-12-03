<?php 
	session_start();
	require_once("../models/user.php");
	$user = new User();
	$user->setOnlineStatusToZero();
	session_destroy();
	header("location:../../../index.php");