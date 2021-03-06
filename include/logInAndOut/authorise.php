<?php	

	function userAuthorised($dbConnected, $username, $password) {

			mysqli_query($dbConnected, "SET NAMES 'utf8'");

			$md5Password = md5($password);
			$sqlQueryStatement = "SELECT ID, password FROM user ";
			$sqlQueryStatement .= "WHERE username = '".$username."' ";	

			$sqlQuery = mysqli_query($dbConnected, $sqlQueryStatement); 	
			while ($row = mysqli_fetch_array($sqlQuery, MYSQLI_ASSOC)) {
			    $userID = $row['ID'];
			    $passwordRetrieved = $row['password'];
			}
		
			mysqli_free_result($sqlQuery);
						
			if (!empty($passwordRetrieved) AND ($md5Password == $passwordRetrieved)) {
	
					//setcookie("accessLevel", $accessLevel, time()+7200, "/");	
					setcookie("userID", $userID, time()+7200, "/");	
					setcookie("loginAuthorised", "914d262a2299841d5cc52a956009b44b", time()+7200, "/");
					
					$returnCode = true;
								
			} else {
				$returnCode = false;			
			}
			
		return $returnCode;
	}

	function setUsersCookie() {
		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');		
		mysqli_query($dbConnected, "SET NAMES 'utf8'");
		
		$sqlQueryStatement = "SELECT id, username FROM user";
		$sqlQuery = mysqli_query($dbConnected, $sqlQueryStatement);
		
		$users = array();
		while ($row = mysqli_fetch_array($sqlQuery, MYSQLI_ASSOC)) {
			$users[$row['id']] = $row['username'];
		}
		
		mysqli_free_result($sqlQuery);
		
		setcookie("users", serialize($users), time()+7200, "/");
	}
	
	function setCustomersCookie() {
		include('config/dbConfig.php'); 
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');	
		mysqli_query($dbConnected, "SET NAMES 'utf8'");
		
		$sqlQueryStatement = "SELECT customer_id, customer_company FROM customer";
		$sqlQuery = mysqli_query($dbConnected, $sqlQueryStatement);
		
		$customer = array();
		while($row = mysqli_fetch_array($sqlQuery, MYSQLI_ASSOC)) {
			//array_push($customer, ($row['customer_id'] => $row['customer_name']));
			$customer[$row['customer_id']] = $row['customer_company'];
		}
		
		mysqli_free_result($sqlQuery);
		
		setcookie("customers", serialize($customer), time()+7200, "/");
		
	}

?>