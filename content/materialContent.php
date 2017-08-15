<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$sorting = @$_GET['sort'];

		if($sorting == "article") {
			$material_SQLselect = "SELECT * FROM material ORDER BY article_name";
		} else if ($sorting == "articleNo") {
			$material_SQLselect = "SELECT * FROM material ORDER BY article_number";
		} else if ($sorting == "price") {
			$material_SQLselect = "SELECT * FROM material ORDER BY article_cost";
		} else {
			$material_SQLselect = "SELECT * FROM material";
		}
		
		$material_SQLselect_Query = mysqli_query($dbConnected, $material_SQLselect); 	
	
		if ($detect->isMobile()) {
			echo '<style>#materialLink {background: #A0A0A0;}</style>';
		} else {
			echo '<style>#materialLink {background: black;}</style>';
		}
		
		echo '<h2>Material</h2>';
		echo '<form id="createMaterialForm" name="createMaterialForm" action="index.php" method="get">
					<input type="hidden" name="content" value="newMaterial">
					<input class="btn btn-default" type="submit"  value="Lägg till material" />
				</form>';
		echo '<table class="table" id="materialTable">';	
	
		echo '<thead>';
			echo '<tr>';
				echo '<th><a href="index.php?content=handleMaterial&sort=article" style="color:black;'; if(@$_GET['sort'] == 'article') {echo 'text-decoration:underline;';} echo '">Artikel</a></th>';
				echo '<th><a href="index.php?content=handleMaterial&sort=articleNo" style="color:black;'; if(@$_GET['sort'] == 'articleNo') {echo 'text-decoration:underline;';} echo '">Artikel-nummer</a></th>';
				echo '<th><a href="index.php?content=handleMaterial&sort=price" style="color:black;'; if(@$_GET['sort'] == 'price') {echo 'text-decoration:underline;';} echo '">Pris</a></th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($row = mysqli_fetch_array($material_SQLselect_Query, MYSQLI_ASSOC)) {
			
			$id = $row['material_id'];
			$name = $row['article_name'];
			$number = $row['article_number'];
			$cost = $row['article_cost'];		
			
			echo '<tr>';
				 
				echo '<td>'.$name.'</td>'; 
				echo '<td>'.$number.'</td>';
				echo '<td>'.$cost.'</td>';
				echo '<td>
							<form name="editMaterialForm" action="index.php" method="get">
								<input type="hidden" name="content" value="editMaterial">
								<input type="hidden" name="materialID" value="'.$id.'">
								<input class="btn btn-default" type="submit" value="Ändra">
							</form>
						</td>';
				echo '<td>
							<form name="deleteMaterialForm" action="include/material/deleteMaterial.php" method="post">
								<input type="hidden" name="materialID" value="'.$id.'">
								<input type="hidden" name="materialAN" value="'.$number.'">
								<input class="btn btn-default" type="submit" value="Radera" onclick="return confirm(\'Är du säker?\')">
							</form>
						</td>';
			echo '</tr>';
		
		}
		echo '</tbody>';
		echo '</table>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>