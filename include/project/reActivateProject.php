<?php
	$projectId = $_POST['projectID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {						
		
		$project_SQLupdate = "UPDATE project SET finished=0 WHERE project_id='".$projectId."'";
		
		$project_SQLupdate_query = mysqli_query($dbConnected, $project_SQLupdate);			

		header("Location: ../../index.php?content=completedProjects");
	
	} else {
		return $dbSuccess;		
	}

?>