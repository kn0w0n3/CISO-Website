<?php
	$conn = new mysqli('localhost', 'cisoagkc_admin', '1nf0$3cC1$0W3b', 'cisoagkc_cyber_mentorship');

	if (isset($_POST['start'])) {
        $start = $conn->real_escape_string($_POST['start']);

        $allData = '';
        $sql = $conn->query("SELECT * FROM applicants LIMIT $start, 50");
        while($data = $sql->fetch_assoc())
			$allData .= $data['id'] . "\t" . $data['name'] . "\t" . $data['student_id'] . "\t" . $data['slack_username'] . "\t" . $data['email'] . "\t" . $data['year'] . "\t" . $data['major'] . "\t" . $data['q1'] . "\t" . $data['q2'] . "\t" . $data['q3'] . "\t" . $data['gpa'] . "\t" . $data['preference'] ."\n";
			
		exit(json_encode(array("data" => $allData)));
}	
 ?>