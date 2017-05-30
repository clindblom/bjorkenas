<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$showOnly = false;	
		
		$customerID = $_GET['customerID'];	
		
		$project_SQLselect = "SELECT * FROM project WHERE project_customer=".$customerID;
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect); 	
	
		if ($detect->isMobile()) {
			echo '<style>#customerLink {background: #A0A0A0;}</style>';
		} else {
			echo '<style>#customerLink {background: black;}</style>';
		}

		echo '<h2>Projekt för vald kund</h2>';

		echo '<form id="customerForm" name="customerForm" action="index.php" method="get">
					<input type="hidden" name="content" value="handleCustomer">
					<input class="btn btn-default" type="submit"  value="Tillbaka" style="float:left; margin-right:10px"; />
				</form>';
		
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
				echo '<th>Avslutat</th>';
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
					if($projectFinished == false) {
						echo '<td>Nej</td>';
					} else {
						echo '<td>Ja</td>';
					}
				echo '</tr>';
			
			}
			echo '</tbody>';
		echo '</table>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>