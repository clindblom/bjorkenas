<?php

	header('Content-Type: text/html; charset=utf-8');

	{ 		//	Secure Connection Script
			include('config/dbConfig.php'); 
			$dbSuccess = false;
			$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);
			
			if ($dbConnected) {		
				$dbSelected = mysqli_select_db($dbConnected,$db['database']);
				if ($dbSelected) {
					$dbSuccess = true;
				} 	
			}
			//	END	Secure Connection Script
	}

	if($dbSuccess) {
		include_once('include/logInAndOut/authorise.php');
		include('config/Mobile_Detect.php');
		$detect = new Mobile_Detect();
		
		setUsersCookie();
		setCustomersCookie();

		$menuFile = '';
		$mobileMenuFile = '';
		$contentFile = '';
		$contentMsg = '';		
		
		$status = @$_POST['status'];
		$loginAuthorised = (@$_COOKIE["loginAuthorised"] == "914d262a2299841d5cc52a956009b44b");
		
		if($loginAuthorised) {
			
			if((isset($status)) AND ($status == "logout")) {
				setcookie("loginAuthorised", "", time()-7200, "/");
				header("Location: index.php");
			} else {
				$menuFile = "content/menu.php";
				$mobileMenuFile = "content/mobileMenu.php";
				
				$contentCode = @$_GET['content'];
				
				switch ($contentCode) {
				    case "user":
				    	  if(@$_GET['cancelNewUserSubmit'] == "Avbryt") {
						  		setcookie("addUserInfo", "", time()-7200, "/");
				    	  }
				        $contentFile = "content/userContent.php"; 
				        break;
				    case "newUser":
				        $contentFile = "include/user/createUserForm.php";
				        break;
				    case "editUser":
				        $contentFile = "include/user/editUser.php"; 
				        break;
				    case "newProject":
				        $contentFile = "include/project/newProjectForm.php";
				        break;
				    case "handleProject":
				        $contentFile = "content/projectContent.php";
				        break;
				    case "editProject":
				        $contentFile = "include/project/editProject.php";
				        break;
				    case "completedProjects":
				        $contentFile = "include/project/completedProjects.php";
				        break;
				    case "createInvoice":
				        $contentFile = "content/createInvoice.php";
				        break;
				    case "handleMaterial":
				        $contentFile = "content/materialContent.php";
				        break;
				    case "newMaterial":
				        $contentFile = "include/material/createMaterialForm.php";
				        break;
				    case "editMaterial":
				        $contentFile = "include/material/editMaterial.php";
				        break;
				    case "showMaterial":
				        $contentFile = "include/material/showMaterial.php";
				        break;
				    case "addMaterial":
				        $contentFile = "include/material/addMaterial.php";
				        break;
					 case "handleCustomer":
				        $contentFile = "content/customerContent.php";
				        break;
				    case "newCustomer":
				        $contentFile = "include/customer/createCustomerForm.php";
				        break;
				    case "showCustomer":
				        $contentFile = "include/customer/showCustomerContent.php";
				        break;
				    case "displayCustomer":
				        $contentFile = "include/customer/displayCustomer.php";
				        break;
				    case "editCustomer":
				        $contentFile = "include/customer/editCustomer.php";
				        break;
				    case "reportTime":
				        $contentFile = "include/timeReport/chooseWeekTR.php";
				        break;
				    case "chosenWeek":
				        $contentFile = "include/timeReport/timeReportForm.php";
				        break;
				}	// End of switch									
							
			}
			
		} else {
			
			$username = @$_POST['username'];
			$password = @$_POST['password'];
			if (userAuthorised($dbConnected, $username, $password)) {
				header("Location: index.php");
			} else {
				include('include/logInAndOut/loginForm.php');
			}
			
		}
		
	} else {
		$contentMsg = 'No database connection.';
	}
	
?>

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