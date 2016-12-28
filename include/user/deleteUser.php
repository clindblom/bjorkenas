<?php
	$userId = $_POST['userID'];
	
	include('../../config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {		
	
		$md5Password = md5($password);					
		
		$user_SQLdelete = "DELETE FROM user WHERE id='".$userId."'";
		
		$user_SQLdelete_query = mysqli_query($dbConnected, $user_SQLdelete);			

		header("Location: ../../index.php?content=user");
	
	} else {
		return $dbSuccess;		
	}

?>