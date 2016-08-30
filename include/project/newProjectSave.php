<?php
	
	$newProjectNumber = $_POST['newProjectNumber'];
	$newProjectAddress = $_POST['newProjectAddress'];
	$newProjectStartDate = $_POST['newProjectStartDate'];
	$newProjectCustomerID = $_POST['customerID'];
	$newProjectUserID = $_POST['userID'];
	$newProjectDescription = $_POST['newProjectDescription'];
	
	createProject($newProjectNumber, $newProjectAddress, $newProjectStartDate,
						$newProjectCustomerID, $newProjectUserID, $newProjectDescription);


	function createProject($number, $address, $startDate, $customerID, $userID, $description) {

		include('../../config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {						
			
			$project_SQLinsert = "INSERT INTO project (project_order_nr, project_address, project_start_date, ";
			$project_SQLinsert .= "project_customer, project_user, project_description)";
			$project_SQLinsert .= "VALUES ('".$number."', '".$address."', '".$startDate."', ";
			$project_SQLinsert .= "'".$customerID."', '".$userID."', '".$description."') ";
			
			$project_SQLinsert_query = mysqli_query($dbConnected, $project_SQLinsert);			

			header("Location: ../../index.php?content=handleProject");
		
		} else {
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}
		
	}
?>