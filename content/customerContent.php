<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$sorting = @$_GET['sort'];

		if($sorting == "name") {
			$customer_SQLselect = "SELECT * FROM customer ORDER BY customer_name";
		} else if ($sorting == "company") {
			$customer_SQLselect = "SELECT * FROM customer ORDER BY customer_company";
		} else if ($sorting == "mail") {
			$customer_SQLselect = "SELECT * FROM customer ORDER BY customer_mail";
		} else if ($sorting == "phone") {
			$customer_SQLselect = "SELECT * FROM customer ORDER BY customer_phone";
		} else {
			$customer_SQLselect = "SELECT * FROM customer";
		}

		$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect); 	
	
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
				echo '<th><a href="index.php?content=handleCustomer&sort=name" style="color:black;'; if(@$_GET['sort'] == 'name') {echo 'text-decoration:underline;';} echo '">Namn</a></th>';
				echo '<th><a href="index.php?content=handleCustomer&sort=company" style="color:black;'; if(@$_GET['sort'] == 'company') {echo 'text-decoration:underline;';} echo '">Företag</a></th>';
				echo '<th><a href="index.php?content=handleCustomer&sort=mail" style="color:black;'; if(@$_GET['sort'] == 'mail') {echo 'text-decoration:underline;';} echo '">Epost</a></th>';
				echo '<th><a href="index.php?content=handleCustomer&sort=phone" style="color:black;'; if(@$_GET['sort'] == 'phone') {echo 'text-decoration:underline;';} echo '">Telefon</a></th>';
				echo '<th></th>';
				echo '<th></th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		while ($row = mysqli_fetch_array($customer_SQLselect_Query, MYSQLI_ASSOC)) {
			
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