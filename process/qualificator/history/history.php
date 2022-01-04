<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if ($method == 'fetch_history_list') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];    
        $c = 0;

    $query = " SELECT trs_request.cancel_date,trs_request.id,trs_request.employee_num,trs_request.full_name,trs_request.approval_date,trs_request.approval_status,trs_request.request_date_time,
trs_for_training.training_start_date,trs_for_training.training_end_date,trs_training_sched.trainer,
trs_for_training.training_status,trs_for_training.ojt_start,trs_for_training.ojt_end,trs_for_training.auth_date,
trs_for_training.examiner,trs_for_training.exam_status,trs_for_training.last_status

FROM trs_request
LEFT JOIN trs_for_training ON trs_for_training.employee_num = trs_request.employee_num
LEFT JOIN trs_training_sched ON trs_for_training.training_code = trs_training_sched.training_code
WHERE (trs_request.request_date_time >='$dateFrom 00:00:00' AND trs_request.request_date_time <= '$dateTo 23:59:59') GROUP BY trs_for_training.id
";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr">';
	                echo '<td>'.$c.'</td>';
	                echo '<td>'.$x['employee_num'].'</td>';
	                echo '<td>'.$x['full_name'].'</td>';
	                echo '<td>'.$x['approval_date'].$x['cancel_date'].'</td>';
	                echo '<td>'.$x['approval_status'].'</td>';
	                echo '<td>'.$x['training_start_date'].'</td>';
	                echo '<td>'.$x['training_end_date'].'</td>';
	                echo '<td>'.$x['trainer'].'</td>';
	                echo '<td>'.$x['training_status'].'</td>';
	                echo '<td>'.$x['ojt_start'].'</td>';
	                echo '<td>'.$x['ojt_end'].'</td>';
	                echo '<td>'.$x['auth_date'].'</td>';
	                echo '<td>'.$x['examiner'].'</td>';
	                echo '<td>'.$x['exam_status'].'</td>';
	                echo '<td>'.$x['last_status'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

?>