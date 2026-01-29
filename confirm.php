<?php
    require "PHPMailer/PHPMailerAutoload.php";
    include 'database.php';
	function redirect() {
		header('Location: index.html');
		exit();
	}

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {

		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);
		$first_name = $conn->real_escape_string($_GET['first_name']);

		$sql = $conn->query("SELECT id FROM members WHERE email='$email' AND token='$token' AND email_confirmed=0");

		if ($sql->num_rows > 0) {
			    $conn->query("UPDATE members SET email_confirmed=1, token='' WHERE email='$email'");			
			    $automailx = new PHPMailer;
				$automailx->isSMTP();                                      // Set mailer to use SMTP
				$automailx->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
				$automailx->SMTPAuth = true;                               // Enable SMTP authentication
				$automailx->Username = 'autoreply@ciso-csusb.org';         // SMTP username
				$automailx->Password = '1nf0$3cC1$0W3b';                   // SMTP password
				$automailx->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$automailx->Port = 465;                                    // TCP port to connect to
				$automailx->setFrom('autoreply@ciso-csusb.org');
				$automailx->addAddress($email);                            // Add a recipient				
				$automailx->isHTML(true);                                  // Set email format to HTML
				$automailx->Subject = 'Welcome to CISO';
				$automailx->Body    = "Hello $first_name,<br><br>
                       				   Welcome to CISO. Your email has been verified. You are now an official member of CISO! Please use the following link to join the CISO Teams channel:<br><br>
				                       <a href='https://teams.microsoft.com/l/team/19%3ad7183708ea4148dca29b49b5170e48de%40thread.tacv2/conversations?groupId=93ee07dc-af5d-4f74-888a-d2484a90bd1f&tenantId=d73b9eaa-07c9-47c4-a6ce-f13bee0e8117'>Click here to join our channel on Microsoft Teams</a><br><br>
									   When logging in, use @csusb.edu instead of coyote.csusb.edu when asked for your email address. Ex: 123456789@csusb.edu<br><br><br>									   
									   If you have any questions, feel free to reach out to an officer. You can find a list of current officers on the CISO website under the officers tab.<br><br>
									   <a href='https://ciso-csusb.org'>ciso-csusb.org</a><br><br>
									   Please feel free to introduce yourself once you join the channel. We look forward to hearing from you!<br><br><br>
									   v/r<br>
									   CISO Team";						

				if(!$automailx->send()) {
					$msg = 'Something went wrong.';
				} else {					
				$msg = 'Your email has been verified! Please check your email!';
				}
		} else
			redirect();
	}
	?>
<!doctype html>
<html lang="en">
	<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" type="text/css" href="stylec.css">
	  <link rel="icon" type="image/png" href="images/logo/ciso_blue.png">
      <title>CISO | Verify Email</title>
   </head>
   <body>
         <nav class="navbar navbar-expand-md py-0 bg-dark navbar-dark fixed-top flex-row">
         <!-- Brand -->
         <a class="navbar-brand d-flex w-50 mr-0" href="index"><img src="images/ciso_logo.png" alt="logo" height="50" style="width:150px;"></a>
         <!-- Toggler/collapsibe Button -->
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon"></span>
         </button>
         <!-- Navbar links -->
         <div class="collapse navbar-collapse w-100" id="collapsibleNavbar">
            <ul class="navbar-nav mx-sm-auto">
               <li class="nav-item">
                  <a class="nav-link" href="index">Home</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_1" data-toggle="dropdown">Officers</a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="current_officers">Current Officers</a>
                     <a class="dropdown-item" href="previous_officers">Previous Officers</a>
                     <a class="dropdown-item" href="officer_election">Officer Election</a>
					 <a class="dropdown-item" href="csc">Cybersecurity Center</a>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="calendar">Calendar</a>
               </li>
               <!-- Dropdown -->
             <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_2" data-toggle="dropdown">Projects</a>
                  <div class="dropdown-menu">
				     <a class="dropdown-item" href="projects/ccdc_project">CCDC</a>
					 <a class="dropdown-item" href="projects/database_management">Database Management</a>
					 <a class="dropdown-item" href="projects/digital_forensics">Digital Forensics</a>
                     <a class="dropdown-item" href="projects/hacking_the_matrix">Hacking The Matrix</a>
					 <a class="dropdown-item" href="projects/planting_your_flag">Planting Your Flag</a>
					 <a class="dropdown-item" href="projects/red_hat_academy">Red Hat Academy</a>
					 <a class="dropdown-item" href="projects/the_purple_team_experience">The Purple Team Experience</a>
					 <a class="dropdown-item" href="projects/pentestbed">VM Pentestbed</a>                           
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="proj_schedule">Project Schedule</a>
                     <a class="dropdown-item" href="start_a_project">Start a Project</a>
					 <a class="dropdown-item" href="request_project_funding">Request Project Funding</a>
                     <a class="dropdown-item" href="past_projects">Past Projects</a>
                  </div>
               </li>
               <!-- Dropdown -->
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_3" data-toggle="dropdown">Competitions</a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="ccdc">CCDC</a>
                     <a class="dropdown-item" href="ncl">NCL</a>
                     <a class="dropdown-item" href="itc">ITC</a>									
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_4" data-toggle="dropdown">Events</a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="upcoming_events">Upcoming Events</a>									
                  </div>
               </li>			   
               <li class="nav-item">
                  <a class="nav-link" href="resources">Resources</a>
               </li>
			   <li class="nav-item">
                  <a class="nav-link" href="mentorship">Mentorship</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="cyber_squad">CyberSquad</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="gencyber">GenCyber</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="wicys">WiCyS</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="about">About</a>
               </li>
            </ul>
         </div>
         <div class="d-flex w-50">
            <!-- placeholder to keep links centered-->
         </div>
      </nav>
      <!-- Beginning of container-->
      <div class="fluid-bg-gradient">
         <div class="container-fluid" style="padding-right:0; padding-left:0; padding-bottom:450px; margin-top:0;  padding-top:100px;">
            <div class="text-center" style="padding-top: 80px;">
              <p style="color:white;"> <?php if ($msg != "") echo $msg . "<br><br>" ?><p>
            </div>
            <div class="container" style="padding-top:50px; padding-bottom:00px; text-align:left;">
               <div class="p-wrapper">                                  
               </div>
            </div>
			<div class="text-center" style="padding-top:30px;">
			<div class="round-images">
               <img class="img-fluid" src="images/logo/ciso_blue.png" alt="logo" width="350" height="200"> 
			   </div>
            </div>
         </div>
      </div>
      <!-- End of container-->
      <!-- Footer -->
      <div class="container-fluid" style="padding-right:0; padding-left:0; padding-top:50px; padding-bottom:10px; background-image: url('images/backgrounds/footerbg.png'); background-size:cover; background-repeat:no-repeat;">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-4" style="text-align:center; color:white; padding-top:10px; padding-bottom:10px;">
                  <h3>Follow us on social media</h3>               
                  <i><a href="https://www.instagram.com/csusb.ciso/"><img class="img-fluid" src="images/social_icon_images/instagram.png"  alt="Instagram" width="75" height="75"></a></i>
                  <i><a href="https://www.facebook.com/csusb.ciso/"><img class="img-fluid" src="images/social_icon_images/facebook.png" alt="" width="75" height="75"></a></i>
			      <i><a href="https://www.linkedin.com/company/cyber-intelligence-and-security-organization"><img class="img-fluid" src="images/social_icon_images/linkedin.png" alt="" width="75" height="75"></a></i>
               </div>
               <div class="col-sm-4" style="text-align:center; color:white; padding-top:0px; padding-bottom:10px;">
                  <a href="#"><img src="images/logo/ciso_logo_new.png" alt="logo" width="200" height="200"></a>
               </div>
               <div class="col-sm-4" style="text-align:center; color:white; padding-top:10px; padding-bottom:10px;">
                  <h3>Visit our lab</h3>
                  <i class="fa fa-map-marker fa-6x" aria-hidden="true"></i> 
                  <span>Located in JB122</span><br>
                  <span>5500 University Pkwy</span> <br>
                  <span>San Bernardino, CA 92407</span><br>
                  <span>ciso.csusb@gmail.com</span><br>				  
               </div>
            </div>
            <div class="row" >
               <div class="container" style="padding-top:0px; padding-bottom:0px; text-align:center;">
                  <p style=" color:white;">Copyright © 2021 ciso-csusb. All rights reserved</p>
               </div>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </body>
</html>