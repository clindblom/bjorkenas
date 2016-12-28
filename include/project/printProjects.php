<?php
	require('../../config/fpdf17/fpdf.php');
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		$img = '../../images/house-detective_brown.jpg';
		
		//Project
		$project_SQLselect = "SELECT * FROM project WHERE finished=0";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		
		//Project array to be presented.
		$projectData = array();
		
		$projectTempArray = array();
		while ($projectRow = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC)) {
			$orderNo = $projectRow['project_order_nr'];
			$address = $projectRow['project_address'];
			// $startDate = $projectRow['project_start_date'];
			$customer = $projectRow['project_customer'];
			$duration = $projectRow['project_duration'];	
			// $trips = $projectRow['project_trips'];	
			// $user = $projectRow['project_user'];	
			$description = $projectRow['project_description'];
			
			//Customer
			$customer_SQLselect = "SELECT customer_company FROM customer WHERE customer_id='".$customer."'";
			$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect);
			$cRow = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC);
			$customerCompany = $cRow['customer_company'];
			
/*			//User
			$user_SQLselect = "SELECT name FROM user WHERE id='".$user."'";
			$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect);
			$uRow = mysqli_fetch_array($user_SQLselect_Query, MYSQLI_ASSOC);
			$userName = $uRow['name'];
*/			
			
			$projectTempArray = array($orderNo, $address, $customerCompany, $duration, $description);
			array_push($projectData, $projectTempArray);
		}
		
		$header = array('Arbetsorder', 'Adress', 'Kund', 'Tid', 'Beskrivning');
		
		class PDF extends FPDF {

			function projectTable($header, $data) {
				$this->SetFillColor(224,235,255);
				// Column widths
			   $w = array(35, 50, 45, 20, 80);
			   // Header
			   $this->Cell(10);
			   for($i=0;$i<count($header);$i++) {
			   	$this->SetFont('Arial','B',12);
				   $this->Cell($w[$i],7,utf8_decode($header[$i]),0,0,'');
				}
			   $this->Ln();
			   // Data
			   $length = 1;
			   $fill = false;
			   foreach($data as $row)
			   {
			   	$this->Cell(10);
			   	$this->SetFont('Arial','',12);
			      $this->Cell($w[0],6,utf8_decode($row[0]),'',0,'',$fill);
			      $this->Cell($w[1],6,utf8_decode($row[1]),'',0,'',$fill);
			      $this->Cell($w[2],6,utf8_decode($row[2]),'',0,'',$fill);
			      $this->Cell($w[3],6,utf8_decode($row[3]),'',0,'',$fill);
			      $this->MultiCell($w[4],6,utf8_decode($row[4]),0,'',$fill);
			      $this->Ln();
			      
			     	if($length % 9 == 0) {
			     		$this->AddPage();
			     		$this->Rotate(270, 100, 120);
						$this->SetFont('Arial','',12);
						$this->Cell(40,35,'',0,1);
						//$this->cell(10);
						//$this->Cell(50,15,utf8_decode('Projekt:'),0,1);
						$this->SetFont('Arial','',10);
			     	}
			     	$length++;
			      $fill = !$fill;
			   }
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
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,35,'',0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Projekt:'),0,1);
		$pdf->SetFont('Arial','',10);
		$pdf->projectTable($header, $projectData);

		$pdf->Output();
		
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>