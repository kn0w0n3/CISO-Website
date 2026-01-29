<?php
   session_start();
   if(!isset($_SESSION['logged_in'])){
   	header("Location: login.php");
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
      <link rel="stylesheet" type="text/css" href="css/control_panel_style.css">
	  <link rel="stylesheet" type="text/css" href="css/cred_style.css">
      <link rel="icon" type="image/png" href="images/logo/ciso_blue.png">	  
	  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	  
	  
      <title>CISO | Control Panel Credentials</title>
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
                  <a class="nav-link" href="control_panel.php">Members</a>
               </li>              
               <li class="nav-item">
                  <a class="nav-link" href="control_panel_mentorship.php">Mentorship</a>
               </li> 
			   <!-- Dropdown -->
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_c3p" data-toggle="dropdown">C3P</a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="c3p.php">C3P Schools</a>
                     <a class="dropdown-item" href="nonc3p.php">Non C3P Schools</a>
                  </div>
               </li> 
			   <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop_projects" data-toggle="dropdown">Projects</a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="project_funding_request.php">Project Funding Requests</a>
                  </div>
               </li>       
			   <li class="nav-item">
                  <a class="nav-link" href="#">Credentials</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
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
      <div class="text-center" style="padding-top:80px;">
         <img class="img-fluid" src="images/custom_page_text/control_panel_text.png" alt="" width="593" height="86"> 
      </div>
            <div class="container" style="padding-top:50px; max-width:600px">
               <div class="p-wrapper" style="text-align:center;" >
                  <p>The password for the control panel login can be changed here.</P>
               </div>
               <br>
               <form id="ajax-contact-cred">
                  <div class ="card" Style="padding-top: 50px; padding-bottom: 50px;">
                     <div style="text-align:center; padding-bottom: 50px;">
                        <img class="img-fluid" src="images/ciso_logo.png" alt="logo" width="192" height="86"> 
                     </div>
                     <div class="row">
                        <div class="col">
						<div class="form-group">
                              <label for="username">Username:</label>
                              <input type="text" class="form-control" placeholder="Username" id="username">
                           </div>
                           <div class="form-group">
                              <label for="curpass">Current Password:</label>
                              <input type="password" class="form-control" placeholder="Current Password" id="curpass">
                           </div>
                           <div class="form-group">
                              <label for="newpass">New Password:</label>
                              <input type="password" class="form-control" placeholder="New Password" id="newpass">
                           </div>
                           <div class="form-group">
                              <label for="confpass">Confirm Password:</label>
                              <input type="password" class="form-control" placeholder="Confirm New Password" id="confpass">
                           </div>
                        </div>
                     </div>
                     <div id="recaptcha" class="g-recaptcha" style="padding-top:30px;" data-sitekey="6LdQ-E4hAAAAAOojstRILiweBEIJ1jVWjbPQ-ZhK"></div>
                     <div style="Padding-top: 20px; text-align:center;">
                        <button type="submit" class="btn btn-primary"  id="change">Submit</button>
                     </div>
                  </div>
               </form>
               <div class="text-center" style="padding-top:20px;">
                  <div class="alert alert-success fade show" role="alert" id="success" style="display:none;">                 
                  </div>
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
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="js/pcredformcontrol.js"></script> 	  
 </body>
</html>