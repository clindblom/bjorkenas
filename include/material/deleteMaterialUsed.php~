<?php
	$materialId = $_POST['materialUsedID'];
	$projectId = $_POST['projectDMUID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {						
		
		$material_SQLdelete = "DELETE FROM material_used WHERE material_used_id='".$materialId."'";
		
		$material_SQLdelete_query = mysqli_query($dbConnected, $material_SQLdelete);			

		header("Location: ../../index.php?content=showMaterial&aMprojectID=".$projectId);
	
	} else {
		return $dbSuccess;		
	}

?>