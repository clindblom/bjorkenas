<?php

	function materialDropdown($currentIDvalue) {

		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {
			
			$material_SQLselect = "SELECT material_id, article_name FROM material";
			$material_SQLselect_Query = mysqli_query($dbConnected, $material_SQLselect);	
				
			$rendering = '<select name="addMaterialDd" class="form-control">';
			
			$rendering .= '<option value="0" selected="selected">';
			$rendering .= '..välj material..</option>';
		 	
					while ($row = mysqli_fetch_array($material_SQLselect_Query, MYSQL_ASSOC)) {
					    $ID = $row['material_id'];
					    $name = $row['article_name'];
	
					    if ($currentIDvalue == $ID) { 
					    	$selectedFlag = " selected";
					    } else { 
					    	$selectedFlag = "";
					    }
					    $rendering .= '<option value="'.$ID.'" '.$selectedFlag.'>'.$name.'</option>';
					}
					$rendering .= '</select>';
			
			return $rendering;
		} else {
			return '<h2>Database connection errer!</h2>';
		}
	}	


?>