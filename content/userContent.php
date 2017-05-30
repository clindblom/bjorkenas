<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'], $db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');

	$activeUser = $_COOKIE['userID'];
	
	if($dbConnected) {
		
		$user_SQLselect = "SELECT * FROM user";
		$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect); 	
		
		if ($detect->isMobile()) {
			echo '<style>#userLink {background: #A0A0A0;}</style>';		
		} else {
			echo '<style>#userLink {background: black;}</style>';
		}
		
		echo '<h2>Användare</h2>';
		echo '<form id="createUserForm" name="createUserForm" action="index.php" method="get">
					<input type="hidden" name="content" value="newUser">
					<input class="btn btn-default" style="float:left; margin-right:10px;" type="submit"  value="Lägg till användare" />
				</form>';
		echo '<form id="logoutForm" name="logoutForm" action="index.php" method="post">
					<input type="hidden" name="status" value="logout">
					<input class="btn btn-default" id="logoutButton" type="submit" value="Logga ut" />
				</form>';
		echo '<table class="table" id="userTable">';	
		echo '<thead>';
			echo '<tr>'; 
				echo '<th>Namn</th>'; 
				echo '<th>Användarnamn</th>';
				echo '<th>Företag</th>';
				echo '<th>Epost</th>';
				echo '<th>Telefon</th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';	
		echo '</thead>';
	
		while ($row = mysqli_fetch_array($user_SQLselect_Query, MYSQLI_ASSOC)) {
			
			$id = $row['id'];
			$name = $row['name'];
			$username = $row['username'];
			$company = $row['company'];
			$mail = $row['mail'];
			$phone = $row['phone'];		
		echo '<tbody>';
			if ($activeUser == $id) {
				echo '<tr style="background-color:#F5F5F5">';
			} else {
				echo '<tr>';
			} 
				echo '<td>'.$name.'</td>'; 
				echo '<td>'.$username.'</td>';
				echo '<td>'.$company.'</td>';
				echo '<td>'.$mail.'</td>';
				if($phone != 0) {
					echo '<td>0'.$phone.'</td>';
				} else {
					echo '<td></td>';
				}
				echo '<td>
							<form name="editUserForm" action="index.php" method="get">
								<input type="hidden" name="content" value="editUser">
								<input type="hidden" name="userID" value="'.$id.'">
								<input class="btn btn-default" type="submit" value="Ändra">
							</form>
						</td>';
				echo '<td>
							<form name="deleteUserForm" action="include/user/deleteUser.php" method="post">
								<input type="hidden" name="userID" value="'.$id.'">
								<input class="btn btn-default" type="submit" value="Radera" onclick="return confirm(\'Är du säker?\')">
							</form>
						</td>';
			echo '</tr>';
		echo '</tbody>';
		}
		echo '</table>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>