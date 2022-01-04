<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if ($method == 'fetch_for_total_failed') {
  $role = $_POST['role'];
  $section = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
  $c = 0;
    
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date, exam_status, did_not_attend_exam FROM trs_for_training WHERE (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') AND confirmation = '0' AND exam_status = 'Failed'  GROUP BY training_code
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_total_exam_failed_req" onclick="get_check_total_exam_failed_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['did_not_attend_exam'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                 echo '<td>'.$x['exam_status'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if ($method == 'fetch_for_total_exam_failed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];      
        $c = 0;

$query = "SELECT DISTINCT trs_for_training.last_status,trs_for_training.f_status,trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
trs_request.full_name,trs_request.eprocess,trs_request.training_type

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation = '0' AND trs_for_training.exam_status = 'Failed' GROUP BY trs_for_training.id
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
                echo '<td>'.$x['auth_date'].'</td>';
                echo '<td>'.$x['exam_status'].'</td>';
                 echo '<td>'.$x['examiner'].'</td>';
                 echo '<td>'.$x['last_status'].'</td>';
                    echo '<td>  
                        <div class="row">
                        <div class ="col s12">
                        <input type="text" value="Please ProcessTraining Requisition" readonly="">
                        </div>
                        </div>

                    </td>';              
               
            
                  
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}


?>