<?php

	function projectDropdown($currentIDvalue, $t) {

		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {
			$customer_SQLselect = "SELECT project_id, project_order_nr, project_address FROM project";
				
			$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect);	
				
			$rendering = '<select class="form-control" name="projID'.$t.'">';
			
			$rendering .= '<option value="0" selected="selected">';
			$rendering .= '..välj ett projekt..</option>';
		 	
					while ($row = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC)) {
					    $ID = $row['project_id'];
					    $projects = $row['project_order_nr'];
					    $adress = $row['project_address'];
	
					    if ($currentIDvalue == $ID) { 
					    	$selectedFlag = " selected";
					    	$rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$projects.'</option>';
					    } else { 
					    	$selectedFlag = "";
					    	if ($adress == "") {
					    		$rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$projects.'</option>';
					    	} else {
					    		$rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$projects.' - '.$adress.'</option>';
					    	}
					    } 
					    
					}
					$rendering .= '</select>';
			
			return $rendering;
		} else {
			return '<h2>Database connection errer!</h2>';
		}
	}
	
	function projectDropdownDB($currentIDvalue, $t) {

		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {
			$customer_SQLselect = "SELECT project_id, project_order_nr FROM project";
				
			$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect);	
				
			$rendering = '<select class="form-control" name="projID'.$t.'">';
			
			$rendering .= '<option value="0" selected="selected">';
			$rendering .= '-'.$currentIDvalue.'-</option>';
		 	
					while ($row = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC)) {
					    $ID = $row['project_id'];
					    $projects = $row['project_order_nr'];
	
					    if ($currentIDvalue == $ID) { 
					    	$selectedFlag = " selected";
					    } else { 
					    	$selectedFlag = "";
					    } 
					    $rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$projects.'</option>';
					}
					$rendering .= '</select>';
			
			return $rendering;
		} else {
			return '<h2>Database connection errer!</h2>';
		}
	}

	function weekDropdown($w, $weekDD) {
			
		$rendering = '<select class="form-control" name="selectedWeek">';
		
		$rendering .= '<option value="'.$weekDD.'" selected="selected">-'.$weekDD.'-</option>';
	 	
				for ($i=1; $i<53; $i++) {

				    if ($w == $i) { 
				    	$selectedFlag = " selected";
				    } else { 
				    	$selectedFlag = "";
				    } 
				    $rendering .= '<option value="'.$i.'" '.$selectedFlag.'>'.$i.'</option>';
				}
				$rendering .= '</select>';
		
		return $rendering;

	}

?>