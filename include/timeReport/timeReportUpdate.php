<?php

	$user = $_COOKIE['userID'];
	
	$week = $_POST['week'];
	$year = $_POST['year'];
	$day = 1;
	
	for($t=0; $t<8; $t++) {
		${"projID".$t} = $_POST['projID'.$t];
		${"tr_id".$t} = $_POST['tr_id'.$t];
		${"montime".$t} = $_POST['montime'.$t];
		${"montrip".$t} = $_POST['montrip'.$t];
		${"tuetime".$t} = $_POST['tuetime'.$t];
		${"tuetrip".$t} = $_POST['tuetrip'.$t];
		${"wentime".$t} = $_POST['wentime'.$t];
		${"wentrip".$t} = $_POST['wentrip'.$t];
		${"thutime".$t} = $_POST['thutime'.$t];
		${"thutrip".$t} = $_POST['thutrip'.$t];
		${"fritime".$t} = $_POST['fritime'.$t];
		${"fritrip".$t} = $_POST['fritrip'.$t];
		${"sattime".$t} = $_POST['sattime'.$t];
		${"sattrip".$t} = $_POST['sattrip'.$t];
		${"suntime".$t} = $_POST['suntime'.$t];
		${"suntrip".$t} = $_POST['suntrip'.$t];
	}	
	
	for($s=0; $s<8; $s++) {
		include('../../config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {								
			
			$tr_SQLupdate = "UPDATE time_report SET tr_project=".${'projID'.$s}.", tr_montime=".${'montime'.$s}.", tr_montrip=".${'montrip'.$s}.",";
			$tr_SQLupdate .= " tr_tuetime=".${'tuetime'.$s}.", tr_tuetrip=".${'tuetrip'.$s}.", tr_wentime=".${'wentime'.$s}.", tr_wentrip=".${'wentrip'.$s}.",";
			$tr_SQLupdate .= " tr_thutime=".${'thutime'.$s}.", tr_thutrip=".${'thutrip'.$s}.", tr_fritime=".${'fritime'.$s}.", tr_fritrip=".${'fritrip'.$s}.",";
			$tr_SQLupdate .= " tr_sattime=".${'sattime'.$s}.", tr_sattrip=".${'sattrip'.$s}.", tr_suntime=".${'suntime'.$s}.", tr_suntrip=".${'suntrip'.$s};	
			$tr_SQLupdate .= " WHERE tr_id=".${'tr_id'.$s};
			
			
			echo $tr_SQLupdate.'<br/>';
			
			$tr_SQLupdate_query = mysqli_query($dbConnected, $tr_SQLupdate);			

			header("Location: ../../index.php?content=chosenWeek&selectedWeek=".$week."&selectedYear=".$year);
		
		} else {
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}	
	}

?>