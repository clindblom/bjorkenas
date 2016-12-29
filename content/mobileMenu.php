<?php
	echo '<div class="dropdown">
			<button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size:20px; text-decoration:none">Meny<span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" id="userLink" href="index.php?content=user">Användare</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="nPLink" href="index.php?content=newProject">Starta nytt projekt</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="hPLink" href="index.php?content=handleProject">Hantera pågående projekt</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="cILink" href="index.php?content=createInvoice">Skapa underlag</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="cPLink" href="index.php?content=completedProjects">Avslutade projekt</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="materialLink" href="index.php?content=handleMaterial">Hantera material</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="customerLink" href="index.php?content=handleCustomer">Hantera kunder</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" id="customerLink" href="index.php?content=reportTime">Rapportera tid</a></li>';
			echo '<li role="presentation">';
						include('include/logInAndOut/logoutForm.php');
			echo	'</li>';
		echo	'</ul>';
	echo '</div>';
?>