<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_validation') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date  ,examiner, eval_status FROM trs_for_training WHERE auth_date IS NOT NULL AND confirmation != '0' AND confirmation !='6' GROUP BY examiner,auth_date";
    $stmt = $conn->prepare($query);
  
    if ($stmt->execute()) {
        $search = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date  ,examiner, eval_status FROM trs_for_training WHERE (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') AND confirmation !='6' AND confirmation !='0' GROUP BY examiner,auth_date";
        $stmt2 = $conn->prepare($search);
         $stmt2->execute();
 
    if ($stmt2->rowCount() > 0) {
        foreach($stmt2->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_val" onclick="get_check_val(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['examiner'].'~!~'.$x['eval_status'].'~!~'.$x['auth_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['examiner'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }
   }


if ($method == 'fetch_for_val') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        $examiner = $_POST['examiner'];
        $auth_date = $_POST['auth_date'];
        $c = 0;

$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,
trs_for_training.auth_date,Date_FORMAT(trs_for_training.auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.examiner
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.auth_date IS NOT NULL AND trs_for_training.eval_status != 'Pending Approval' AND trs_for_training.confirmation !='6' AND trs_for_training.confirmation != '0' AND trs_for_training.auth_date = '$auth_date' AND trs_for_training.examiner = '$examiner' GROUP BY trs_for_training.employee_num
";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;           
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
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}

if ($method == 'val') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $authorize_date_val = $_POST['authorize_date_val'];
    $newexaminer = $_POST['newexaminer'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

    $approve = "UPDATE trs_for_training SET auth_date = '$authorize_date_val', examiner = '$newexaminer' WHERE id = '$x'";
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