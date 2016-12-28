<?php
	echo '<link href="css/signin.css" rel="stylesheet">';
	echo '<div class="container">';
		echo '<form class="form-signin" name="loginForm" action="index.php" method="post">';	
					
		echo '<img style="width:150px; height:150px; float:left; margin:10px 0 10px 0;" id="logo" src="images/house-detective_blue.jpg" alt="BFS">
				<label for="inputUsername" class="sr-only">Användarnamn</label>
				<input type="text" name="username" id="inputEmail" class="form-control" placeholder="Användarnamn" required="" autofocus="">
				<label for="inputPassword" class="sr-only">Lösenord</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Lösenord" required="">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>';
			
		echo '</form>';
	echo '</div>';
	
?>