<?php

	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');	
	
	if($dbConnected) {
		
		$editMaterialId = $_POST['editMaterialId'];
		$editMaterialName = $_POST['editMaterialName'];
		$editMaterialNumber = $_POST['editMaterialNumber'];
		$editMaterialCost = $_POST['editMaterialCost'];
		
		$material_SQLupdate = "UPDATE material SET article_name='".$editMaterialName."', ";
		$material_SQLupdate .= "article_number='".$editMaterialNumber."', article_cost='".$editMaterialCost."'";
		$material_SQLupdate .= " WHERE material_id='".$editMaterialId."'";
		
		$material_SQLupdate_query = mysqli_query($dbConnected, $material_SQLupdate);

		header("Location: ../../index.php?content=handleMaterial");
	
	} else {
		return $dbSuccess;	
	}
?>