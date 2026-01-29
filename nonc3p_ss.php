<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'cisoagkc_admin', '1nf0$3cC1$0W3b', 'cisoagkc_ciso_members');
		
		if ($_POST['key'] == 'getRowData') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT id, first_name, last_name, student_id, email, year, cybersquad, signup_date, dues_paid, date_paid, email_confirmed FROM non_c3p_school WHERE id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
			'first_name' => $data['first_name'],
				'last_name' => $data['last_name'],
				'student_id' => $data['student_id'],
				'email' => $data['email'],
				'year' => $data['year'],
				'cybersquad' => $data['cybersquad'],				
				'signup_date' => $data['signup_date'],
				'dues_paid' => $data['dues_paid'],
				'date_paid' => $data['date_paid'],
				'email_confirmed' => $data['email_confirmed'],
			);

			exit(json_encode($jsonArray));
 		}
		
		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT id, first_name, last_name, student_id, email, year, cybersquad, signup_date, dues_paid, date_paid, email_confirmed FROM non_c3p_school LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["id"].'</td>
							<td id="firstName_'.$data["id"].'">'.$data["first_name"].'</td>
							<td id="lastName_'.$data["id"].'">'.$data["last_name"].'</td>
							<td id="sid_'.$data["id"].'">'.$data["student_id"].'</td>
							<td id="email_'.$data["id"].'">'.$data["email"].'</td>
							<td id="year_'.$data["id"].'">'.$data["year"].'</td>
							<td id="cybersquad_'.$data["id"].'">'.$data["cybersquad"].'</td>							
							<td id="signup_date_'.$data["id"].'">'.$data["signup_date"].'</td>
                            <td id="dues_paid_'.$data["id"].'">'.$data["dues_paid"].'</td>	
                            <td id="date_paid_'.$data["id"].'">'.$data["date_paid"].'</td>
							<td id="email_confirmed_'.$data["id"].'">'.$data["email_confirmed"].'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data["id"].',\'edit\')" value="Edit" class="btn btn-primary">
								<input type="button"  onclick="viewORedit('.$data["id"].',\'view\')" value="View" class="btn btn-secondary">
								<input type="button" onclick="deleteRow('.$data["id"].')" value="Delete" class="btn btn-danger">
							</td>							
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}
		$rowID = $conn->real_escape_string($_POST['rowID']);
		
		if ($_POST['key'] == 'deleteRow') {
			$conn->query("DELETE FROM non_c3p_school WHERE id='$rowID'");
			exit('The Row Has Been Deleted!');
		}
		
		$fname = $conn->real_escape_string($_POST['fname']);
		$lname = $conn->real_escape_string($_POST['lname']);
		$sid = $conn->real_escape_string($_POST['sid']);
        $email = $conn->real_escape_string($_POST['email']);
		$year = $conn->real_escape_string($_POST['year']);
		$cybersquad = $conn->real_escape_string($_POST['cybersquad']);
		$dues_paid = $conn->real_escape_string($_POST['dues_paid']);
		$date_paid = $conn->real_escape_string($_POST['date_paid']);
		$email_confirmed = $conn->real_escape_string($_POST['email_confirmed']);
		
		
		
		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE non_c3p_school SET first_name='$fname', last_name='$lname', student_id='$sid', email='$email', year='$year', cybersquad='$cybersquad', dues_paid='$dues_paid', date_paid='$date_paid', email_confirmed='$email_confirmed'  WHERE id='$rowID'");
			exit('success');
		}
			
		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT email FROM non_c3p_school WHERE email = '$email'");
			if ($sql->num_rows > 0)
				exit("Email Already Exists!");
			else {
				$conn->query("INSERT INTO non_c3p_school (first_name, last_name, student_id, email, year, cybersquad, signup_date, dues_paid, date_paid, email_confirmed) 
							VALUES ('$fname', '$lname', '$sid', '$email', '$year', '$cybersquad', curdate(), '$dues_paid', '$date_paid', '$email_confirmed')");
				exit('Member Has Been Inserted!');
			}
		}
	}
?>