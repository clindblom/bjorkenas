<?php
	
	$showOnly = false;		
		
	if ($detect->isMobile()) {
		echo '<style>#reportTimeLink {background: #A0A0A0;}</style>';		
	} else {
		echo '<style>#reportTimeLink {background: black;}</style>';
	}
	
	$timezone = date_default_timezone_get();
	$ddate = date('m/d/Y h:i:s a', time());
	$date = new DateTime($ddate);
	$year = $date->format("Y");
	$week = $date->format("W");
	
	echo '<form name="chosenWeek" action="index.php" method="get">';
	echo '<input name="content" type="hidden" value="chosenWeek">';	
	echo '<table class="table" id="chooseWeekTable">';
	
		echo '<thead>';
			echo '<tr>';
				echo '<td></td>';	
			echo '</tr>';		
		echo '</thead>';
		
		echo '<tbody>';
			echo '<tr>';
				echo '<td align="right">Välj en vecka: </td>';	
				echo '<td>'.weekDropdown('', $week).'</td>';
				echo '<td align="right">Välj ett år: </td>';
				echo '<td>'.yearDropdown('', $year).'</td>';	
				echo '<td><input class="btn btn-default" type="submit"  value="Gå vidare" style="float:left; margin-right:10px;"/></td>';
			echo '</tr>';	
	echo '</tbody>';
	echo '</form>';
	
	function yearDropdown($y, $yearDD) {
			
		$rendering = '<select class="form-control" name="selectedYear">';
	 	
		$rendering .= '<option value="'.$yearDD.'" selected="selected">-'.$yearDD.'-</option>';
	 		 			
	 			
				for ($i=2000; $i<2100; $i++) {
				    if ($y == $i) { 
				    	$selectedFlag = " selected";
				    } else { 
				    	$selectedFlag = "";
				    } 
				    $rendering .= '<option value="'.$i.'" '.$selectedFlag.'>'.$i.'</option>';
				}
				$rendering .= '</select>';
		
		return $rendering;

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