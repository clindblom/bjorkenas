<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$projectId = @$_GET['projectID'];
		
		$project_SQLselect = 'SELECT * FROM project WHERE project_id="'.$projectId.'"';
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		
		include('newProjectFunction.php');
	
		echo '<h2>Ändra information om projekt</h2>';
		$row = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC);

		$id = $row['project_id'];
		$orderNo = $row['project_order_nr'];
		$address = $row['project_address'];
		$startDate = $row['project_start_date'];
		$customer = $row['project_customer'];
		$duration = $row['project_duration'];
		$trips = $row['project_trips'];
		$user = $row['project_user'];
		$description = $row['project_description'];
	
		$customerDD = customerDropdown($customer);
		$userDD = userDropdown($user);


		echo '<form name="editProjectForm" action="include/project/editProjectFunction.php" method="post">
					  <input name="editProjectId" type="hidden" value="'.$id.'">
					  <div class="form-group">
					    <label for="editProjectOrderNo">Arbetsorder</label>
					    <input type="text" class="form-control" id="editProjectOrderNo" name="editProjectOrderNo" value="'.$orderNo.'">
					  </div>
					  <div class="form-group">
					    <label for="editProjectAddress">Adress</label>
					    <input type="text" class="form-control" id="editProjectAddress" name="editProjectAddress" value="'.$address.'">
					  </div>
					  <div class="form-group">
					    <label for="editProjectStartDate">Startdatum</label>
					    <input type="date" class="form-control" id="editProjectStartDate" name="editProjectStartDate" value="'.$startDate.'">
					  </div>
					  <div class="form-group">
					    <label for="editProjectCustomer">Beställare</label>
					    '.$customerDD.'
					  </div>
					  <div class="form-group">
					    <label for="editProjectDuration">Tid</label>
					    <input type="number" class="form-control" id="editProjectDuration" name="editProjectDuration" min="0" max="10000" step="0.5" value="'.$duration.'">
					  </div>
					  <div class="form-group">
					    <label for="editProjectTrips">Resor</label>
					    <input type="number" class="form-control" id="editProjectTrips" name="editProjectTrips" min="0" max="100" step="1" value="'.$trips.'">
					  </div>
					  <div class="form-group">
					    <label for="editProjectUser">Tilldelat</label>
					    '.$userDD.'
					  </div>
					  <div class="form-group">
					    <label for="editProjectDescription">Beskrivning</label>
					    <textarea class="form-control" name="editProjectDescription" rows="2" cols="40">'.$description.'</textarea>
					  </div>
					  <input class="btn btn-default" id="editProjectSubmit" name="editProjectSubmit" type="submit" value="Ändra projekt" style="float:left; margin-right:10px;">
				</form>';
		echo 	'<form name="cancelProjectEdit" action="index.php" method="get">
						<input name="content" type="hidden" value="handleProject">
						<input class="btn btn-default" name="cancelProjectEdit" type="submit" value="Avbryt">
				</form>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>