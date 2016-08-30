<?php

	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');	
	
	if($dbConnected) {
		
		$editUserId = $_POST['editUserId'];
		$editUserName = $_POST['editUserName'];
		$editUserUserName = $_POST['editUserUserName'];
		$editUserPassword = $_POST['editUserPassword'];
		$editUserMail = $_POST['editUserMail'];
		$editUserPhone = $_POST['editUserPhone'];
		
		$md5Password = md5($editUserPassword);
		
		if($editUserPassword == "") {
			$user_SQLupdate = "UPDATE user SET name='".$editUserName."', ";
			$user_SQLupdate .= "username='".$editUserUserName."', ";
			$user_SQLupdate .= "mail='".$editUserMail."', phone='".$editUserPhone."' WHERE id='".$editUserId."'";
		} else {
			$user_SQLupdate = "UPDATE user SET name='".$editUserName."', ";
			$user_SQLupdate .= "username='".$editUserUserName."', password='".$md5Password."', ";
			$user_SQLupdate .= "mail='".$editUserMail."', phone='".$editUserPhone."' WHERE id='".$editUserId."'";
		}
		
		$user_SQLupdate_query = mysqli_query($dbConnected, $user_SQLupdate);

		header("Location: ../../index.php?content=user");
	
	} else {
		return $dbSuccess;	
	}
?>