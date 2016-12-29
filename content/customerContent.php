<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		
		$user_SQLselect = "SELECT * FROM customer";
		$user_SQLselect_Query = mysqli_query($dbConnected, $user_SQLselect); 	
	
		if ($detect->isMobile()) {
			echo '<style>#customerLink {background: #A0A0A0;}</style>';
		} else {
			echo '<style>#customerLink {background: black;}</style>';
		}
		
		echo '<h2>Kunder</h2>';
		echo '<form id="createCustomerForm" name="createCustomerForm" action="index.php" method="get">
					<input type="hidden" name="content" value="newCustomer">
					<input class="btn btn-default" type="submit"  value="Lägg till kund" style="float:left; margin-right:10px"; />
				</form>';
		echo '<form name="showCustomerForm" name="showCustomerForm" action="index.php" method="get">
					<input type="hidden" name=content value="showCustomer">
					<input class="btn btn-default" type="submit"  value="Visa kund"/>
				</form>';
		echo '<table class="table" id="customerTable">';	
	
		echo '<thead>';
			echo '<tr>'; 
				echo '<th>Namn</th>'; 
				echo '<th>Företag</th>';
				echo '<th>Epost</th>';
				echo '<th>Telefon</th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($row = mysqli_fetch_array($user_SQLselect_Query, MYSQLI_ASSOC)) {
			
			$id = $row['customer_id'];
			$name = $row['customer_name'];
			$company = $row['customer_company'];
			$mail = $row['customer_mail'];
			$phone = $row['customer_phone'];		
			
			echo '<tr>'; 
				echo '<td>'.$name.'</td>'; 
				echo '<td>'.$company.'</td>';
				echo '<td>'.$mail.'</td>';
				if($phone != 0) {
					echo '<td>0'.$phone.'</td>';
				} else {
					echo '<td></td>';
				}
				echo '<td>
							<form name="editCustomerForm" action="index.php" method="get">
								<input type="hidden" name="content" value="editCustomer">
								<input type="hidden" name="customerID" value="'.$id.'">
								<input class="btn btn-default" type="submit" value="Ändra">
							</form>
						</td>';
				echo '<td>
							<form name="deleteCustomerForm" action="include/customer/deleteCustomer.php" method="post">
								<input type="hidden" name="customerID" value="'.$id.'">
								<input class="btn btn-default" type="submit" value="Radera" onclick="return confirm(\'Är du säker?\')">
							</form>
						</td>';
			echo '</tr>';
		
		}
		echo '</tbody>';
		echo '</table>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>