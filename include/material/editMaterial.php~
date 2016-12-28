<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$materialId = @$_GET['materialID'];
		
		$material_SQLselect = 'SELECT * FROM material WHERE material_id="'.$materialId.'"';
		$material_SQLselect_Query = mysqli_query($dbConnected, $material_SQLselect); 	
	
		echo '<h2>Ändra information om material</h2>';
		$row = mysqli_fetch_array($material_SQLselect_Query, MYSQL_ASSOC);

		$id = $row['material_id'];
		$name = $row['article_name'];
		$number = $row['article_number'];
		$cost = $row['article_cost'];	
		
		
		echo '<form name="editMaterialForm" action="include/material/editMaterialFunction.php" method="post">
					  <input name="editMaterialId" type="hidden" value="'.$id.'">
					  <div class="form-group">
					    <label for="editMaterialName">Artikel-namn</label>
					    <input type="text" class="form-control" id="editMaterialName" name="editMaterialName" value="'.$name.'">
					  </div>
					  <div class="form-group">
					    <label for="editMaterialNumber">Artikel-nummer</label>
					    <input type="text" class="form-control" id="editMaterialNumber" name="editMaterialNumber" value="'.$number.'">
					  </div>
					  <div class="form-group">
					    <label for="editMaterialCost">Pris</label>
					    <input type="text" class="form-control" id="editMaterialCost" name="editMaterialCost" value="'.$cost.'">
					  </div>
					 
					  <input class="btn btn-default" id="editMaterialSubmit" name="editMaterialSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
				</form>';
		echo '<form name="cancelMaterialEdit" action="index.php" method="get">
					  <input name="content" type="hidden" value="handleMaterial">
					  <input class="btn btn-default" name="cancelMaterialEditSubmit" type="submit" value="Avbryt">
			  </form>';
			  
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>