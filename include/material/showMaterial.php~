<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		$projectId = $_GET['aMprojectID'];
		$showOnly = @$_GET['showOnly'];
		
		$totalCost = 0;
		
		$project_SQLselect = "SELECT project_order_nr FROM project WHERE project_id='".$projectId."'";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		$projectRow = mysqli_fetch_array($project_SQLselect_Query, MYSQL_ASSOC);
		$projectOrderNo = $projectRow['project_order_nr'];
		
		$material_used_SQLselect = "SELECT * FROM material_used WHERE project_id='".$projectId."'";
		$material_used_SQLselect_Query = mysqli_query($dbConnected, $material_used_SQLselect); 	
	
		echo '<h2>Material till projekt '.$projectOrderNo.'</h2>';
		if($showOnly == false) {
			echo '<form id="addMaterialForm" name="addMaterialForm" action="index.php" method="get">
						<input type="hidden" name="content" value="addMaterial">
						<input type="hidden" name="aMprojectID" value="'.$projectId.'">
						<input class="btn btn-default" type="submit"  value="Lägg till material" />
					</form>';
		}
		echo '<table class="table" id="showMaterialTable">';	
	
		echo '<thead>';
			echo '<tr>';
				echo '<th>Artikel</th>'; 
				echo '<th>Artikel-nummer</th>';
				echo '<th>Kvantitet</th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($rowMaterialUsed = mysqli_fetch_array($material_used_SQLselect_Query, MYSQL_ASSOC)) {
			
			$materialUsedId = $rowMaterialUsed['material_used_id'];
			$materialId = $rowMaterialUsed['material'];
			$quantity = $rowMaterialUsed['quantity'];
			
			$material_SQLselect = "SELECT * FROM material WHERE material_id='".$materialId."'";
			$material_SQLselect_Query = mysqli_query($dbConnected, $material_SQLselect);			
			
			while($rowMaterial = mysqli_fetch_array($material_SQLselect_Query, MYSQL_ASSOC)) {
				
				$materialName = $rowMaterial['article_name'];
				$materialNumber = $rowMaterial['article_number'];
				$materialCost = $rowMaterial['article_cost'];
							
				echo '<tr>';
					
					echo '<td>'.$materialName.'</td>'; 
					echo '<td>'.$materialNumber.'</td>'; 
					echo '<td>'.$quantity.'</td>';
					if($showOnly == false) {
						echo '<td>
									<form name="deleteMaterialForm" action="include/material/deleteMaterialUsed.php" method="post">
										<input type="hidden" name="materialUsedID" value="'.$materialUsedId.'">
										<input type="hidden" name="projectDMUID" value="'.$projectId.'">
										<input class="btn btn-default" type="submit" value="Radera" onclick="return confirm(\'Är du säker?\')">
									</form>
								</td>';
					}
				echo '</tr>';
				
				$totalCost = $totalCost + ($quantity * $materialCost);
			}
		}
		
		echo '<tr>
					<td>
						Total kostnad:
					</td>
					<td>
						'.$totalCost.' kr
					</td>
				</tr>';
		if($showOnly == false) {
			echo '<tr>
						<td>
							<form name="returnProjectForm" action="index.php" method="get">
								<input type="hidden" name="content" value="handleProject">
								<input class="btn btn-default" type="submit" value="Ok">
							</form>
						</td>
					</tr>';
		} elseif($showOnly == true) {
			if($_GET['pP'] == 'cI') {
				echo '<tr>
					<td>
						<form name="returnProjectForm" action="index.php" method="get">
							<input type="hidden" name="content" value="createInvoice">
							<input class="btn btn-default" type="submit" value="Ok">
						</form>
					</td>
				</tr>';
			} elseif ($_GET['pP'] == 'cP') {
				echo '<tr>
					<td>
						<form name="returnProjectForm" action="index.php" method="get">
							<input type="hidden" name="content" value="completedProjects">
							<input class="btn btn-default" type="submit" value="Ok">
						</form>
					</td>
				</tr>';
			}
		}
		echo '</tbody>';
		echo '</table>';


	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>