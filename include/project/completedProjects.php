<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$sorting = @$_GET['sort'];
		$showOnly = true;		
		
		if($sorting == "orderNo") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_order_nr";
		} else if ($sorting == "address") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_address";
		} else if ($sorting == "startDate") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_start_date";
		} else if ($sorting == "customer") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_customer";
		} else if ($sorting == "user") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_user";
		} else {
			$project_SQLselect = "SELECT * FROM project";
		}
		
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
				echo '<th><a href="index.php?content=completedProjects&sort=orderNo" style="color:black;'; if(@$_GET['sort'] == 'orderNo') {echo 'text-decoration:underline;';} echo '">Arbetsorder</a></th>';
				echo '<th><a href="index.php?content=completedProjects&sort=address" style="color:black;'; if(@$_GET['sort'] == 'address') {echo 'text-decoration:underline;';} echo '">Adress</a></th>';
				echo '<th><a href="index.php?content=completedProjects&sort=startDate" style="color:black;'; if(@$_GET['sort'] == 'startDate') {echo 'text-decoration:underline;';} echo '">Startdatum</a></th>'; 
				echo '<th><a href="index.php?content=completedProjects&sort=customer" style="color:black;'; if(@$_GET['sort'] == 'customer') {echo 'text-decoration:underline;';} echo '">Kund</a></th>';
				echo '<th>Tid</th>';
				echo '<th>Resor</th>';
				echo '<th><a href="index.php?content=completedProjects&sort=user" style="color:black;'; if(@$_GET['sort'] == 'user') {echo 'text-decoration:underline;';} echo '">Utfört av</a></th>';
				echo '<th>Beskrivning</th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($row = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC)) {
			
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
			
			$customersArray = unserialize (@$_COOKIE['customers']);
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