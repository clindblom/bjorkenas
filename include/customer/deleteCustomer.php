<?php
	$customerID = $_POST['customerID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {		

		$customer_SQLdelete = "DELETE FROM customer WHERE customer_id='".$customerID."'";
		
		$customer_SQLdelete_query = mysqli_query($dbConnected, $customer_SQLdelete);			

		header("Location: ../../index.php?content=handleCustomer");
	
	} else {
		return $dbSuccess;		
	}

?>