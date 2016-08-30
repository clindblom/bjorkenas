<?php
	
	$newCustomerName = $_POST['newCustomerName'];
	$newCustomerCompany = $_POST['newCustomerCompany'];
	$newCustomerMail = $_POST['newCustomerMail'];
	$newCustomerPhone = $_POST['newCustomerPhone'];

	createCustomer($newCustomerName, $newCustomerCompany, $newCustomerMail, $newCustomerPhone);

	function createCustomer($name, $company, $mail, $phone) {

		include('../../config/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {		
		
			$customer_SQLinsert = "INSERT INTO customer (customer_name, customer_company, customer_mail, customer_phone)";
			$customer_SQLinsert .= "VALUES ('".$name."', '".$company."', '".$mail."', '".$phone."')";
			
			$customer_SQLinsert_query = mysqli_query($dbConnected, $customer_SQLinsert);			

			header("Location: ../../index.php?content=handleCustomer");
		
		} else {
			return $dbSuccess;
			echo "<h2>Anslutning till databasen misslyckades!</h2>";
		}
		
	}
?>