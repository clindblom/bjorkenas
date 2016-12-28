<?php
	$materialId = $_POST['materialID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {						
		
		$material_SQLdelete = "DELETE FROM material WHERE material_id='".$materialId."'";
		$material_SQLdelete_query = mysqli_query($dbConnected, $material_SQLdelete);
		
		$materialUsed_SQLdelete = "DELETE FROM material_used WHERE material='".$materialId."'";
		$materialUsed_SQLdelete_query = mysqli_query($dbConnected, $materialUsed_SQLdelete);

		header("Location: ../../index.php?content=handleMaterial");
	
	} else {
		return $dbSuccess;		
	}

?>