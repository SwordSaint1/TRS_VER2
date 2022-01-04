<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_for_exams') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date, attempt,examiner FROM trs_for_training WHERE ojt_status = 'Done' AND eval_submit = 'Done' AND eval_status = 'For Authorization' AND exam_status != 'Failed' AND confirmation != '6' AND confirmation !='0' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY examiner,auth_date ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam" onclick="get_check_exam(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['attempt'].'~!~'.$x['examiner'].'~!~'.$x['auth_date'].'&quot;)">';
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

if ($method == 'fetch_for_examss') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        $examiner = $_POST['examiner'];
        $auth_date = $_POST['auth_date'];
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";

$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,trs_for_training.examiner

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.ojt_status IS NOT NULL AND trs_for_training.auth_date IS NOT NULL AND trs_for_training.confirmation != '0' AND trs_for_training.confirmation !='6' AND trs_for_training.examiner ='$examiner' AND trs_for_training.auth_date = '$auth_date'
    
GROUP BY trs_for_training.employee_num
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


 if ($method == 'confirm_exam') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $newexam_stat = $_POST['newexam_stat'];
    $newattendance_stat = $_POST['newattendance_stat'];
    $newremarks = $_POST['newremarks'];
    $newattempt = $_POST['newattempt'];

    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
if ($newattendance_stat == 'Attend' && $newexam_stat == 'Passed'){
                $q2= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '6', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt = $conn->prepare($q2);
               if ($stmt->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt = $conn->prepare($select);
               $stmt->execute();
               foreach($stmt->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt1 = $conn->prepare($update);
               if ($stmt1->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

          
            
        }else{
      
        }
  
         } if ($newattendance_stat == 'Did Not Attend' && $newexam_stat == 'Failed'){
                $q3= "UPDATE trs_for_training SET did_not_attend_exam = (did_not_attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt3 = $conn->prepare($q3);
               if ($stmt3->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt4 = $conn->prepare($select);
               $stmt4->execute();
               foreach($stmt4->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt5 = $conn->prepare($update);
               if ($stmt5->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    } if ($newattendance_stat == 'Attend' && $newexam_stat == 'Failed'){
                $q4= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt7 = $conn->prepare($q4);
               if ($stmt7->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt8 = $conn->prepare($select);
               $stmt8->execute();
               foreach($stmt8->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt9 = $conn->prepare($update);
               if ($stmt9->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }
}

}
if ($newattendance_stat == 'Attend' && $newexam_stat == 'Failed' && $newattempt == '0'){
                $q10= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt15 = $conn->prepare($q10);
               if ($stmt15->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt16 = $conn->prepare($select);
               $stmt16->execute();
               foreach($stmt16->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt17 = $conn->prepare($update);
               if ($stmt17->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }
}
}
}
}
?>