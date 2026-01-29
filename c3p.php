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
      <link rel="icon" type="image/png" href="images/logo/ciso_blue.png">
	  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	  
	  
      <title>CISO | c3p</title>
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
                  <a class="nav-link" href="control_panel_credentials.php">Credentials</a>
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
      <div class="container-fluid" style="margin-top:30px; max-width:1875px;">
         <div id="tableManager" class="modal fade">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h2 class="modal-title">Member Info</h2>
                  </div>
                  <div class="modal-body">
                     <div id="editContent">
						<label for="first_name">First name:</label>
                        <input type="text" class="form-control" placeholder="First Name" id="first_name"><br>
						<label for="last_name">Last name:</label>
                        <input type="text" class="form-control" placeholder="Last Name" id="last_name"><br>
						<label for="student_id">Student ID:</label>
                        <input type="text" class="form-control" placeholder="Student ID" id="student_id"><br>
						<label for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Email" id="email"><br>
						<label for="year">Year:</label>
                        <input type="text" class="form-control" placeholder="Year" id="year"><br>
						<label for="cybersquad">CyberSquad:</label>
                        <input type="text" class="form-control" placeholder="CyberSquad" id="cybersquad"><br>						
						<label for="dues_paid">Dues paid:</label>
                        <input type="text" class="form-control" placeholder="Dues Paid?" id="dues_paid"><br>
						<label for="date_paid">Date paid:</label>
                        <input type="text" class="form-control" placeholder="Date Paid" id="date_paid"><br>
						<label for="email_confirmed">Email confirmed:</label>
                        <input type="text" class="form-control" placeholder="Email confirmed" id="email_confirmed"><br>
                        <input type="hidden" id="editRowID" value="0"> 
                     </div>
                     <div id="showContent" style="display:none;">
                        <h5>First name</h5>
                        <div id="first_name_view"></div>
                        <h5>Last name</h5>
                        <div id="last_name_view"></div>
                        <h5>Student ID</h5>
                        <div id="student_ID_view"></div>
                        <h5>Email</h5>
                        <div id="email_view"></div>
                        <h5>Year</h5>
                        <div id="year_view"></div>
                        <h5>CyberSquad</h5>
                        <div id="cybersquad_view"></div>					
                        <h5>Signup date</h5>
                        <div id="signup_date_view"></div>
                        <h5>Dues paid:</h5>
                        <div id="dues_paid_view"></div>
                        <h5>Date paid</h5>
                        <div id="date_paid_view"></div>
						<h5>Email Confirmed</h5>
                        <div id="email_confirmed_view"></div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" id="closeBtn" style="display: none;">
                     <input type="button" id="manageBtn" onclick="manageData('addNew')" value="Add New" class="btn btn-success">
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col">
               <h2 style="color:white;">MySQL Table Manager - C3P Members</h2>
               <input style="float: right; margin-left:10px;" type="button" class="btn btn-success" id="addNew" value="Add New">				
               <div id="csv"></div>
               <br><br>
               <table class="table table-dark nowrap" style="width:100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Year</th>
                        <th>CyberSquad</th>						
                        <th>Signup Date</th>
                        <th>Dues Paid</th>
                        <th>Date Paid</th>
						<th>Email Confirmed</th>
						<th>Actions</th>						
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
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
	  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	   	   
	  <script>    
        $(document).ready(function() {			  
            $("#addNew").on('click', function () {
               $("#tableManager").modal('show');
			   $(".modal-title").html("Add New Member");
            });
			
			 $("#tableManager").on('hidden.bs.modal', function () {
               $("#showContent").fadeOut();
               $("#editContent").fadeIn();
               $("#editRowID").val(0);
               $("#first_name").val("");
               $("#last_name").val("");
               $("#student_id").val("");
			   $("#email").val("");
			   $("#year").val("");
			   $("#cybersquad").val("");
			   $("#signup_date").val("");
			   $("#dues_paid").val("");
			   $("#date_paid").val("");
			   $("#email_confirmed").val("");			   
               $("#closeBtn").fadeOut();
               $("#manageBtn").attr('value', 'Add New').attr('onclick', "manageData('addNew')").fadeIn();
            });
			
            getExistingData(0, 50);
        });
		
		function deleteRow(rowID) {
            if (confirm('Are you sure? This action cannot be undone!')) {
                $.ajax({
                    url: 'c3p_ss.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRow',
                        rowID: rowID
                    }, success: function (response) {
                        $("#firstName_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }
		
		function viewORedit(rowID, type) {
            $.ajax({
                url: 'c3p_ss.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowData',
                    rowID: rowID
                }, success: function (response) {
					if (type == "view") {
						$(".modal-title").html("Member Info");
						$("#showContent").fadeIn();
                        $("#editContent").fadeOut();
						$("#first_name_view").html(response.first_name);
						$("#last_name_view").html(response.last_name);
						$("#student_ID_view").html(response.student_id);
						$("#email_view").html(response.email);
						$("#year_view").html(response.year);
						$("#cybersquad_view").html(response.cybersquad);
						$("#signup_date_view").html(response.signup_date);
						$("#dues_paid_view").html(response.dues_paid);
						$("#date_paid_view").html(response.date_paid);
						$("#email_confirmed_view").html(response.email_confirmed);
						$("#manageBtn").fadeOut();
                        $("#closeBtn").fadeIn();
					}else{
						$(".modal-title").html("Edit Member Info");
						$("#editContent").fadeIn();
						$("#editRowID").val(rowID);
						$("#showContent").fadeOut();
						$("#first_name").val(response.first_name);
						$("#last_name").val(response.last_name);
						$("#student_id").val(response.student_id);
						$("#email").val(response.email);
						$("#year").val(response.year);
						$("#cybersquad").val(response.cybersquad);
						$("#signup_date").val(response.signup_date);
						$("#dues_paid").val(response.dues_paid);
						$("#date_paid").val(response.date_paid);
						$("#email_confirmed").val(response.email_confirmed);
						$("#closeBtn").fadeOut();
						$("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
					}
                   
                    $("#tableManager").modal('show');
                    
                }
            });
        }

        function getExistingData(start, limit) {
            $.ajax({
                url: 'c3p_ss.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingData',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response != "reachedMax") {
                        $('tbody').append(response);
                        start += limit;
                        getExistingData(start, limit);
                    }else
                        $(".table").DataTable({"scrollX": true});
                }
            });
			
        }

        function manageData(key) {
            var fname = $("#first_name");
            var lname = $("#last_name");
            var sid = $("#student_id");
			
			var email = $("#email");
			var year = $("#year");
			var cybersquad = $("#cybersquad");
			var dues_paid = $("#dues_paid");
			var date_paid = $("#date_paid");
			var email_confirmed = $("#email_confirmed");
			var editRowID = $("#editRowID");			

            if ( isNotEmpty(fname) && isNotEmpty(lname) && isNotEmpty(sid) && isNotEmpty(email) && isNotEmpty(year) && isNotEmpty(cybersquad) && isNotEmpty(dues_paid) && isNotEmpty(date_paid) && isNotEmpty(email_confirmed)){
                $.ajax({
                   url: 'c3p_ss.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       fname: fname.val(),
                       lname: lname.val(),
                       sid: sid.val(),
					   email: email.val(),
					   year: year.val(),
					   cybersquad: cybersquad.val(),
					   dues_paid: dues_paid.val(),
					   date_paid: date_paid.val(),
					   email_confirmed: email_confirmed.val(),
					   rowID: editRowID.val()
					   					   
                   }, success: function (response) {
                        if (response != "success")
                           alert(response);
                       else {
                           $("#firstName_"+editRowID.val()).html(fname.val());
						   $("#lastName_"+editRowID.val()).html(lname.val());
						   $("#sid_"+editRowID.val()).html(sid.val());
						   $("#email_"+editRowID.val()).html(email.val());
						   $("#year_"+editRowID.val()).html(year.val());
						   $("#cybersquad_"+editRowID.val()).html(cybersquad.val());
						   $("#dues_paid_"+editRowID.val()).html(dues_paid.val());
						   $("#date_paid_"+editRowID.val()).html(date_paid.val());
						   $("#email_confirmed_"+editRowID.val()).html(email_confirmed.val());
                           fname.val('');
						   lname.val('');
                           sid.val('');
                           email.val('');
						   year.val('');
						   cybersquad.val('');
						   dues_paid.val('');
						   date_paid.val('');
						   email_confirmed.val('');
                           $("#tableManager").modal('hide');
                           $("#manageBtn").attr('value', 'Add').attr('onclick', "manageData('addNew')");
                       }
                   }
                });
            }
        }
						
        function isNotEmpty(caller) {
            if (caller.val() == '') {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }

    </script>
	
<script>
   $(document).ready( function () {
   		getCSV();
   });
   function getCSV() {
        $.ajax({
             type: "POST",
             url: 'export_c3p.php',
             data:{action:'call_this'},
             success:function(response) {
   		 $("#csv").css('float','right');			 
               $('#csv').html(response);
             }
        });
   }
</script>
 </body>
</html>