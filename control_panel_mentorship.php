<?php
   session_start();
   if(!isset($_SESSION['logged_in'])){
   	header("Location: login.php");
   }
   $conn = new mysqli('localhost', 'cisoguum_cisoagkc_ciso_members', '1nf0$3cC1$0W3b', 'cisoguum_cisoagkc_cyber_mentorship');
   $sql = $conn->query("SELECT id FROM applicants");
   $numRows = $sql->num_rows;
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
	  
	  
      <title>CISO | Control Panel Mentorship</title>
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
						<label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Name" id="name"><br>
						<label for="student_id">Student ID:</label>
                        <input type="text" class="form-control" placeholder="Student ID" id="student_id"><br>
						<label for="slack_username">Slack username:</label>
                        <input type="text" class="form-control" placeholder="Slack username" id="slack_username"><br>
						<label for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Email" id="email"><br>
						<label for="year">year:</label>
                        <input type="text" class="form-control" placeholder="Year" id="year"><br>
						<label for="major">Major:</label>
                        <input type="text" class="form-control" placeholder="Major" id="major"><br>												
						<label for="major_exp">Why did you choose your current major?</label>
                        <textarea class="form-control" placeholder="Enter answer" id="major_exp"></textarea><br>
						<label for="int_cyber_topics">Which topics in cybersecurity are the most interesting to you?</label>
                        <textarea class="form-control" placeholder="Enter answer" id="int_cyber_topics"></textarea><br>
						<label for="cyber_topics_int_wea">Describe the cybersecurity topics in which you have the most and least knowledge about?</label>
                        <textarea class="form-control" placeholder="Enter answer" id="cyber_topics_int_wea"></textarea><br>
						<label for="gpa">GPA</label>
                        <input type="text" class="form-control" placeholder="GPA" id="gpa"><br>
						<label for="preference">Mentor Preference?</label>
                        <input type="text" class="form-control" placeholder="Mentor preference?" id="preference"><br>
                        <input type="hidden" id="editRowID" value="0"> 
                     </div>
                     <div id="showContent" style="display:none;">
                        <h5>Name</h5>
                        <div id="name_view"></div><br>
                        <h5>Student ID</h5>
                        <div id="student_id_view"></div><br>
                        <h5>Slack username</h5>
                        <div id="slack_username_view"></div><br>
                        <h5>Email</h5>
                        <div id="email_view"></div><br>
						<h5>Year</h5>
                        <div id="year_view"></div><br>
                        <h5>Major</h5>
                        <div id="major_view"></div><br>	
                        <h5>Why did you choose your current major?</h5>
                        <div id="q1_view" style="overflow-y: scroll; height: 75px;"></div><br>				
                        <h5>Which topics in cybersecurity are the most interesting to you?</h5>
                        <div id="q2_view" style="overflow-y: scroll; height: 75px;"></div><br>	
                        <h5>Describe the cybersecurity topics in which you have the most and least knowledge about?</h5>
                        <div id="q3_view" style="overflow-y: scroll; height: 75px;"></div><br>
						<h5>GPA</h5>
                        <div id="gpa_view"></div><br>	
                        <h5>Mentor Preference?</h5>
                        <div id="mp_view"></div>						
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
               <h2 style="color:white;">MySQL Table Manager - Mentorship</h2>			   
               <input style="float: right; margin-left:10px;" type="button" class="btn btn-success" id="addNew" value="Add New">
			   <p id="response">Please Wait...</p>
               <!--<div id="response"></div>-->
               <br><br>
               <table class="table table-dark display nowrap" style="width:100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Slack username</th>
                        <th>Email</th>
                        <th>Year</th>
                        <th>Major</th>						
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
						<th>GPA</th>
						<th>Mentor Preference</th>
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
               $("#name").val("");
               $("#student_id").val("");
               $("#slack_username").val("");
			   $("#email").val("");
			   $("#year").val("");
			   $("#major").val("");
			   $("#major_exp").val("");
			   $("#int_cyber_topics").val("");
			   $("#cyber_topics_int_wea").val("");
			   $("#gpa").val("");			   			   
			   $("#preference").val("");			   			   
               $("#closeBtn").fadeOut();
               $("#manageBtn").attr('value', 'Add New').attr('onclick', "manageData('addNew')").fadeIn();
            });
			
            getExistingData(0, 50);
        });
		
		function deleteRow(rowID) {
            if (confirm('Are you sure? This action cannot be undone!')) {
                $.ajax({
                    url: 'control_panel_mentorship_ss.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRow',
                        rowID: rowID
                    }, success: function (response) {
                        $("#name_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }
		
		function viewORedit(rowID, type) {
            $.ajax({
                url: 'control_panel_mentorship_ss.php',
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
						$("#name_view").html(response.name);
						$("#student_id_view").html(response.student_id);
						$("#slack_username_view").html(response.slack_username);
						$("#email_view").html(response.email);
						$("#year_view").html(response.year);
						$("#major_view").html(response.major);
						$("#q1_view").html(response.q1);
						$("#q2_view").html(response.q2);
						$("#q3_view").html(response.q3);
						$("#gpa_view").html(response.gpa);
						$("#mp_view").html(response.preference);
						$("#manageBtn").fadeOut();
                        $("#closeBtn").fadeIn();
					}else{
						$(".modal-title").html("Edit Member Info");
						$("#editContent").fadeIn();
						$("#editRowID").val(rowID);
						$("#showContent").fadeOut();
						$("#name").val(response.name);
						$("#student_id").val(response.student_id);
						$("#slack_username").val(response.slack_username);
						$("#email").val(response.email);
						$("#year").val(response.year);
						$("#major").val(response.major);
						$("#major_exp").val(response.q1);
						$("#int_cyber_topics").val(response.q2);
						$("#cyber_topics_int_wea").val(response.q3);
						$("#gpa").val(response.gpa);
						$("#preference").val(response.preference);
						$("#closeBtn").fadeOut();
						$("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
					}
                   
                    $("#tableManager").modal('show');
                    
                }
            });
        }

        function getExistingData(start, limit) {
            $.ajax({
                url: 'control_panel_mentorship_ss.php',
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
            var name = $("#name");
            var student_id = $("#student_id");
            var slack_username = $("#slack_username");				
			var email = $("#email");
			var year = $("#year");
			var major = $("#major");
			var major_exp = $("#major_exp");
			var int_cyber_topics = $("#int_cyber_topics");
			var cyber_topics_int_wea = $("#cyber_topics_int_wea");
			var gpa = $("#gpa");
			var preference = $("#preference");
			var editRowID = $("#editRowID");			

            if (isNotEmpty(name) && isNotEmpty(student_id ) && isNotEmpty(slack_username) && isNotEmpty(email) && isNotEmpty(year) && isNotEmpty(major) && isNotEmpty(major_exp) && isNotEmpty(int_cyber_topics) && isNotEmpty(cyber_topics_int_wea) && isNotEmpty(gpa) && isNotEmpty(preference)){
                $.ajax({
                   url: 'control_panel_mentorship_ss.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       name: name.val(),
                       student_id: student_id.val(),
                       slack_username: slack_username.val(),
					   email: email.val(),
					   year: year.val(),
					   major: major.val(),
					   major_exp: major_exp.val(),
					   int_cyber_topics: int_cyber_topics.val(),
					   cyber_topics_int_wea: cyber_topics_int_wea.val(),
					   gpa: gpa.val(),
					   preference: preference.val(),
					   rowID: editRowID.val()
					   					   
                   }, success: function (response) {
                        if (response != "success")
                           alert(response);
                       else {
                           $("#name_"+editRowID.val()).html(name.val());
						   $("#student_id_"+editRowID.val()).html(student_id.val());
						   $("#slack_username_"+editRowID.val()).html(slack_username.val());
						   $("#email_"+editRowID.val()).html(email.val());
						   $("#year_"+editRowID.val()).html(year.val());
						   $("#major_"+editRowID.val()).html(major.val());
						   //$("#q1_"+editRowID.val()).html(major_exp.val());
						   //$("#q2_"+editRowID.val()).html(int_cyber_topics.val());
						   //$("#q3_"+editRowID.val()).html(cyber_topics_int_wea.val());
						   $("#gpa_"+editRowID.val()).html(gpa.val());
						   $("#preference_"+editRowID.val()).html(preference.val());
                           name.val('');
						   student_id.val('');
                           slack_username.val('');
                           email.val('');
						   year.val('');
						   major.val('');
						   major_exp.val('');
						   int_cyber_topics.val('');
						   cyber_topics_int_wea.val('');
						   gpa.val('');
						   preference.val('');
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
	
 <script type="text/javascript">
        var data = "data:text/csv;charset=utf-8,ID\tNAME\tSTUDENT ID\tSLACK USERNAME\tEMAIL\tYEAR\tMAJOR\tQ1\tQ2\tQ3\tGPA\tPREFERENCE\n";

        $(document).ready(function () {
            exportToCSV(0, <?php echo $numRows ?>);
        });

        function exportToCSV(start, max) {
            if (start > max) {
                $("#response").html('<a href="'+data+'" download="mentorship.csv"><button style="float: right" type="button" class="btn btn-success float-right">CSV</button></a>');
                return;
            }

            $.ajax({
                url: 'export_mentorship.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    start: start
                }, success: function (response) {
                    data += response.data;
                    exportToCSV((start + 50), max);
                }
            });
        }
    </script>
 </body>
</html>