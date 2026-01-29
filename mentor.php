<?php
		require "PHPMailer/PHPMailerAutoload.php";
		$conn = new mysqli('localhost', 'cisoguum_cisoagkc_ciso_members', '1nf0$3cC1$0W3b', 'cisoguum_cisoagkc_cyber_mentorship');
		$captcha = $_POST['captcha'];
		
	    if(isset($_POST['name'])){			
           $name = $conn->real_escape_string($_POST['name']);
        }
	    if(isset($_POST['slack_id'])){
			$slack_id = $conn->real_escape_string($_POST['slack_id']);         
        }
        if(isset($_POST['student_id'])){          
		    $student_id = $conn->real_escape_string($_POST['student_id']); 
        }
        if(isset($_POST['email'])){
			$email = $conn->real_escape_string($_POST['email']);         
        }
		if(isset($_POST['year'])){
			$year = $conn->real_escape_string($_POST['year']);          
        }
		if(isset($_POST['major'])){
			$major = $conn->real_escape_string($_POST['major']);         
        }
		if(isset($_POST['major_exp'])){
			$major_exp = $conn->real_escape_string($_POST['major_exp']);         
        }
		if(isset($_POST['topic_interest'])){
			$topic_interest = $conn->real_escape_string($_POST['topic_interest']);         
        }
		if(isset($_POST['knowledge'])){
			$knowledge = $conn->real_escape_string($_POST['knowledge']);        
        }
		if(isset($_POST['gpa'])){
			$gpa = $conn->real_escape_string($_POST['gpa']);        
        }
		if(isset($_POST['preference'])){
			$preference = $conn->real_escape_string($_POST['preference']);
        }
				
        if(!$captcha){
		  echo 'nocap';
          exit;
        }
		else if (strpos($email, '@coyote.csusb.edu') == false) {
		echo 'emailerror';
	    }else{
        $secretKey = "6LdQ-E4hAAAAAK0ZmkTGC4GSZPEdrU_2lq65NKfm";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) { 
				$conn->query("INSERT INTO applicants (name, student_id, slack_username, email, year, major, q1, q2, q3, gpa, preference) 
							  VALUES ('$name', '$student_id', '$slack_id', '$email', '$year', '$major', '$major_exp', '$topic_interest', '$knowledge', '$gpa', '$preference')");
				$automailx = new PHPMailer;
				$automailx->isSMTP();                                      // Set mailer to use SMTP
				$automailx->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
				$automailx->SMTPAuth = true;                               // Enable SMTP authentication
				$automailx->Username = 'ciso-mentorship@ciso-csusb.org';   // SMTP username
				$automailx->Password = '1nf0$3cC1$0W3b';                   // SMTP password
				$automailx->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$automailx->Port = 465;                                    // TCP port to connect to
				$automailx->setFrom('ciso-mentorship@ciso-csusb.org');	
			    $automailx->addAddress('ciso.csusb@gmail.com');			
				$automailx->isHTML(true);                                  // Set email format to HTML
				$automailx->Subject = "New Mentorship Interest Application! $name";
				$automailx->Body    = "New Mentorship Interest Application!<br><br>
									   Name: $name<br><br>
									   Slack ID: $slack_id<br><br>
									   Student ID: $student_id<br><br>
									   Email: $email<br><br>
									   Year: $year<br><br>
									   Major: $major<br><br>
									   Why did you choose your current major?<br>$major_exp<br><br>
									   Which topics in cybersecurity are the most interesting to you?<br>$topic_interest<br><br>
									   Describe the cybersecurity topics in which you have the most and least knowledge about:<br>$knowledge<br><br>
									   GPA: $gpa<br><br>
									   Preference: $preference<br><br><br>
									   CISO Officers, please make sure to follow up with applicant.<br><br>
									   v/r<br>
									   CISO Team";						

				if(!$automailx->send()) {
					echo 'error';
				} else {
				$automail = new PHPMailer;
				$automail->isSMTP();                                      // Set mailer to use SMTP
				$automail->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
				$automail->SMTPAuth = true;                               // Enable SMTP authentication
				$automail->Username = 'ciso-mentorship@ciso-csusb.org';   // SMTP username
				$automail->Password = '1nf0$3cC1$0W3b';                   // SMTP password
				$automail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$automail->Port = 465;                                    // TCP port to connect to
				$automail->setFrom('ciso-mentorship@ciso-csusb.org');
				$automail->addAddress($email);                            // Add a recipient			
				$automail->isHTML(true);                                  // Set email format to HTML
				$automail->Subject = 'Cyber Mentorship Program Application Confirmation';
				$automail->Body    = "Hello $name,<br><br>
				                      Thank you for your interest in the Cyber Mentorship Program. Your application has been received. A CISO officer is currently reviewing your application and will be in touch with you shortly. Thank you for your patience. We look forward to speaking with you.<br><br><br>
									  v/r<br>
									  CISO Team";						

				if(!$automail->send()) {
					echo 'error';
				} else {
					echo 'success';
				}
			}				 		
        } 
    }
?>

