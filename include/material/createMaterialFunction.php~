<?php
	
	$newMaterialName = $_POST['newMaterialName'];
	$newMaterialNumber = $_POST['newMaterialNumber'];
	$newMaterialCost = $_POST['newMaterialCost'];
	
	createUser($newMaterialName, $newMaterialNumber, $newMaterialCost);


	function createUser($name, $number, $cost) {

		include('../../config/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {						
			
			$material_SQLinsert = "INSERT INTO material (article_name, article_number, article_cost)";
			$material_SQLinsert .= "VALUES ('".$name."', '".$number."', '".$cost."') ";
			
			$material_SQLinsert_query = mysqli_query($dbConnected, $material_SQLinsert);			

			header("Location: ../../index.php?content=handleMaterial");
		
		} else {
			return $dbSuccess;
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}
		
	}
?>