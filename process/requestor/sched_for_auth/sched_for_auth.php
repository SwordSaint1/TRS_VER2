<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST
if ($method == 'fetch_evaluationn_req') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];

        $c = 0;


        $query = "SELECT *,date_format(eval_submit_date, '%m-%d-%Y') as eval_submit_date FROM trs_for_training WHERE confirmation = '5' AND (eval_submit_date >='$dateFrom 00:00:00' AND eval_submit_date <= '$dateTo 23:59:59') AND ojt_status = 'Done' AND eval_submit = 'Done' OR eval_status LIKE 'OJT Extension%' GROUP BY training_code" ;

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_eval_req" onclick="get_check_eval_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eval_submit_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

 if ($method == 'fetch_ojt_eval_req') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		$c = 0;
 
	$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end,
trs_request.full_name,trs_request.training_type,trs_for_training.auth_date,Date_FORMAT(trs_for_training.auth_date, '%Y-%m-%d %H:%i:%s') as auth_date
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_status = 'Done' OR trs_for_training.eval_status LIKE 'OJT Extension%' GROUP BY trs_for_training.employee_num
";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				 echo '<td>
                     <p>
                            <label>
                                <input type="checkbox" name="" class="singleCheck" value="'.$x['id'].'">
                                <span></span>
                            </label>
                        </p>
                    </td>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['employee_num'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
				echo '<td>'.$x['auth_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


 if ($method == 'resubmit_eval') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
  
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $approve = "UPDATE trs_for_training SET ojt_status = '', eval_submit = '', eval_submit_date = '(NULL)',eval_status ='',auth_date='(NULL)',examiner='' WHERE id = '$x'";
        $stmt = $conn->prepare($approve);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

?>