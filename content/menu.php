<?php
	echo '<div class="container">
				<ul class="nav navbar-nav">
					<li><a id="userLink" href="index.php?content=user">Användare</a></li>
					<li><a id="nPLink" href="index.php?content=newProject">Starta nytt projekt</a></li>
					<li><a id="hPLink" href="index.php?content=handleProject">Hantera pågående projekt</a></li>
					<li><a id="cILink" href="index.php?content=createInvoice">Skapa underlag</a></li>
					<li><a id="cPLink" href="index.php?content=completedProjects">Avslutade projekt</a></li>
					<li><a id="materialLink" href="index.php?content=handleMaterial">Hantera material</a></li>
					<li><a id="customerLink" href="index.php?content=handleCustomer">Hantera kunder</a></li>
					<li><a id="reportTimeLink" href="index.php?content=reportTime">Rapportera tid</a></li>';
			/* echo '<li>';
						include('include/logInAndOut/logoutForm.php');
			echo	'</li>'; */
		echo	'</ul>';
	echo '</div>';
?>