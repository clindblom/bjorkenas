<?php

	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');	
	
	if($dbConnected) {
		
		$editProjectId = $_POST['editProjectId'];
		$editProjectOrderNo = $_POST['editProjectOrderNo'];
		$editProjectAddress = $_POST['editProjectAddress'];
		$editProjectStartDate = $_POST['editProjectStartDate'];
		$editProjectCustomer = $_POST['customerID'];
		$editProjectDuration = $_POST['editProjectDuration'];
		$editProjectTrips = $_POST['editProjectTrips'];
		$editProjectUser = $_POST['userID'];
		$editProjectDescription = $_POST['editProjectDescription'];
		
		$project_SQLupdate = "UPDATE project SET project_order_nr='".$editProjectOrderNo."', ";
		$project_SQLupdate .= "project_address='".$editProjectAddress."', project_start_date='".$editProjectStartDate."', ";
		$project_SQLupdate .= "project_customer='".$editProjectCustomer."', project_duration='".$editProjectDuration."', ";
		$project_SQLupdate .= "project_trips='".$editProjectTrips."', project_user='".$editProjectUser."', ";
		$project_SQLupdate .= "project_description='".$editProjectDescription."' WHERE project_id='".$editProjectId."'";
		
		$project_SQLupdate_query = mysqli_query($dbConnected, $project_SQLupdate);

		header("Location: ../../index.php?content=handleProject");
	
	} else {
		return $dbSuccess;	
	}
?>