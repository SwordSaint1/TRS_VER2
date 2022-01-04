<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_attendance_data_list') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];   
        $c = 0;
        // confirmation = '5' OR confirmation = '0' OR confirmation = '6' 
    $query = "SELECT id,training_code,training_type,process FROM trs_for_training WHERE
    (training_start_date >='$dateFrom' AND training_end_date <= '$dateTo') AND confirmation != 4
    GROUP BY training_code, training_type";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="#attendance_view" data-toggle="modal" onclick="get_attendance_view(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                 echo '<td>'.$x['process'].'</td>';    
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if($method == 'view_attendance'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        $training_type = trim($_POST['training_type']);
         $c = 0;

$query ="SELECT DISTINCT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end, trs_for_training.training_start_date,trs_for_training.training_end_date,trs_for_training.attend,
trs_for_training.did_not_attend,trs_for_training.training_status,
trs_request.position,trs_request.department,
trs_request.full_name,trs_training_sched.trainer
,date_format(trs_for_training.training_start_date, '%m-%d-%Y') as training_start_date
	,date_format(trs_for_training.training_end_date, '%m-%d-%Y') as training_end_date
FROM trs_for_training
LEFT JOIN trs_request ON trs_request.employee_num = trs_for_training.employee_num 
LEFT JOIN trs_training_sched ON trs_for_training.training_code = trs_training_sched.training_code
WHERE 
trs_for_training.training_code = '$training_code' AND confirmation != '4'
AND trs_for_training.training_type = '$training_type'


";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                 $c++;

                echo '<tr>';
                 echo '<td>'.$c.'</td>';
                 echo '<td>'.$x['training_code'].'</td>';
                 echo '<td>'.$x['training_type'].'</td>';
                 echo '<td>'.$x['employee_num'].'</td>';
                 echo '<td>'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                 echo '<td>'.$x['process'].'</td>';
                 echo '<td>'.$x['department'].'</td>';
                 echo '<td>'.$x['attend'].'</td>';
                 echo '<td>'.$x['did_not_attend'].'</td>';
                 echo '<td>'.$x['training_status'].'</td>';
                 echo '<td>'.$x['trainer'].'</td>';
                 echo '<td>'.$x['training_start_date'].'</td>';
                 echo '<td>'.$x['training_end_date'].'</td>';
                echo '</tr>';
            }
        }
    }
?>