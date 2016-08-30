<?php
	$projectId = $_POST['projectID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {						
		
		$project_SQLdelete = "DELETE FROM project WHERE project_id='".$projectId."'";
		
		$project_SQLdelete_query = mysqli_query($dbConnected, $project_SQLdelete);			

		header("Location: ../../index.php?content=completedProjects");
	
	} else {
		return $dbSuccess;		
	}

?>