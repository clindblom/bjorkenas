<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		$project_SQLselect = "SELECT * FROM project";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		
		$showOnly = true;
	
		if ($detect->isMobile()) {
			echo '<style>#cILink {background: #A0A0A0;}</style>';
		} else {
			echo '<style>#cILink {background: black;}</style>';
		}
		
		echo '<h2>Välj ett projekt</h2>';
		echo '<form name="blankInvoiceForm" target="_blank" action="include/invoice/blankInvoice.php" method="post">
						<input class="btn btn-default" type="submit" value="Blankt underlag">
				</form>';
		
		echo '<table class="table" id="invoiceProjectTable">';	
		
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
					echo '<td><div class="panel" name="projectDescription" style="max-width:250px" >'.$description.'</div></td>';
					echo '<td>
								<form name="showMaterialForm" action="index.php" method="get">
									<input type="hidden" name="content" value="showMaterial">
									<input type="hidden" name="aMprojectID" value="'.$id.'">
									<input type="hidden" name="showOnly" value="'.$showOnly.'">
									<input type="hidden" name="pP" value="cI">
									<input class="btn btn-default" type="submit" value="Material">
								</form>
							</td>';				
					echo '<td>
								<form name="closeProjectForm" target="_blank" action="include/invoice/closeProject.php" method="post">
										<input type="hidden" name="closeProjectID" value="'.$id.'">
										<input class="btn btn-default" type="submit" onClick="clearUrl(); reloadPage(); return confirm(\'Är du säker?\');" value="Avsluta">
								</form>
							</td>';
				echo '</tr>';
			}
		}
		echo '</tbody>';
		echo '</table>';
		
		echo '<script type="text/javascript">
					function clearUrl() {
						if(location.search.indexOf(\'reloaded=yes\') >= 0){
							var host = "http://localhost/ownWork/bjorkenasBS/index.php";
							var search = "?content=createInvoice";
							setTimeout(function(){window.location.href = host + search;}, 10);
						}
					}
					function reloadPage() {
						if(location.search.indexOf(\'reloaded=yes\') < 0){
							var hash = window.location.hash;
							var loc = window.location.href.replace(hash, \'\');
							loc += (loc.indexOf(\'?\') < 0? \'?\' : \'&\') + \'reloaded=yes\';
							setTimeout(function(){window.location.href = loc + hash;}, 1000);
						}
					}
				</script>';
			
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>