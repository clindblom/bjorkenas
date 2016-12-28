<?php

	$user = $_COOKIE['userID'];
	
	$weekNo = $_POST['weekNumber'];
	$week = $_POST['week'];
	$year = $_POST['year'];
	$day = 1;
	
	for($t=0; $t<8; $t++) {
		${"projID".$t} = $_POST['projID'.$t];
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
			
			$tr_SQLinsert = "INSERT INTO time_report (tr_user, tr_project, tr_week, tr_montime, tr_montrip, tr_tuetime, tr_tuetrip,";
			$tr_SQLinsert .= " tr_wentime, tr_wentrip, tr_thutime, tr_thutrip, tr_fritime, tr_fritrip, tr_sattime, tr_sattrip, tr_suntime, tr_suntrip)";
			$tr_SQLinsert .= "VALUES ('".$user."', '".${"projID".$s}."', '".$weekNo."', '".${"montime".$s}."', '".${"montrip".$s}."', '".${"tuetime".$s}."', '".${"tuetrip".$s}."', ";
			$tr_SQLinsert .= "'".${"wentime".$s}."', '".${"wentrip".$s}."', '".${"thutime".$s}."', '".${"thutrip".$s}."', '".${"fritime".$s}."', '".${"fritrip".$s}."', ";
			$tr_SQLinsert .= "'".${"sattime".$s}."', '".${"sattrip".$s}."', '".${"suntime".$s}."', '".${"suntrip".$s}."') ";
			
			$tr_SQLinsert_query = mysqli_query($dbConnected, $tr_SQLinsert);			

			header("Location: ../../index.php?content=chosenWeek&selectedWeek=".$week."&selectedYear=".$year);
		
		} else {
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}	
	}

?>