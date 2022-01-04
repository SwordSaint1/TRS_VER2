<?php
	include 'login.php';

	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$q = "SELECT * FROM trs_accounts WHERE username = '$username'";
		$stmt = $conn->prepare($q);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $i){
				$name = $i['username'];
				$role = $i['role'];
				$esection = $i['esection'];
				$full_name = $i['full_name'];
			}
		}else{
			session_unset();
			session_destroy();
			header('location: ../../index.php');
		}
	}else{
		session_unset();
		session_destroy();
		header('location: ../../index.php');
	}
	

?>