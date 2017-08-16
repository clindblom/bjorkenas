<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$sorting = @$_GET['sort'];
		$showOnly = false;
		
		if($sorting == "orderNo") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_order_nr";
		} else if ($sorting == "address") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_address";
		} else if ($sorting == "startDate") {
			$project_SQLselect = "SELECT * FROM project ORDER BY project_start_date";
		} else if ($sorting == "customer") {
			$project_SQLselect = "SELECT project.* FROM project join customer ON project.project_customer = customer.customer_id ORDER BY customer.customer_company";
		} else if ($sorting == "user") {
			$project_SQLselect = "SELECT project.* FROM project join user ON project.project_user = user.id ORDER BY user.username";
		} else {
			$project_SQLselect = "SELECT * FROM project";
		}

		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);

	if ($detect->isMobile()) {
			echo '<style>#hPLink {background: #A0A0A0;}</style>';		
		} else {
			echo '<style>#hPLink {background: black;}</style>';
		}
		
		echo '<h2>Projekt</h2>';
		echo '<form id="createProjectForm" name="createProjectForm" action="index.php" method="get">
					<input type="hidden" name="content" value="newProject">
					<input class="btn btn-default" type="submit"  value="Nytt projekt" style="float:left; margin-right:10px;"/>
				</form>';
		echo '<form name="printProjectForm" name="printProjectForm" target="_blank" action="include/project/printProjects.php" method="post">
					<input class="btn btn-default" type="submit"  value="Skriv ut projekt"/>
				</form>';
		echo '<table class="table" id="projectTable">';	
		
		echo '<thead>';
			echo '<tr>';
				echo '<th><a href="index.php?content=handleProject&sort=orderNo" style="color:black;'; if(@$_GET['sort'] == 'orderNo') {echo 'text-decoration:underline;';} echo '">Arbetsorder</a></th>';
				echo '<th><a href="index.php?content=handleProject&sort=address" style="color:black;'; if(@$_GET['sort'] == 'address') {echo 'text-decoration:underline;';} echo '">Adress</a></th>';
				echo '<th><a href="index.php?content=handleProject&sort=startDate" style="color:black;'; if(@$_GET['sort'] == 'startDate') {echo 'text-decoration:underline;';} echo '">Startdatum</a></th>'; 
				echo '<th><a href="index.php?content=handleProject&sort=customer" style="color:black;'; if(@$_GET['sort'] == 'customer') {echo 'text-decoration:underline;';} echo '">Kund</a></th>';
				echo '<th>Tid</th>';
				echo '<th>Resor</th>';
				echo '<th><a href="index.php?content=handleProject&sort=user" style="color:black;'; if(@$_GET['sort'] == 'user') {echo 'text-decoration:underline;';} echo '">Utfört av</a></th>';
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
				
				$customersArray = unserialize(@$_COOKIE['customers']);
				$usersArray = unserialize(@$_COOKIE['users']);
				
				if($projectFinished == false) {
					echo '<tr>';
						
						echo '<td>'.$orderNo.'</td>'; 
						echo '<td>'.$address.'</td>'; 
						echo '<td>'.$startDate.'</td>';
						echo '<td>'.$customersArray[$customer].'</td>';
						echo '<td>'.$duration.'</td>';
						echo '<td>'.$trips.'</td>';
						echo '<td>'.$usersArray[$user].'</td>';
						//echo '<td><textarea readonly name="projectDescription" rows="2" cols="30" style="boder-radius: 5px;">'.$description.'</textarea></td>';
						echo '<td><div class="panel" name="projectDescription" style="max-width:250px" >'.$description.'</div></td>';
						echo '<td>
									<form name="addMaterialForm" action="index.php" method="get">
										<input type="hidden" name="content" value="showMaterial">
										<input type="hidden" name="aMprojectID" value="'.$id.'">
										<input type="hidden" name="showOnly" value="'.$showOnly.'">
										<input class="btn btn-default" type="submit" value="Material">
									</form>
								</td>';				
						echo '<td>
									<form name="editProjectForm" action="index.php" method="get">
										<input type="hidden" name="content" value="editProject">
										<input type="hidden" name="projectID" value="'.$id.'">
										<input class="btn btn-default" type="submit" value="Ändra">
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