<?php

	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');	
	
	if($dbConnected) {
		
		$editCustomerId = $_POST['editCustomerId'];
		$editCustomerName = $_POST['editCustomerName'];
		$editCustomerCompany = $_POST['editCustomerCompany'];
		$editCustomerMail = $_POST['editCustomerMail'];
		$editCustomerPhone = $_POST['editCustomerPhone'];
		
		$customer_SQLupdate = "UPDATE customer SET customer_name='".$editCustomerName."', ";
		$customer_SQLupdate .= "customer_company='".$editCustomerCompany."', ";
		$customer_SQLupdate .= "customer_mail='".$editCustomerMail."', customer_phone='".$editCustomerPhone."'";
		$customer_SQLupdate .= " WHERE customer_id='".$editCustomerId."'";
		
		$customer_SQLupdate_query = mysqli_query($dbConnected, $customer_SQLupdate);

		header("Location: ../../index.php?content=handleCustomer");
	
	} else {
		return $dbSuccess;	
	}
?>