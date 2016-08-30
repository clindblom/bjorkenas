<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		include('addMaterialFunction.php');
		$material = materialDropdown('');
		
		$addMaterialProjectId = @$_GET['aMprojectID'];
		
		$project_SQLselect = "SELECT project_order_nr FROM project WHERE project_id='".$addMaterialProjectId."'";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		
		$projectRow = mysqli_fetch_array($project_SQLselect_Query, MYSQL_ASSOC);

		$projectOrderNo = $projectRow['project_order_nr'];
	
		echo '<h2>Lägg till material</h2>';
		echo '<h3>Projekt nr '.$projectOrderNo.'</h3>';
		
		echo '<form name="addMaterialForm" action="include/material/addMaterialSave.php" method="post">
					  <input name="saveMaterialprojectID" type="hidden" value="'.$addMaterialProjectId.'">
					  <div class="form-group">
					    <label for="addMaterial">Material</label>
					    '.$material.'
					  </div>
					  <div class="form-group">
					    <label for="quantityMaterial">Mängd</label>
					    <input type="number" class="form-control" id="quantityMaterial" name="quantityMaterial" min="0" max="10000" step="1">
					  </div>
					  <input class="btn btn-default" id="addMaterialSubmit" name="addMaterialSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
				</form>';
		echo 	'<form name="cancelAddMaterial" action="index.php" method="get">
						<input name="content" type="hidden" value="showMaterial">
						<input name="aMprojectID" type="hidden" value="'.$addMaterialProjectId.'">
						<input class="btn btn-default" name="cancelAddMaterialSubmit" type="submit" value="Avbryt">
				</form>';
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>