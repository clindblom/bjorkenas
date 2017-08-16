<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$sorting = @$_GET['sort'];
		
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
				echo '<th><a href="index.php?content=createInvoice&sort=orderNo" style="color:black;'; if(@$_GET['sort'] == 'orderNo') {echo 'text-decoration:underline;';} echo '">Arbetsorder</a></th>';
				echo '<th><a href="index.php?content=createInvoice&sort=address" style="color:black;'; if(@$_GET['sort'] == 'address') {echo 'text-decoration:underline;';} echo '">Adress</a></th>';
				echo '<th><a href="index.php?content=createInvoice&sort=startDate" style="color:black;'; if(@$_GET['sort'] == 'startDate') {echo 'text-decoration:underline;';} echo '">Startdatum</a></th>'; 
				echo '<th><a href="index.php?content=createInvoice&sort=customer" style="color:black;'; if(@$_GET['sort'] == 'customer') {echo 'text-decoration:underline;';} echo '">Kund</a></th>';
				echo '<th>Tid</th>';
				echo '<th>Resor</th>';
				echo '<th><a href="index.php?content=createInvoice&sort=user" style="color:black;'; if(@$_GET['sort'] == 'user') {echo 'text-decoration:underline;';} echo '">Utfört av</a></th>';
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
							var hostLocal = "http://localhost/ownWork/bjorkenasBS/index.php";
							var hostPublic = "http://bjorkenas.org/index.php";
							var search = "?content=createInvoice";
							setTimeout(function(){window.location.href = hostLocal + search;}, 10);
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