<?php
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; // ajax method POST

if ($method == 'fetch_ojt_view') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		$c = 0;
	$query = "SELECT id,training_code,training_type,process,ojt_end,ojt_start 
	,date_format(ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(ojt_end, '%m-%d-%Y') as ojt_end
	FROM trs_for_training WHERE confirmation = 5 AND ojt_status = '' OR ojt_status='For OJT Extension' AND eval_submit = ''
		AND ojt_start >='$dateFrom' AND ojt_end <= '$dateTo' 
		GROUP BY training_code ";
// OR eval_status = 'OJT Extension'
	 
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#ojt_view_list_data" onclick="get_ojt_view_list(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
		
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

if ($method == 'fetch_ojt_view_data') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		$c = 0;

	$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end,
trs_request.full_name,trs_request.training_type,trs_for_training.eval_submit
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.eval_submit = '' AND trs_for_training.training_code = '$training_code'  GROUP BY trs_for_training.employee_num
";

 // AND trs_for_training.eval_status = '' OR trs_for_training.eval_status = 'OJT Extension'
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$x['training_code'].'</td>';
					echo '<td>'.$x['employee_num'].'</td>';
					echo '<td>'.$x['full_name'].'</td>';
					echo '<td>'.$x['training_type'].'</td>';
					echo '<td>'.$x['process'].'</td>';
					echo '<td>'.$x['ojt_start'].'</td>';
					echo '<td>'.$x['ojt_end'].'</td>';
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