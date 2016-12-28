<?php

include('newProjectFunction.php');
$customer = customerDropdown('');
$user = userDropdown('');

if ($detect->isMobile()) {
			echo '<style>#nPLink {background: #A0A0A0;}</style>';		
		} else {
			echo '<style>#nPLink {background: black;}</style>';
		}

echo '<h2>Starta ett nytt projekt</h2>';

echo	'<form name="createProjectForm" action="include/project/newProjectSave.php" method="post">
			  <div class="form-group">
			    <label for="projectNo">Arbetsorder nummer</label>
			    <input type="text" class="form-control" id="newProjectNumber" name="newProjectNumber" placeholder="Arbetsorder">
			  </div>
			  <div class="form-group">
			    <label for="projectAddress">Adress</label>
			    <input type="text" class="form-control" id="newProjectAddress" name="newProjectAddress" placeholder="Adress">
			  </div>
			  <div class="form-group">
			    <label for="projectStartDate">Startdatum</label>
			    <input class="form-control" type="date" id="newProjectStartDate" name="newProjectStartDate">
			  </div>
			  <div class="form-group">
			    <label for="projectCustomer">Beställare</label>
			    '.$customer.'
			  </div>
			  <div class="form-group">
			    <label for="projectUser">Tilldelat</label>
			    '.$user.'
			  </div>
			  <div class="form-group">
			    <label for="projectDescription">Beskrivning</label>
			    <textarea class="form-control" name="newProjectDescription" rows="2" cols="40"></textarea>
			  </div>
			  <input class="btn btn-default" id="newProjectSubmit" name="newProjectSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
		</form>';
		echo '<form name="cancelNewProject" action="index.php" method="get">
						<input name="content" type="hidden" value="handleProject">
						<input class="btn btn-default" name="cancelNewProjectSubmit" type="submit" value="Avbryt">
				</form>';
?>