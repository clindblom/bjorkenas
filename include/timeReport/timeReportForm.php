<?php
	include('config/dbConfig.php'); 
	include('include/timeReport/timeReportFunction.php');
	
	$user = $_COOKIE['userID'];
	$week = $_GET['selectedWeek'];
	$year = $_GET['selectedYear'];
	$weekNoDB = 0;
	$noOfRows = 0;
	
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$showOnly = false;		
		
	$project_SQLselect = "SELECT * FROM project";
	$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
	
	$tr_SQLselect = "SELECT * FROM time_report where tr_week=".$year.''.$week." AND tr_user=".$user;
	$tr_SQLselect_Query = mysqli_query($dbConnected, $tr_SQLselect); 	
	
	if ($detect->isMobile()) {
			echo '<style>#reportTimeLink {background: #A0A0A0;}</style>';		
		} else {
			echo '<style>#reportTimeLink {background: black;}</style>';
		}
	}

	echo '<h2>Tidsrapportering vecka '.$week.' '.$year.'</h2>';
	
	$j = 0;
	while ($tr_row = mysqli_fetch_array($tr_SQLselect_Query, MYSQLI_ASSOC)) {
		$weekNoDB = $tr_row['tr_week'];
		$orderNodb = $tr_row['tr_project'];
		$orderNoArraydb[$j] = $orderNodb;
		$userID = $tr_row['tr_user'];
		${"tr_id".$j} = $tr_row['tr_id'];
		${"montime".$j} = $tr_row['tr_montime'];
		${"montrip".$j} = $tr_row['tr_montrip'];
		${"tuetime".$j} = $tr_row['tr_tuetime'];
		${"tuetrip".$j} = $tr_row['tr_tuetrip'];
		${"wentime".$j} = $tr_row['tr_wentime'];
		${"wentrip".$j} = $tr_row['tr_wentrip'];
		${"thutime".$j} = $tr_row['tr_thutime'];
		${"thutrip".$j} = $tr_row['tr_thutrip'];
		${"fritime".$j} = $tr_row['tr_fritime'];
		${"fritrip".$j} = $tr_row['tr_fritrip'];
		${"sattime".$j} = $tr_row['tr_sattime'];
		${"sattrip".$j} = $tr_row['tr_sattrip'];
		${"suntime".$j} = $tr_row['tr_suntime'];
		${"suntrip".$j} = $tr_row['tr_suntrip'];
		$j++;
	}
	
	if ($_GET["Add"] == 1) {
		$noOfRows = $j + 4;
		for ($j2=$j; $j2<$j+4; $j2++) {
			$orderNoArraydb[$j2] = 0;
			${"tr_id".$j2} = $tr_row['tr_id'];
			${"montime".$j2} = 0;
			${"montrip".$j2} = 0;
			${"tuetime".$j2} = 0;
			${"tuetrip".$j2} = 0;
			${"wentime".$j2} = 0;
			${"wentrip".$j2} = 0;
			${"thutime".$j2} = 0;
			${"thutrip".$j2} = 0;
			${"fritime".$j2} = 0;
			${"fritrip".$j2} = 0;
			${"sattime".$j2} = 0;
			${"sattrip".$j2} = 0;
			${"suntime".$j2} = 0;
			${"suntrip".$j2} = 0;
		}
	} elseif ($_GET["Add"] == 0) {
		$noOfRows = $j;
	}

	if($weekNoDB == $year.''.$week) {
	
		echo '<form id="createTimeReportForm" name="updateTimeReportForm" action="include/timeReport/timeReportUpdate.php" method="post">
					<input type="hidden" name="weekNumber" value="'.$year.''.$week.'">
					<input type="hidden" name="week" value="'.$week.'">
					<input type="hidden" name="year" value="'.$year.'">
					<input type="hidden" name="rows" value="'.$noOfRows.'">
					<input type="hidden" name="added" value="'.$_GET["Add"].'">
					<input class="btn btn-default" type="submit"  value="Rapportera" style="float:left; margin-right:10px;"/>';
		
		echo '<table class="table" id="reportTimeTable">';
		
			echo '<thead>';
				echo '<tr>';
					echo '<th>Projekt</th>'; 
					echo '<th colspan=2>Måndag</th>'; 
					echo '<th colspan=2>Tisdag</th>';
					echo '<th colspan=2>Onsdag</th>';
					echo '<th colspan=2>Torsdag</th>';
					echo '<th colspan=2>Fredag</th>';
					echo '<th colspan=2>Lördag</th>';
					echo '<th colspan=2>Söndag</th>';
					echo '<th colspan=2></th>';
					echo '<th colspan=2></th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			
			$i = 0;
			while ($row = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC)) {
				$orderNo = $row['project_order_nr'];
				$orderNoArray[$i] = $orderNo;
				$i++;
			}
				
				echo '<tr>';
					echo '<td></td>';
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
					echo '<td>Tid</td>';		
					echo '<td>Resa</td>';		
				echo '</tr>';		
			
			for($t=0; $t<$noOfRows; $t++) {
				echo '<tr>';

			  		//if($orderNodb == 0) {
				  	if ($orderNoArraydb[$t] == 0) {
				  		echo '<td style="width:10%">
									<input type="hidden" class="form-control" ><div>'.projectDropdown('', $t).'</div></input>
				  				</td>';
		 			} else {
		  				echo '<td style="width:10%">
									<input type="hidden" class="form-control" ><div>'.projectDropdown($orderNoArraydb[$t], $t).'</div></input>
			  					</td>';
		  			}
			  		
			  		echo '<input type="hidden" id="tr_id'.$t.'" name="tr_id'.$t.'" value="'.${"tr_id".$t}.'">';
					echo '<td><input type="text" class="form-control" id="montime'.$t.'" name="montime'.$t.'" value="'.${"montime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="montrip'.$t.'" name="montrip'.$t.'" value="'.${"montrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="tuetime'.$t.'" name="tuetime'.$t.'" value="'.${"tuetime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="tuetrip'.$t.'" name="tuetrip'.$t.'" value="'.${"tuetrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="wentime'.$t.'" name="wentime'.$t.'" value="'.${"wentime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="wentrip'.$t.'" name="wentrip'.$t.'" value="'.${"wentrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="thutime'.$t.'" name="thutime'.$t.'" value="'.${"thutime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="thutrip'.$t.'" name="thutrip'.$t.'" value="'.${"thutrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="fritime'.$t.'" name="fritime'.$t.'" value="'.${"fritime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="fritrip'.$t.'" name="fritrip'.$t.'" value="'.${"fritrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="sattime'.$t.'" name="sattime'.$t.'" value="'.${"sattime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="sattrip'.$t.'" name="sattrip'.$t.'" value="'.${"sattrip".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="suntime'.$t.'" name="suntime'.$t.'" value="'.${"suntime".$t}.'"></td>';
					echo '<td><input type="text" class="form-control" id="suntrip'.$t.'" name="suntrip'.$t.'" value="'.${"suntrip".$t}.'"></td>';
				
				echo '</tr>';
			}			
				
			echo '</body>';
			
			$sumMonTime = 0;
			$sumMonTrip = 0;
			$sumTueTime = 0;
			$sumTueTrip = 0;
			$sumWenTime = 0;
			$sumWenTrip = 0;
			$sumThuTime = 0;
			$sumThuTrip = 0;
			$sumFriTime = 0;
			$sumFriTrip = 0;
			$sumSatTime = 0;
			$sumSatTrip = 0;
			$sumSunTime = 0;
			$sumSunTrip = 0;
			$sumAllTime = 0;
			$sumAllTrip = 0;
			
			for($e=0; $e<$noOfRows; $e++) {
				$sumMonTime = $sumMonTime + ${"montime".$e};
				$sumMonTrip = $sumMonTrip + ${"montrip".$e};
				$sumTueTime = $sumTueTime + ${"tuetime".$e};
				$sumTueTrip = $sumTueTrip + ${"tuetrip".$e};
				$sumWenTime = $sumWenTime + ${"wentime".$e};
				$sumWenTrip = $sumWenTrip + ${"wentrip".$e};
				$sumThuTime = $sumThuTime + ${"thutime".$e};
				$sumThuTrip = $sumThuTrip + ${"thutrip".$e};
				$sumFriTime = $sumFriTime + ${"fritime".$e};
				$sumFriTrip = $sumFriTrip + ${"fritrip".$e};
				$sumSatTime = $sumSatTime + ${"sattime".$e};
				$sumSatTrip = $sumSatTrip + ${"sattrip".$e};
				$sumSunTime = $sumSunTime + ${"suntime".$e};
				$sumSunTrip = $sumSunTrip + ${"suntrip".$e};
			}
			
			$sumAllTime = $sumMonTime + $sumTueTime + $sumWenTime + $sumThuTime + $sumFriTime + $sumSatTime + $sumSunTime;
			$sumAllTrip = $sumMonTrip + $sumTueTrip + $sumWenTrip + $sumThuTrip + $sumFriTrip + $sumSatTrip + $sumSunTrip;
			
			echo '<tfoot>';
				echo '<tr>';
					echo '<td>Summa</td>';
					echo '<td>'.$sumMonTime.'</td>';
					echo '<td>'.$sumMonTrip.'</td>';
					echo '<td>'.$sumTueTime.'</td>';
					echo '<td>'.$sumTueTrip.'</td>';
					echo '<td>'.$sumWenTime.'</td>';
					echo '<td>'.$sumWenTrip.'</td>';
					echo '<td>'.$sumThuTime.'</td>';
					echo '<td>'.$sumThuTrip.'</td>';
					echo '<td>'.$sumFriTime.'</td>';
					echo '<td>'.$sumFriTrip.'</td>';
					echo '<td>'.$sumSatTime.'</td>';
					echo '<td>'.$sumSatTrip.'</td>';
					echo '<td>'.$sumSunTime.'</td>';
					echo '<td>'.$sumSunTrip.'</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan=2>Total tid</td>';
					echo '<td>'.$sumAllTime.'</td>';
				echo '<tr>';
				echo '</tr>';
					echo '<td colspan=2>Alla resor</td>';
					echo '<td>'.$sumAllTrip.'</td>';
				echo '</tr>';
			echo '</tfoot>';
					
		echo '</table>';
		echo '</form>';
		
		echo '<div style="padding-bottom:25px">';
		echo '<form name="nextnWeek" action="index.php" method="get">';
		echo '<input name="content" type="hidden" value="chosenWeek">';
			if($week == 52) {
				$nextWeek = 1;
				$nextYear = $year+1;
			} else {
				$nextWeek = $week+1;
				$nextYear = $year;
			}
			if($nextWeek>0 && $nextWeek<10) {
				$nextWeek = '0'.$nextWeek;
			}
			echo '<input type="hidden" name="selectedWeek" value="'.$nextWeek.'">';
			echo '<input type="hidden" name="selectedYear" value="'.$nextYear.'">';
			echo '<input type="hidden" name="Add" value="0">';
			echo '<input class="btn btn-default" type="submit"  value="Nästa v" style="float:right; margin-right:10px;"/>';
		echo '</form>';
		echo '<form name="lastWeek" action="index.php" method="get">';
		echo '<input name="content" type="hidden" value="chosenWeek">';
			if($week == 1) {
				$lastWeek = 52;
				$lastYear = $year-1;
			} else {
				$lastWeek = $week-1;
				$lastYear = $year;
			}
			if($lastWeek>0 && $lastWeek<10) {
				$lastWeek = '0'.$lastWeek;
			}
			echo '<input type="hidden" name="selectedWeek" value="'.$lastWeek.'">';
			echo '<input type="hidden" name="selectedYear" value="'.$lastYear.'">';
			echo '<input type="hidden" name="Add" value="0">';
			echo '<input class="btn btn-default" type="submit"  value="Förra v" style="float:right; margin-right:10px;"/>';
		echo '</form>';

		echo '<form id="moreRowsForm" name="moreRowsForm" action="include/timeReport/moreRowsTimeReport.php" method="post">
					<input type="hidden" name="weekNumber" value="'.$year.''.$week.'">
					<input type="hidden" name="week" value="'.$week.'">
					<input type="hidden" name="year" value="'.$year.'">
					<input class="btn btn-default" type="submit"  value="Fler rader" style="float:right; margin-right:10px;" onclick="return confirm(\'Har du sparat dina ändringar genom att trycka Rapportera?\')"/></form>';

		echo '</div>';
		
		} else { // Inga värden i databasen.
			
			echo '<form id="createTimeReportForm" name="createTimeReportForm" action="include/timeReport/newTimeReportSave.php" method="post">
					<input type="hidden" name="weekNumber" value="'.$year.''.$week.'">
					<input type="hidden" name="week" value="'.$week.'">
					<input type="hidden" name="year" value="'.$year.'">
					<input class="btn btn-default" type="submit"  value="Rapportera" style="float:left; margin-right:10px;"/>';
		
			echo '<table class="table" id="reportTimeTable">';
		
			echo '<thead>';
				echo '<tr>';
					echo '<th>Projekt</th>'; 
					echo '<th colspan=2>Måndag</th>'; 
					echo '<th colspan=2>Tisdag</th>';
					echo '<th colspan=2>Onsdag</th>';
					echo '<th colspan=2>Torsdag</th>';
					echo '<th colspan=2>Fredag</th>';
					echo '<th colspan=2>Lördag</th>';
					echo '<th colspan=2>Söndag</th>';
					echo '<th colspan=2></th>';
					echo '<th colspan=2></th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			
			$i = 0;
			while ($row = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC)) {
				$orderNo = $row['project_order_nr'];
				$orderNoArray[$i] = $orderNo;
				$i++;
			}			
			
			for($t=0; $t<8; $t++) {
				echo '<tr>';

			  		echo '<td style="width:10%">
								<input type="hidden" class="form-control" ><div>'.projectDropdown('', $t).'</div></input>
			  				</td>';
			  				
					echo '<td><input type="text" class="form-control" id="montime'.$t.'" name="montime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="montrip'.$t.'" name="montrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="tuetime'.$t.'" name="tuetime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="tuetrip'.$t.'" name="tuetrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="wentime'.$t.'" name="wentime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="wentrip'.$t.'" name="wentrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="thutime'.$t.'" name="thutime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="thutrip'.$t.'" name="thutrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="fritime'.$t.'" name="fritime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="fritrip'.$t.'" name="fritrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="sattime'.$t.'" name="sattime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="sattrip'.$t.'" name="sattrip'.$t.'" placeholder="Resa"></td>';
					echo '<td><input type="text" class="form-control" id="suntime'.$t.'" name="suntime'.$t.'" placeholder="Tid"></td>';
					echo '<td><input type="text" class="form-control" id="suntrip'.$t.'" name="suntrip'.$t.'" placeholder="Resa"></td>';
				
				echo '</tr>';
			}			
				
			echo '</body>';
			
			echo '<tfoot>';
				echo '<tr>';
					echo '<td>Summa</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
					echo '<td>0</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan=2>Total tid</td>';
					echo '<td>0</td>';
				echo '<tr>';
				echo '</tr>';
					echo '<td colspan=2>Alla resor</td>';
					echo '<td>0</td>';
				echo '</tr>';
			echo '</tfoot>';
					
		echo '</table>';
		echo '</form>';

		echo '<div style="padding-bottom:25px">';
		echo '<form name="nextnWeek" action="index.php" method="get">';
		echo '<input name="content" type="hidden" value="chosenWeek">';
			if($week == 52) {
				$nextWeek = 1;
				$nextYear = $year+1;
			} else {
				$nextWeek = $week+1;
				$nextYear = $year;
			}
			if($nextWeek>0 && $nextWeek<10) {
				$nextWeek = '0'.$nextWeek;
			}
			echo '<input type="hidden" name="selectedWeek" value="'.$nextWeek.'">';
			echo '<input type="hidden" name="selectedYear" value="'.$nextYear.'">';
			echo '<input type="hidden" name="Add" value="0">';
			echo '<input class="btn btn-default" type="submit"  value="Nästa v" style="float:right; margin-right:10px;"/>';
		echo '</form>';
		echo '<form name="lastWeek" action="index.php" method="get">';
		echo '<input name="content" type="hidden" value="chosenWeek">';
			if($week == 1) {
				$lastWeek = 52;
				$lastYear = $year-1;
			} else {
				$lastWeek = $week-1;
				$lastYear = $year;
			}
			if($lastWeek>0 && $lastWeek<10) {
				$lastWeek = '0'.$lastWeek;
			}
			echo '<input type="hidden" name="selectedWeek" value="'.$lastWeek.'">';
			echo '<input type="hidden" name="selectedYear" value="'.$lastYear.'">';
			echo '<input type="hidden" name="Add" value="0">';
			echo '<input class="btn btn-default" type="submit"  value="Förra v" style="float:right; margin-right:10px;"/>';
		echo '</form>';
		echo '</div>';
	
		}
?>