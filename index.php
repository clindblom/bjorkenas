<?php include_once('indexLogic.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Björkenäs Fastighetsservice</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="icon" href="images/house-detective_blue.jpg" type="image/x-icon" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	
	</head>
	<body>
		<div class="container" style="width:70%; margin: 0% 15% 0% 15%">
			
				<?php
				if (file_exists($menuFile) || file_exists($mobileMenuFile)) {
					
					if ($detect->isMobile()) {
						echo '<nav class="navbar navbar-inverse" style="background:#505050;">';
							echo '<div class="row">
							  <div class="col-xs-4">';
							  include($mobileMenuFile);
							  echo '</div>
							  <div class="col-xs-8"><h4 style="color:#fff;">Björkenäs Fastighetsservice AB</h4></div>
							</div>';
						echo '</nav>';
					} else {
						echo '<nav class="navbar navbar-inverse navbar-fixed-top" style="background:#505050;">';
							include($menuFile);
						echo '</nav>';
					}
					
				}
				?>
    		
			<div class="topDiv" style="margin-top:80px">
				<?php
				if (file_exists($menuFile) || file_exists($mobileMenuFile)) {
					if ($detect->isMobile()) {
						
					} else {
					    echo '<div>
									<h2 style="text-align:center; margin-top:80px;">Björkenäs Fastighetsservice AB</h2>
								</div>';
					}
				}
				?>
			</div>
			<div class="contentDiv" style="margin-bottom:30px;">
	      	<?php 
	      		if (file_exists($contentFile)) {
	      				include($contentFile);
	      			} 
			      if (!empty($contentMsg)) { echo $contentMsg; }
	      	?>
	      </div><!-- end contentDiv -->
		</div>
		
		<script type="text/javascript" src="config/jquery.min.js"></script>
		<script type="text/javascript" src="config/bootstrap.js"></script>
		
	</body>
</html>