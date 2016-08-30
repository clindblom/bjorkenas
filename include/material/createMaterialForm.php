<?php

echo '<h2>Lägg till material</h2>';

echo '<form name="createMaterialForm" action="include/material/createMaterialFunction.php" method="post">
			  <div class="form-group">
			    <label for="newMaterialName">Artikel-namn</label>
			    <input type="text" class="form-control" id="newMaterialName" name="newMaterialName">
			  </div>
			  <div class="form-group">
			    <label for="newMaterialNumber">Artikel-nummer</label>
			    <input type="text" class="form-control" id="newMaterialNumber" name="newMaterialNumber">
			  </div>
			  <div class="form-group">
			    <label for="newMaterialCost">Pris</label>
			    <input type="text" class="form-control" id="newMaterialCost" name="newMaterialCost">
			  </div>
			 
			  <input class="btn btn-default" id="newMaterialSubmit" name="newMaterialSubmit" type="submit" value="Ok" style="float:left; margin-right:10px;">
		</form>';
echo '<form name="cancelNewMaterial" action="index.php" method="get">
				<input name="content" type="hidden" value="handleMaterial">
				<input class="btn btn-default" name="cancelNewUserSubmit" type="submit" value="Avbryt">
		</form>';
?>