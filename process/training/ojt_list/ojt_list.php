<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_for_ojt') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];        
        $c = 0;
        
    $query = "SELECT id,training_code,training_type,process,ojt_start,ojt_end, eval_status FROM trs_for_training WHERE ojt_start >='$dateFrom' AND ojt_end <= '$dateTo' AND confirmation = '5' AND ojt_status = '' OR ojt_status = 'For OJT Extension' GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){    
        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#ojt_view" onclick="get_ojt_view(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['ojt_end'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                 echo '<td>'.$x['process'].'</td>';
        
                echo '</tr>';
            }
    }
}else{ 
        echo '<tr>';
            echo '<td colspan="4" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if($method == 'view_ojt'){
        $id = trim($_POST['id']); 
        $training_code = $_POST['training_code'];
        $training_type = $_POST['training_type'];
         $c = 0;

$query = "SELECT trs_for_training.confirmation,trs_for_training.training_status, 
trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,
trs_for_training.process, trs_for_training.ojt_start,trs_for_training.ojt_end, trs_request.full_name
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training 
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE  trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation != 0 AND trs_for_training.confirmation = 5 
AND trs_for_training.ojt_status != 'Done' AND trs_for_training.training_type = '$training_type'
GROUP BY trs_for_training.training_type, trs_for_training.employee_num

";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){          
 		$c++;
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
    }


?>