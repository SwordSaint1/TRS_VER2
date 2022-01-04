<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_pending_val') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, eval_submit_date, eval_status FROM trs_for_training WHERE ojt_status = 'Done' AND eval_submit = 'Done' AND eval_status = 'Pending Approval' AND confirmation != '6' AND
    	(eval_submit_date >='$dateFrom 00:00:00' AND eval_submit_date <= '$dateTo 23:59:59')
    	GROUP BY training_code
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_pending_val_req" onclick="get_check_pending_val_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eval_status'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if ($method == 'fetch_for_pending_val') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code']; 
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.eval_status,
trs_request.full_name,trs_request.eprocess,trs_request.training_type
,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE  trs_for_training.confirmation != '6'
AND trs_for_training.eval_status = 'Pending Approval' GROUP BY trs_for_training.employee_num
";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

           
                echo '<tr>';
																	echo '<td>'.$c.'</td>';
	                echo '<td>'.$x['training_code'].'</td>';
	                echo '<td>'.$x['employee_num'].'</td>';
	                echo '<td>'.$x['full_name'].'</td>';
	                echo '<td>'.$x['training_type'].'</td>';
	                echo '<td>'.$x['eprocess'].'</td>';
	                echo '<td>'.$x['ojt_end'].'</td>';
	                echo '<td>'.$x['ojt_status'].'</td>';
	                echo '<td>'.$x['eval_status'].'</td>';
	                echo '<td>'.$x['eval_remarks'].'</td>';
                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}

?>