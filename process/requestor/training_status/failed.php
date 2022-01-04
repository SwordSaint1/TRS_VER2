<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_training_failed') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		$c = 0;

	$query = "SELECT * FROM trs_for_training WHERE confirmation = 0 AND training_status = 'Cancel.' OR training_status = 'Failed' 

	 GROUP BY training_code ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#training_failed" onclick="get_training_failed(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'&quot;)">';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$x['training_code'].'</td>';
					echo '<td>'.$x['training_type'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['training_status'].'</td>';	
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

if ($method == 'fetch_training_failed_data') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		$training_type = $_POST['training_type'];
		$c = 0;
	//LEFT JOIN query apply bukas

	$query = "SELECT trs_request.employee_num,trs_request.full_name,
trs_for_training.training_type, trs_for_training.process,trs_for_training.training_status,trs_for_training.confirmation
FROM trs_request 
LEFT JOIN trs_for_training ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 0 AND trs_for_training.training_type = '$training_type' AND trs_for_training.training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$x['employee_num'].'</td>';
					echo '<td>'.$x['full_name'].'</td>';
					echo '<td>'.$x['training_type'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['training_status'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
		echo '</tr>';
			}
	}


?>