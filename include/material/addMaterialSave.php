<?php
	
	$projectId = $_POST['saveMaterialprojectID'];
	$materialId = $_POST['addMaterialDd'];
	$quantity = $_POST['quantityMaterial'];

	saveMaterial($projectId, $materialId, $quantity);

	function saveMaterial($id, $materialId, $quantity) {

		include('../../config/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {		
			$material_used_SQLselect = "SELECT * FROM material_used WHERE project_id='".$id."'";
			$material_used_SQLselect_Query = mysqli_query($dbConnected, $material_used_SQLselect);
			
			$dbMaterialId = array(0 => 0);			
			$dbQuantity = array(0 => 0);
			
			while($rowMaterialUsed = mysqli_fetch_array($material_used_SQLselect_Query, MYSQLI_ASSOC)) {
				array_push($dbMaterialId, $rowMaterialUsed['material']);
				array_push($dbQuantity, $rowMaterialUsed['quantity']);
			}
			
			if($key = array_search($materialId, $dbMaterialId)) {
			
				$quantity = $quantity + $dbQuantity[$key];
					
				$material_SQLupdate = "UPDATE material_used SET quantity='".$quantity."' WHERE material='".$dbMaterialId[$key]."'";
				
				$material_SQLupdate_query = mysqli_query($dbConnected, $material_SQLupdate);
				
			} else {
			
				$material_SQLinsert = "INSERT INTO material_used (project_id, material, quantity)";
				$material_SQLinsert .= "VALUES ('".$id."', '".$materialId."', '".$quantity."')";
				
				$material_SQLinsert_query = mysqli_query($dbConnected, $material_SQLinsert);
					
			}
						

			header("Location: ../../index.php?content=showMaterial&aMprojectID=".$id);
		
		} else {
			return $dbSuccess;
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}
		
	}
?>