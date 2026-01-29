<?php
$conn = new mysqli('localhost', 'cisoguum_cisoagkc_ciso_members', '1nf0$3cC1$0W3b', 'cisoguum_cisoagkc_control_panel');
session_start();
if(isset($_SESSION['logged_in'])){
    header("Location: control_panel.php");	
}
$username = mysqli_real_escape_string($conn, $_POST['username']);
$pwd = mysqli_real_escape_string($conn, $_POST['pswd']);
$captcha = $_POST['captcha'];

if (!$captcha) {
    echo 'nocap';
    //exit('nocap');   
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
		$sql_i = "SELECT password FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql_i);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if(password_verify($pwd, $row['password'])){			
			$_SESSION['logged_in'] = $username;
            echo 'match';
			}
			else{
				echo'nomatch';
			}				
        }      
        else {
           echo'error';
        }
    }
}
mysqli_close($conn);
?>