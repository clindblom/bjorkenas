<?php

$newUserInfo = unserialize(@$_COOKIE['addUserInfo']);

echo '<h2>Lägg till användare</h2>';

$takenUserNames = unserialize(@$_COOKIE['users']);

if(array_search($newUserInfo[1], $takenUserNames)) {
	echo '<h3>Användarnamnet är taget!</h3>';
}

if(($newUserInfo != null) AND ($newUserInfo[3] != $newUserInfo[4])) {
	echo '<h3>Lösenorden matchar inte!</h3>';
} elseif(($newUserInfo != null) AND (($newUserInfo[3] == "") OR ($newUserInfo[4] == ""))) {
	echo '<h3>Lösenordet får inte vara blankt!</h3>';
} elseif(($newUserInfo != null) AND ($newUserInfo[1] == "")) {
	echo '<h3>Användarnamnet får inte vara blankt!</h3>';
}

echo '<form name="createUserForm" action="include/user/createUserFunction.php" method="post">
			  <div class="form-group">
			    <label for="newUserName">Namn</label>
			    <input type="text" class="form-control" id="newUserName" name="newUserName" value="'.$newUserInfo[0].'">
			  </div>
			  <div class="form-group">
			    <label for="newUserUserName">Användarnamn</label>
			    <input type="text" class="form-control" id="newUserUserName" name="newUserUserName" value="'.$newUserInfo[1].'">
			  </div>
			  <div class="form-group">
			    <label for="newUserCompany">Företag</label>
			    <input type="text" class="form-control" id="newUserCompany" name="newUserCompany" value="'.$newUserInfo[2].'">
			  </div>
			  <div class="form-group">
			    <label for="newUserPassword">Lösenord</label>
			    <input type="password" class="form-control" id="newUserPassword" name="newUserPassword">
			  </div>
			  <div class="form-group">
			    <label for="newUserPassword2">Lösenord igen</label>
			    <input type="password" class="form-control" id="newUserPassword2" name="newUserPassword2">
			  </div>
			  <div class="form-group">
			    <label for="newUserMail">Epost</label>
			    <input type="email" class="form-control" id="newUserMail" name="newUserMail" value="'.$newUserInfo[5].'">
			  </div>
			  <div class="form-group">
			    <label for="newUserPhone">Telefonnummer</label>
			    <input type="text" class="form-control" id="newUserPhone" name="newUserPhone" value="'.$newUserInfo[6].'">
			  </div>
			  <input class="btn btn-default" id="newUserSubmit" name="newUserSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
		</form>';
echo '<form name="cancelNewUser" action="index.php" method="get">
				<input name="content" type="hidden" value="user">
				<input class="btn btn-default" name="cancelNewUserSubmit" type="submit" value="Avbryt">
		</form>';
?>