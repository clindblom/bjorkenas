<?php
	include('config/dbConfig.php'); 
	$dbSuccess = false;
	$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
	mysqli_set_charset($dbConnected, 'utf8');
	
	if($dbConnected) {
		$customerId = @$_GET['customerID'];
		
		$customer_SQLselect = 'SELECT * FROM customer WHERE customer_id="'.$customerId.'"';
		$customer_SQLselect_Query = mysqli_query($dbConnected, $customer_SQLselect); 	
	
		echo '<h2>Ändra information om kund</h2>';
		
		$row = mysqli_fetch_array($customer_SQLselect_Query, MYSQL_ASSOC);

		$id = $row['customer_id'];
		$name = $row['customer_name'];
		$company = $row['customer_company'];
		$mail = $row['customer_mail'];
		$phone = $row['customer_phone'];	
		
		
		echo '<form name="editCustomerForm" action="include/customer/editCustomerFunction.php" method="post">
					  <input name="editCustomerId" type="hidden" value="'.$id.'">
					  <div class="form-group">
					    <label for="editCustomerName">Namn</label>
					    <input type="text" class="form-control" id="editCustomerName" name="editCustomerName" value="'.$name.'">
					  </div>
					  <div class="form-group">
					    <label for="editCustomerCompany">Företag</label>
					    <input type="text" class="form-control" id="editCustomerCompany" name="editCustomerCompany" value="'.$company.'">
					  </div>
					  <div class="form-group">
					    <label for="editCustomerMail">Epost</label>
					    <input type="email" class="form-control" id="editCustomerMail" name="editCustomerMail" value="'.$mail.'">
					  </div>
					  <div class="form-group">
					    <label for="editCustomerPhone">Telefon</label>
					    <input type="text" class="form-control" id="editCustomerPhone" name="editCustomerPhone" value="0'.$phone.'">
					  </div>
					  <input class="btn btn-default" id="editCustomerSubmit" name="editCustomerSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
				</form>';
		echo '<form name="cancelUserEdit" action="index.php" method="get">
					  <input name="content" type="hidden" value="handleCustomer">
					  <input class="btn btn-default" name="cancelCustomerEditSubmit" type="submit" value="Avbryt">
			  </form>';

	} else {
		echo "<h2>Anslutning till databasen misslyckades!</h2>";
	}
?>