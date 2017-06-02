<?php
	
	include('../../config/Mobile_Detect.php');
	$detect = new Mobile_Detect();

	$user = $_COOKIE['userID'];
	
	$week = $_POST['week'];
	$year = $_POST['year'];

	$Add = 1;

	if ($detect->isMobile()) {
		header("Location: ../../index.php?content=chosenWeekMobile&Add=".$Add."&selectedWeek=".$week."&selectedYear=".$year);
	} else {
		header("Location: ../../index.php?content=chosenWeek&Add=".$Add."&selectedWeek=".$week."&selectedYear=".$year);
	}

?>