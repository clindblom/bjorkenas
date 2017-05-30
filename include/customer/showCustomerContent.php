<?php

include('showCustomerFunction.php');
$customer = customerDropdown('');

	if ($detect->isMobile()) {
		echo '<style>#customerLink {background: #A0A0A0;}</style>';
	} else {
		echo '<style>#customerLink {background: black;}</style>';
	}

echo '<h2>Välj en kund att visa</h2>';

echo	'<form id="showCustomerForm" name="showCustomerForm" action="index.php" method="get">
			  <input type="hidden" name="content" value="displayCustomer">
			  <div class="form-group">
			    <label for="displayCustomer">Beställare</label>
			    '.$customer.'
			  </div>
			  <input class="btn btn-default" type="submit" value="Ok" style="float:left; margin-right:10px;">
		</form>';
		echo '<form name="cancelDisplayCustomer" action="index.php" method="get">
						<input name="content" type="hidden" value="handleCustomer">
						<input class="btn btn-default" name="cancelDisplayCustomerSubmit" type="submit" value="Tillbaka">
				</form>';
?>