<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$userId = @$_GET['userID'];
		$presentUserId = $_COOKIE['userID'];
		
		$user_SQLselect = 'SELECT * FROM user WHERE id="'.$userId.'"';
		$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect); 	
	
		$row = mysqli_fetch_array($user_SQLselect_Query, MYSQL_ASSOC);

		$id = $row['id'];
		$name = $row['name'];
		$username = $row['username'];
		$password = $row['password'];
		$mail = $row['mail'];
		$phone = $row['phone'];	
	
	
		echo '<form name="editUserForm" action="include/user/editUserFunction.php" method="post">
					  <input name="editUserId" type="hidden" value="'.$id.'">
					  <div class="form-group">
					    <label for="editUserName">Namn</label>
					    <input type="text" class="form-control" id="editUserName" name="editUserName" value="'.$name.'">
					  </div>
					  <div class="form-group">
					    <label for="editUserUserName">Användarnamn</label>
					    <input type="text" class="form-control" id="editUserUserName" name="editUserUserName" value="'.$username.'">
					  </div>';
		
				  if($userId == $presentUserId) {
					  echo '<div class="form-group">
					    		<label for="editUserPassword">Lösenord</label>
					    		<input type="password" class="form-control" id="editUserPassword" name="editUserPassword">
					  		</div>';
					}
					  
					  
		echo		 '<div class="form-group">
					    <label for="editUserMail">Epost</label>
					    <input type="email" class="form-control" id="editUserMail" name="editUserMail" value="'.$mail.'">
					  </div>
					  <div class="form-group">
					    <label for="editUserPhone">Telefonnummer</label>
					    <input type="text" class="form-control" id="editUserPhone" name="editUserPhone" value="0'.$phone.'">
					  </div>
					  <input class="btn btn-default" id="editUserSubmit" name="editUserSubmit" type="submit" value="Ändra användare" style="float:left; margin-right:10px;">
				</form>';
		echo 	'<form name="cancelUserEdit" action="index.php" method="get">
						<input name="content" type="hidden" value="user">
						<input class="btn btn-default" name="cancelEditUserSubmit" type="submit" value="Avbryt">
				</form>';
	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>