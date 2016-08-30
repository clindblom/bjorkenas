<?php
	
	$newUserName = $_POST['newUserName'];
	$newUserUserName = $_POST['newUserUserName'];
	$newUserCompany = $_POST['newUserCompany'];
	$newUserPassword = $_POST['newUserPassword'];
	$newUserPassword2 = $_POST['newUserPassword2'];
	$newUserMail = $_POST['newUserMail'];
	$newUserPhone = $_POST['newUserPhone'];
	
	$infoArray = [$newUserName, $newUserUserName, $newUserCompany, $newUserPassword, $newUserPassword2, $newUserMail, $newUserPhone];
	
	$takenUserNames = unserialize(@$_COOKIE['users']);
	$userNameNotAvailable = false;

	if(array_search($newUserUserName, $takenUserNames)) {
		$userNameNotAvailable = true;
	}
	
	if(($newUserPassword == $newUserPassword2) AND ($newUserPassword != "" AND $newUserPassword2 != "" AND 
		$newUserUserName != "") AND ($userNameNotAvailable == false)) {
		createUser($newUserName, $newUserUserName, $newUserCompany, $newUserPassword, $newUserMail, $newUserPhone);
	} else {
		setcookie("addUserInfo", serialize($infoArray), time()+600, "/");
		header("Location: ../../index.php?content=newUser");
	}


	function createUser($name, $username, $company, $password, $mail, $phone) {

		include('../../config/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysqli_connect($db['hostname'],$db['username'], $db['password'],$db['database']);
		mysqli_set_charset($dbConnected, 'utf8');
		
		if($dbConnected) {		
		
			$md5Password = md5($password);					
			
			$user_SQLinsert = "INSERT INTO user (name, username, company, password, mail, phone)";
			$user_SQLinsert .= "VALUES ('".$name."', '".$username."', '".$company."', '".$md5Password."', '".$mail."', '".$phone."')";
			
			$user_SQLinsert_query = mysqli_query($dbConnected, $user_SQLinsert);			

			setcookie("addUserInfo", "", time()-7200, "/");
			header("Location: ../../index.php?content=user");
		
		} else {
			return $dbSuccess;
			echo "<h2>Anslutning till databasen misslyckades!</h2>";	
		}
		
	}
?>