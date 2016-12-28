<?php

	function customerDropdown($currentIDvalue) {

		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {
			$customer_SQLselect = "SELECT customer_id, customer_company FROM customer";
				
			$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect);	
				
			$rendering = '<select class="form-control" name="customerID">';
			
			$rendering .= '<option value="0" selected="selected">';
			$rendering .= '..välj en kund..</option>';
		 	
					while ($row = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC)) {
					    $ID = $row['customer_id'];
					    $company = $row['customer_company'];
	
					    if ($currentIDvalue == $ID) { 
					    	$selectedFlag = " selected";
					    } else { 
					    	$selectedFlag = "";
					    } 
					    $rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$company.'</option>';
					}
					$rendering .= '</select>';
			
			return $rendering;
		} else {
			return '<h2>Database connection errer!</h2>';
		}
	}	

?>