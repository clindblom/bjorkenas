<?php
	require('../../config/fpdf17/fpdf.php');
		
	$img = '../../images/house-detective_brown.jpg';
	
	$header = array('Artikelnummer', 'Artikel', 'Antal');

	//PDF
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Image($img,20,10,-300);
	
	$pdf->Cell(45);
	$pdf->Cell(100,10,utf8_decode('Björkenäs Fastighetsservice AB'),0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,35,'',0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Arbetsorder nr:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Adress:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Beställare:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(45,15,utf8_decode('Omfattning av arbete:'),0,1);
	$pdf->Cell(10);
	$pdf->Cell(45,40,utf8_decode(''),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Utfört av:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Start datum:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Tid (timmar):'),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Resor:  '),0,1);
	$pdf->Cell(10);
	$pdf->Cell(50,15,utf8_decode('Material: '),0,1);
	
	
	$pdf->Output($orderNo, 'I');
	
	
?>