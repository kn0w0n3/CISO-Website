<?php
	    require "PHPMailer/PHPMailerAutoload.php";
		$captcha = $_POST['captcha'];
		
	    if(isset($_POST['name'])){
          $name=$_POST['name'];
        }
	    if(isset($_POST['slack_id'])){
          $slack_id=$_POST['slack_id'];
        }
        if(isset($_POST['student_id'])){
          $student_id=$_POST['student_id'];
        }
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }
		if(isset($_POST['proj_start_date'])){
          $proj_start_date=$_POST['proj_start_date'];
        }
		if(isset($_POST['proj_name'])){
          $proj_name=$_POST['proj_name'];
        }
		if(isset($_POST['proj_desc'])){
          $proj_desc=$_POST['proj_desc'];
        }
		if(isset($_POST['resources'])){
          $resources=$_POST['resources'];
        }		
        if(!$captcha){
		  echo 'nocap';
          exit;
        }else if(strpos($email, '@coyote.csusb.edu') == false){
			echo 'emailerror';
		}		
		else{
        $secretKey = "6LdQ-E4hAAAAAK0ZmkTGC4GSZPEdrU_2lq65NKfm";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
			
				$automaily = new PHPMailer;
   				$automaily->isSMTP();                                      // Set mailer to use SMTP
   				$automaily->Host = 'premium99.web-hosting.com';            // Specify main and backup SMTP servers
   				$automaily->SMTPAuth = true;                               // Enable SMTP authentication
   				$automaily->Username = 'ciso-projects@ciso-csusb.org';     // SMTP username
   				$automaily->Password = '1nf0$3cC1$0W3b';                   // SMTP password
   				$automaily->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
   				$automaily->Port = 465;                                    // TCP port to connect to
   				$automaily->setFrom('ciso-projects@ciso-csusb.org');
   				$automaily->addAddress('ciso.csusb@gmail.com');           // Add a recipient
   				$automaily->isHTML(true);                                 // Set email format to HTML
   				$automaily->Subject = "New Project Proposal! - $proj_name";
   				$automaily->Body    = "Hello CISO Officers,<br><br>
				                       There is a new project proposal!<br><br>
   									   Name: $name<br><br>
									   Slack ID: $slack_id<br><br>
   									   Student ID: $student_id<br><br>
   									   Email: $email<br><br>
									   Project start date: $proj_start_date<br><br>
									   Project name: $proj_name<br><br>
									   Project description:<br>$proj_desc<br><br>
									   Resources needed:<br>$resources<br><br>
   									   v/r<br>
   									   CISO Team<br>";
					if(!$automaily->send()) {
						  echo 'error';						
					} else {
						
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
   				$automailx->Subject = "Project Proposal confirmation";
   				$automailx->Body    = "Hello $name,<br><br>
				                       Your project proposal has been received and is currently being reviewed by a CISO officer. An officer will be in contact with you shortly to discuss the project.<br><br>
									   You may also reach out to a CISO officer if you would like to do so. We look forward to seeing your project in action!<br><br>  									   
   									   v/r<br>
   									   CISO Team<br>";
					if(!$automailx->send()) {
						  echo 'error';						
					} else {
						echo 'success';
					}
        } 
      }
    }
?>

