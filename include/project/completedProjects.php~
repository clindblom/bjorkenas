<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$showOnly = true;		
		
		$project_SQLselect = "SELECT * FROM project";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect); 	
	
		if ($detect->isMobile()) {
			echo '<style>#cPLink {background: #A0A0A0;}</style>';
		} else {
			echo '<style>#cPLink {background: black;}</style>';
		}
		
		echo '<style>#cPLink {background: black;}</style>';
		echo '<h2>Avslutade projekt</h2>';
		echo '<table class="table" id="projectTable">';	
		
		echo '<thead>';
			echo '<tr>';
				echo '<th>Arbetsorder</th>'; 
				echo '<th>Adress</th>'; 
				echo '<th>Startdatum</th>';
				echo '<th>Kund</th>';
				echo '<th>Tid</th>';
				echo '<th>Resor</th>';
				echo '<th>Utfört av</th>';
				echo '<th>Beskrivning</th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($row = mysqli_fetch_array($project_SQLselect_Query, MYSQL_ASSOC)) {
			
			$id = $row['project_id'];
			$orderNo = $row['project_order_nr'];
			$address = $row['project_address'];
			$startDate = $row['project_start_date'];
			$customer = $row['project_customer'];
			$duration = $row['project_duration'];	
			$trips = $row['project_trips'];	
			$user = $row['project_user'];	
			$description = $row['project_description'];
			$projectFinished = $row['finished'];
			
			$customersArray = unserialize(@$_COOKIE['customers']);
			$usersArray = unserialize(@$_COOKIE['users']);
			
			if($projectFinished == true) {
				echo '<tr>';
					
					echo '<td>'.$orderNo.'</td>'; 
					echo '<td>'.$address.'</td>'; 
					echo '<td>'.$startDate.'</td>';
					echo '<td>'.$customersArray[$customer].'</td>';
					echo '<td>'.$duration.'</td>';
					echo '<td>'.$trips.'</td>';
					echo '<td>'.$usersArray[$user].'</td>';
					echo '<td><div class="panel" name="projectDescription" style="max-width:250px" >'.$description.'</div></td>';
					echo '<td>
								<form name="addMaterialForm" action="index.php" method="get">
									<input type="hidden" name="content" value="showMaterial">
									<input type="hidden" name="aMprojectID" value="'.$id.'">
									<input type="hidden" name="showOnly" value="'.$showOnly.'">
									<input type="hidden" name="pP" value="cP">
									<input class="btn btn-default" type="submit" value="Material">
								</form>
							</td>';				
					echo '<td>
								<form name="reActivateForm" action="include/project/reActivateProject.php" method="post">
									<input type="hidden" name="projectID" value="'.$id.'">
									<input class="btn btn-default" type="submit" value="Återuppta" onclick="return confirm(\'Är du säker?\')">
								</form>
							</td>';
					echo '<td>
								<form name="deleteProjectForm" action="include/project/deleteProject.php" method="post">
									<input type="hidden" name="projectID" value="'.$id.'">
									<input class="btn btn-default" type="submit" value="Radera" onclick="return confirm(\'Är du säker?\')">
								</form>
							</td>';
				echo '</tr>';
			}
		
		}	
		echo '</tbody>';
		echo '</table>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>