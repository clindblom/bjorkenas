<?php
	require('../../config/fpdf17/fpdf.php');
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {	
		
		$projectId = $_POST['closeProjectID'];
		
		$img = '../../images/house-detective_brown.jpg';
		
		//Project
		$project_SQLselect = "SELECT * FROM project WHERE project_id='".$projectId."'";
		$project_SQLselect_Query = mysqli_query($dbConnected, $project_SQLselect);
		
		$projectRow = mysqli_fetch_array($project_SQLselect_Query, MYSQLI_ASSOC);
		$id = $projectRow['project_id'];
		$orderNo = $projectRow['project_order_nr'];
		$address = $projectRow['project_address'];
		$startDate = $projectRow['project_start_date'];
		$customer = $projectRow['project_customer'];
		$duration = $projectRow['project_duration'];	
		$trips = $projectRow['project_trips'];	
		$user = $projectRow['project_user'];	
		$description = $projectRow['project_description'];
		
		//Material array to be presented.
		$materialData = array();		
		
		//Material used
		$materialUsed_SQLselect = "SELECT material, quantity FROM material_used WHERE project_id='".$projectId."'";
		$materialUsed_SQLselect_Query = mysqli_query($dbConnected, $materialUsed_SQLselect);
		
		$materialUsedArray = array();
		while($muRow = mysqli_fetch_array($materialUsed_SQLselect_Query, MYSQLI_ASSOC)) {
			$material = $muRow['material'];
			$quantity = $muRow['quantity'];
			
			$material_SQLselect = "SELECT article_name, article_number FROM material WHERE material_id='".$material."'";
			$material_SQLselect_Query = mysqli_query($dbConnected, $material_SQLselect);
			$mRow = mysqli_fetch_array($material_SQLselect_Query, MYSQLI_ASSOC);
			$materialName = $mRow['article_name'];
			$materialNumber = $mRow['article_number'];
			
			$materialUsedArray = array($materialNumber, $materialName, $quantity);
			
			array_push($materialData, $materialUsedArray);
		}
		
		//Customer
		$customer_SQLselect = "SELECT customer_company FROM customer WHERE customer_id='".$customer."'";
		$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect);
		$cRow = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC);
		$customerCompany = $cRow['customer_company'];
		
		//User
		$user_SQLselect = "SELECT name, company FROM user WHERE id='".$user."'";
		$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect);
		$uRow = mysqli_fetch_array($user_SQLselect_Query, MYSQLI_ASSOC);
		$userName = $uRow['name'];
		$userCompany = $uRow['company'];

		//Set the project as finished		
		$project_SQLupdate = "UPDATE project SET finished=1 WHERE project_id='".$projectId."'";
		$project_SQLupdate_query = mysqli_query($dbConnected, $project_SQLupdate);
		
		$header = array('Artikelnummer', 'Artikel', 'Antal');
		
		class PDF extends FPDF {

			function materialTable($header, $data) {
				// Column widths
			   $w = array(50, 50, 35);
			   // Header
			   $this->Cell(10);
			   for($i=0;$i<count($header);$i++) {
				   $this->Cell($w[$i],7,$header[$i],1,0,'C');
				}
			   $this->Ln();
			   // Data
			   foreach($data as $row)
			   {
			   	$this->Cell(10);
			      $this->Cell($w[0],6,utf8_decode($row[0]),'LR');
			      $this->Cell($w[1],6,utf8_decode($row[1]),'LR');
			      $this->Cell($w[2],6,utf8_decode($row[2]),'LR',0,'R');
			      $this->Ln();
			   }
			   // Closing line
			   $this->Cell(10);
			   $this->Cell(array_sum($w),0,'','T');
			}
		
		}		
		
		//PDF
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Image($img,20,10,-300);
		
		$pdf->Cell(45);
		$pdf->Cell(100,10,utf8_decode('Björkenäs Fastighetsservice AB'),0,1,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,35,'',0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Arbetsorder nr:  '.$orderNo),0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Adress:  '.$address),0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Beställare:  '.$customerCompany),0,1);
		$pdf->Cell(10);
		$pdf->Cell(45,15,utf8_decode('Omfattning av arbete:'),0,0);
		$pdf->MultiCell(125,15,utf8_decode($description),0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Utfört av:  '.$userName.' '.$userCompany),0,1);
		if($startDate != '0000-00-00') {
			$pdf->Cell(10);
			$pdf->Cell(50,15,utf8_decode('Start datum:  '.$startDate),0,1);
		}
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Tid:  '.$duration.'  timmar'),0,1);
		$pdf->Cell(10);
		$pdf->Cell(50,15,utf8_decode('Resor:  '.$trips),0,1);
		
		if(count($materialData) > 10) {
			$pdf->AddPage();
		}
		$pdf->Cell(10);
		if(count($materialData) != 0) {
			$pdf->Cell(50,15,utf8_decode('Material:'),0,1);
			$pdf->materialTable($header, $materialData);
		} else {
			$pdf->Cell(50,15,utf8_decode('Material: Inget material att redovisa.'),0,1);
		}
		
		$pdf->Output($orderNo, 'I');
		
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>