<?php
	echo '<!DOCTYPE html>';
	echo '<title>Björkenäs Fastighetsservice</title>';
	echo '<link href="../../css/signin.css" rel="stylesheet">';
	echo '<link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" />';
	echo '<link rel="icon" href="../../images/house-detective_blue.jpg" type="image/x-icon" />';
	echo '<div class="container">';
		echo '<form class="form-signin" name="loginForm" action="../../index.php" method="post">';	
					
		echo '<img style="width:150px; height:150px; float:left; margin:10px 0 10px 0;" id="logo" src="../../images/house-detective_blue.jpg" alt="BFS">
				<label for="inputUsername" class="sr-only">Användarnamn</label>
				<input type="text" name="username" id="inputUsername" class="form-control" placeholder="Användarnamn" required="" autofocus="">
				<label for="inputPassword" class="sr-only">Lösenord</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Lösenord" required="">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>';
			
		echo '</form>';
	echo '</div>';
	
?>