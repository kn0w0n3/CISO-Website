<?php
   require "PHPMailer/PHPMailerAutoload.php";
   include 'database.php';
   
   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $year = mysqli_real_escape_string($conn, $_POST['year']);
   $cybersquad = mysqli_real_escape_string($conn, $_POST['cybersquad']);
   $captcha = $_POST['captcha'];
   $result = false;
   $differentschool = false;
   $nonc3pSchool = false;
   $sql_i = NULL;
   $qresult = NULL;
   
  //Check the school email extensions
  if (strpos($email, '@coyote.csusb.edu') !== false) {
    $result = true;	
    $differentschool = false;
	}
  else if(strpos($email, '@aacc.edu') !== false) {
    $result = true;
	$differentschool = true;
	}
  else if(strpos($email, '@clarkstate.edu') !== false) {
    $result = true;	
    $differentschool = true;
	}
  else if(strpos($email, '@occc.edu') !== false) {
    $result = true;	
    $differentschool = true;
	}
  else if(strpos($email, '@whatcom.edu') !== false) {
    $result = true;	
    $differentschool = true;
	}
  else if(strpos($email, '@mymail.aacc.edu') !== false) {
    $result = true;	 
	$differentschool = true;
	}
  else if(strpos($email, '@students.clarkstate.edu') !== false) {
    $result = true;	 
	$differentschool = true;
	}
  else if(strpos($email, '@my.occc.edu') !== false) {
    $result = true;
	$differentschool = true;
	}
  else if(strpos($email, '@student.laccd.edu') !== false) {
    $result = true;	
    $differentschool = true;
	}
  else if(strpos($email, '@rcc.edu') !== false) {
    $result = true;	
    $nonc3pschool = true;
	}
	else if(strpos($email, '@gmail.com') !== false) {
    $result = true;	
    $nonc3pschool = true;
	}
	
    //If no school email exit. Otherwise do the recaptcha check.
	if($result == false){
	echo ('emailerror'); 
	}
	else{
     
   if (!$captcha) {
       echo 'nocap';    
   }	
   else {
       $secretKey = "6LdQ-E4hAAAAAK0ZmkTGC4GSZPEdrU_2lq65NKfm";
       $ip = $_SERVER['REMOTE_ADDR'];
       // post request to server
       $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
       $response = file_get_contents($url);
       $responseKeys = json_decode($response, true);
       // should return JSON with success as true
       if ($responseKeys["success"]) {
		   
		   if($differentschool == false && $nonc3pschool == false){
           $sql_i = "SELECT * FROM members WHERE email='$email'";
           $qresult = mysqli_query($conn, $sql_i);
		   }
		   if($differentschool == true){
		   $sql_i = "SELECT * FROM other_members WHERE email='$email'";
           $qresult = mysqli_query($conn, $sql_i);
		   }
		   if($nonc3pschool == true && $differentschool == false){
		   $sql_i = "SELECT * FROM non_c3p_school WHERE email='$email'";
           $qresult = mysqli_query($conn, $sql_i);
		   }
   
           if (mysqli_num_rows($qresult) > 0) {
               				
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
   				$automailx->Subject = 'Message from CISO';
   				$automailx->Body    = "This email currently exists. Please contact a CISO officer if you need further asistance.<br><br>";						
   
   				if(!$automailx->send()) {
   					echo 'error';
   				} else {
   					echo 'exists';
   				}
           }
           else {
   			$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
   			$token = str_shuffle($token);
   			$token = substr($token, 0, 10);
   			 if($differentschool == false && $nonc3pschool == false){
               $sql = "INSERT INTO `members`( `first_name`, `last_name`, `student_id`, `email`, `year`, `cybersquad`, `signup_date`, `email_confirmed`, `token`) 
                   VALUES ('$first_name', '$last_name', '$student_id', '$email', '$year', '$cybersquad', curdate(), 'no', '$token')";
			 }
			 if($differentschool == true){
			    $sql = "INSERT INTO `other_members`( `first_name`, `last_name`, `student_id`, `email`, `year`, `cybersquad`, `signup_date`, `email_confirmed`, `token`) 
                   VALUES ('$first_name', '$last_name', '$student_id', '$email', '$year', '$cybersquad', curdate(), 'no', '$token')";
			 }
			  if($nonc3pschool == true && $differentschool == false){
               $sql = "INSERT INTO `non_c3p_school`( `first_name`, `last_name`, `student_id`, `email`, `year`, `cybersquad`, `signup_date`, `email_confirmed`, `token`) 
                   VALUES ('$first_name', '$last_name', '$student_id', '$email', '$year', '$cybersquad', curdate(), 'no', '$token')";
			 }
   				$automail = new PHPMailer;
   				$automail->isSMTP();                                      // Set mailer to use SMTP
   				$automail->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
   				$automail->SMTPAuth = true;                               // Enable SMTP authentication
   				$automail->Username = 'autoreply@ciso-csusb.org';         // SMTP username
   				$automail->Password = '1nf0$3cC1$0W3b';                   // SMTP password
   				$automail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
   				$automail->Port = 465;                                    // TCP port to connect to
   				$automail->setFrom('autoreply@ciso-csusb.org');
   				$automail->addAddress($email);                            // Add a recipient				
   				$automail->isHTML(true);                                  // Set email format to HTML
   				$automail->Subject = 'Verify email';
   				$automail->Body    = "Hello $first_name,<br><br>
				                      Thank you for your interest in joining CISO. Please verify your email to continue the registration process.<br><br>
                                      <a href='http://ciso-csusb.org/confirm.php?email=$email&token=$token&first_name=$first_name'>Click here to confirm your email address</a><br><br>
									  **Non-CSUB students must contact a CISO officer @ ciso.csusb@gmail.com to be added to the Microsoft teams channel.<br><br><br>
									  v/r<br>
									  CISO Team";						
   
   				if(!$automail->send()) {
   					  echo 'error';

   				} else {
   				$automaily = new PHPMailer;
   				$automaily->isSMTP();                                      // Set mailer to use SMTP
   				$automaily->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
   				$automaily->SMTPAuth = true;                               // Enable SMTP authentication
   				$automaily->Username = 'ciso-signup@ciso-csusb.org';       // SMTP username
   				$automaily->Password = '1nf0$3cC1$0W3b';                   // SMTP password
   				$automaily->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
   				$automaily->Port = 465;                                    // TCP port to connect to
   				$automaily->setFrom('ciso-signup@ciso-csusb.org');
   				$automaily->addAddress('ciso.csusb@gmail.com');            // Add a recipient
   				$automaily->isHTML(true);                                  // Set email format to HTML
   				$automaily->Subject = "New Member Signup! - $first_name $last_name";
   				$automaily->Body    = "New member signup!<br><br>
   									   Name: $first_name $last_name<br><br>
   									   Student ID: $student_id<br><br>
   									   Email: $email<br><br>
									   Year: $year<br><br> 
   									   Interested in joining Cybersquad? $cybersquad<br><br><br>
   									   A Teams invite will automatically be sent to this new member once they confirm their email address.<br><br><br>
   									   v/r<br>
   									   CISO Team<br>";
					if(!$automaily->send()) {
						  echo 'error';						
					} else {
						if (mysqli_query($conn, $sql)) {
					  echo 'added';
				   }             
   			    }  									   
   		     }                      
          }
        }
     }
  }
   mysqli_close($conn);
?>