<?php
$conn = new mysqli('localhost', 'cisoagkc_admin', '1nf0$3cC1$0W3b', 'cisoagkc_ciso_members');

if($_POST['action'] == 'call_this') {
        $allData = "";
        $sql = $conn->query("SELECT * FROM other_members");
        while($data = $sql->fetch_assoc())
			$allData .= $data['id'] . ',' . $data['first_name'] . ',' . $data['last_name'] . ',' . $data['student_id'] .  ',' . $data['email'] . ',' . $data['year'] . ',' . $data['cybersquad'] .  ',' . $data['signup_date'] . ',' . $data['dues_paid'] .',' . $data['date_paid'] . ',' . $data['email_confirmed'] ."\n";
	
		$response = "data:text/csv;charset=utf-8,ID,FIRST NAME,LAST NAME,STUDENT ID,EMAIL,YEAR,CYBERSQUAD,SIGNUP DATE,DUES PAID,DATE PAID,Email Confirmed\n";
		$response .= $allData;
		echo '<a href="'.$response.'"download="ciso.csv"><button style="float: right" type="button" class="btn btn-success float-right">CSV</button></a>';
}		
 ?>