<?php

	$user = $_COOKIE['userID'];
	
	$week = $_POST['week'];
	$year = $_POST['year'];

	$Add = 1;

	header("Location: ../../index.php?content=chosenWeek&Add=".$Add."&selectedWeek=".$week."&selectedYear=".$year);

?>