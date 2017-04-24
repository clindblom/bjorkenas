<?php

	$week = $_GET['week'];
	$year = $_GET['year'];
	$user = $_COOKIE['userID'];

	require('../../config/fpdf17/fpdf.php');
	include('../../config/dbConfig.php');

	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		//Time Report
		$tr_SQLselect = "SELECT * FROM time_report where tr_week=".$year."".$week." AND tr_user=".$user;
		$tr_SQLselect_Query = mysqli_query($dbConnected, $tr_SQLselect);

		//Project Report
		$proj_SQLselect = "SELECT project_id, project_order_nr FROM project WHERE finished=0";
		$proj_SQLselect_Query = mysqli_query($dbConnected, $proj_SQLselect);

		//User
		$user_SQLselect = "SELECT name FROM user where id=".$user;
		$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect);
		$userNameArray = mysqli_fetch_array($user_SQLselect_Query, MYSQLI_ASSOC);
		$userName = $userNameArray['name'];

		//Project no to be presented.
		$projAssArray = array();
		while ($projRow = mysqli_fetch_array($proj_SQLselect_Query, MYSQLI_ASSOC)) {
			$projId = $projRow['project_id'];
			$projNo = $projRow['project_order_nr'];
			$projAssArray += array($projId => $projNo);
		}

		//TimeReport array to be presented.
		$trData = array();
		$trTempArray = array();
		while ($trRow = mysqli_fetch_array($tr_SQLselect_Query, MYSQLI_ASSOC)) {

			if ($trRow['tr_project'] != 0) {
				$orderNo = $projAssArray[$trRow['tr_project']];
			} else {
				$orderNo = 0;
			}

			$montime = $trRow['tr_montime'];
			$montrip = $trRow['tr_montrip'];
			$tuetime = $trRow['tr_tuetime'];
			$tuetrip = $trRow['tr_tuetrip'];
			$wentime = $trRow['tr_wentime'];
			$wentrip = $trRow['tr_wentrip'];
			$thutime = $trRow['tr_thutime'];
			$thutrip = $trRow['tr_thutrip'];
			$fritime = $trRow['tr_fritime'];
			$fritrip = $trRow['tr_fritrip'];
			$sattime = $trRow['tr_sattime'];
			$sattrip = $trRow['tr_sattrip'];
			$suntime = $trRow['tr_suntime'];
			$suntrip = $trRow['tr_suntrip'];			
			
			$trTempArray = array($orderNo, $montime, $montrip, $tuetime, $tuetrip, $wentime, $wentrip, $thutime, $thutrip, $fritime, $fritrip, $sattime, $sattrip, $suntime, $suntrip);
			array_push($trData, $trTempArray);
		}
		
		$header = array('Arbetsorder', 'Mån T', 'Mån R', 'Tis T', 'Tis R', 'Ons T', 'Ons R', 'Tor T', 'Tor R', 'Fre T', 'Fre R', 'Lör T', 'Lör R', 'Sön T', 'Sön R');
		
		class PDF extends FPDF {

			function trTable($header, $data) {
				$this->SetFillColor(224,235,255);
				// Column widths
			   $w = array(20, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17);
			   // Header
			   for($i=0;$i<count($header);$i++) {
			   	$this->SetFont('Arial','B',8);
				   $this->Cell($w[$i],7,utf8_decode($header[$i]),0,0,'');
				}
			   $this->Ln();
			   // Data
			   $length = 1;
			   $fill = false;
			   foreach($data as $row)
			   {
			   	  $this->SetFont('Arial','',8);
			      $this->Cell($w[0],6,utf8_decode($row[0]),'',0,'',$fill);
			      $this->Cell($w[1],6,utf8_decode($row[1]),'',0,'',$fill);
			      $this->Cell($w[2],6,utf8_decode($row[2]),'',0,'',$fill);
			      $this->Cell($w[3],6,utf8_decode($row[3]),'',0,'',$fill);
			      $this->Cell($w[4],6,utf8_decode($row[4]),'',0,'',$fill);
			      $this->Cell($w[5],6,utf8_decode($row[5]),'',0,'',$fill);
			      $this->Cell($w[6],6,utf8_decode($row[6]),'',0,'',$fill);
			      $this->Cell($w[7],6,utf8_decode($row[7]),'',0,'',$fill);
			      $this->Cell($w[8],6,utf8_decode($row[8]),'',0,'',$fill);
			      $this->Cell($w[9],6,utf8_decode($row[9]),'',0,'',$fill);
			      $this->Cell($w[10],6,utf8_decode($row[10]),'',0,'',$fill);
			      $this->Cell($w[11],6,utf8_decode($row[11]),'',0,'',$fill);
			      $this->Cell($w[12],6,utf8_decode($row[12]),'',0,'',$fill);
			      $this->Cell($w[13],6,utf8_decode($row[13]),'',0,'',$fill);
			      $this->Cell($w[14],6,utf8_decode($row[14]),'',0,'',$fill);
			      
			      $this->Ln();
			      
			     	if($length % 18 == 0) {
			     		$this->AddPage();
			     		$this->Rotate(270, 100, 120);
						$this->SetFont('Arial','',8);
						$this->Cell(40,35,'',0,1);
						$this->SetFont('Arial','',10);
			     	}
			     	$length++;
			      $fill = !$fill;
			   }
			}

			function trSum($data) {
				// Column widths
			   $w = array(20, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17, 17);
			  
			   // Data

			   $monSumTime = 0;
			   $monSumTrip = 0;
			   $tueSumTime = 0;
			   $tueSumTrip = 0;
			   $wenSumTime = 0;
			   $wenSumTrip = 0;
			   $thuSumTime = 0;
			   $thuSumTrip = 0;
			   $friSumTime = 0;
			   $friSumTrip = 0;
			   $satSumTime = 0;
			   $satSumTrip = 0;
			   $sunSumTime = 0;
			   $sunSumTrip = 0;

			   foreach($data as $row)
			   {
				   $monSumTime = $monSumTime + $row[1];
				   $monSumTrip = $monSumTrip + $row[2];
				   $tueSumTime = $tueSumTime + $row[3];
				   $tueSumTrip = $tueSumTrip + $row[4];
				   $wenSumTime = $wenSumTime + $row[5];
				   $wenSumTrip = $wenSumTrip + $row[6];
				   $thuSumTime = $thuSumTime + $row[7];
				   $thuSumTrip = $thuSumTrip + $row[8];
				   $friSumTime = $friSumTime + $row[9];
				   $friSumTrip = $friSumTrip + $row[10];
				   $satSumTime = $satSumTime + $row[11];
				   $satSumTrip = $satSumTrip + $row[12];
				   $sunSumTime = $sunSumTime + $row[13];
				   $sunSumTrip = $sunSumTrip + $row[14];
			   }
			    $this->SetFont('Arial','',8);
			    $this->Cell($w[0],6,utf8_decode('Summa'),'',0);;
		        $this->Cell($w[1],6,utf8_decode($monSumTime),'',0);
		        $this->Cell($w[2],6,utf8_decode($monSumTrip),'',0);
		        $this->Cell($w[3],6,utf8_decode($tueSumTime),'',0);
		        $this->Cell($w[4],6,utf8_decode($tueSumTrip),'',0);
		        $this->Cell($w[5],6,utf8_decode($wenSumTime),'',0);
		        $this->Cell($w[6],6,utf8_decode($wenSumTrip),'',0);
		        $this->Cell($w[7],6,utf8_decode($thuSumTime),'',0);
		        $this->Cell($w[8],6,utf8_decode($thuSumTrip),'',0);
		        $this->Cell($w[9],6,utf8_decode($friSumTime),'',0);
		        $this->Cell($w[10],6,utf8_decode($friSumTrip),'',0);
		        $this->Cell($w[11],6,utf8_decode($satSumTime),'',0);
		        $this->Cell($w[12],6,utf8_decode($satSumTrip),'',0);
		        $this->Cell($w[13],6,utf8_decode($sunSumTime),'',0);
		        $this->Cell($w[14],6,utf8_decode($sunSumTrip),'',0);
			      
			    $this->Ln();

			    $totalTime = $monSumTime + $tueSumTime + $wenSumTime + $thuSumTime + $friSumTime + $satSumTime + $sunSumTime;
			    $totalTrip = $monSumTrip + $tueSumTrip + $wenSumTrip + $thuSumTrip + $friSumTrip + $satSumTrip + $sunSumTrip;

			    $this->SetFont('Arial','',8);
			    $this->Cell($w[0],6,utf8_decode('Total tid'),'',0);;
		        $this->Cell($w[1],6,'','',0);
		        $this->Cell($w[2],6,utf8_decode($totalTime),'',0);

		        $this->Ln();

		        $this->SetFont('Arial','',8);
			    $this->Cell($w[0],6,utf8_decode('Antal resor'),'',0);;
		        $this->Cell($w[1],6,'','',0);
		        $this->Cell($w[2],6,utf8_decode($totalTrip),'',0);
			}
			
			function Rotate($angle,$x=-1,$y=-1)
			{
			    if($x==-1)
			        $x=$this->x;
			    if($y==-1)
			        $y=$this->y;
			    if($this->angle!=0)
			        $this->_out('Q');
			    $this->angle=$angle;
			    if($angle!=0)
			    {
			        $angle*=M_PI/180;
			        $c=cos($angle);
			        $s=sin($angle);
			        $cx=$x*$this->k;
			        $cy=($this->h-$y)*$this->k;
			        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
			    }
			}
		
		}		
		
		//PDF
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->Rotate(270, 110, 130);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(40,35,'',0,1);
		$pdf->Cell(50,15,utf8_decode('Tidsrapport vecka:'.$week.' '.$year.' - '.$userName),0,1);
		$pdf->SetFont('Arial','',10);
		$pdf->trTable($header, $trData);
		$pdf->trSum($trData);
		$pdf->Output();
		
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>