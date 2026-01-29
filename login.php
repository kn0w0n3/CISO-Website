<?php
session_start();
if(isset($_SESSION['logged_in'])){
	header("Location: control_panel.php");
}
?>

<html>
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" type="text/css" href="style.css">
	  <link rel="stylesheet" type="text/css" href="main-card-style.css">
	  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	  <link rel="icon" type="image/png" href="images/logo/ciso_blue.png">
      <title>CISO | Login</title>
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
                  <a class="nav-link" href="opportunities">Opportunities</a>
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
         <div class="container-fluid" style="padding-right:0; padding-left:0; padding-bottom:200px;">
               <div class="d-flex h-100" style="padding-top:0px;">
               <div class="m-auto">
                  <div class ="card p-4">
                     <div class="m-auto">
                        <div style="text-align:center; padding-bottom: 20px;">
                           <img class="img-fluid" src="images/ciso_logo.png" alt="" width="150" height="50">
                        </div>
                        <form id="ajax-contact-lgin">
                           <div class="form-group">
                              <label for="username">Username:</label>
                              <input type="text" class="form-control" placeholder="Enter username" id="username">
                           </div>
                           <div class="form-group">
		                      <label for="pswd">Password:</label>
                              <input type="password" class="form-control"  placeholder="Enter password" id="pswd">
                           </div>
                           <div id="recaptcha" class="g-recaptcha" style="padding-top:20px;" data-sitekey="6LdQ-E4hAAAAAOojstRILiweBEIJ1jVWjbPQ-ZhK"></div>
                           <div style="Padding-top: 20px; text-align:center;">
                              <button type="submit" class="btn btn-primary" id="logsub">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="text-center" style="padding-top:20px;">
               <div class="alert alert-success fade show" role="alert" id="success" style="display:none;">
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
	  <script src="js/loginformcontrol.js"></script>
   </body>
</html>
