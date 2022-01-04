<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if ($method == 'fetch_for_ojt') {
        $role = $_POST['role'];
        $process = $_POST['process'];
        $c = 0;

$query = " SELECT * FROM trs_for_training WHERE confirmation = '5' AND ojt_status ='' OR eval_status = 'OJT Extension' GROUP BY training_code
  		 ";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $a ="SELECT process FROM trs_for_training WHERE process LIKE '$process%'";
        $stmt2 = $conn->prepare($a);    
        $stmt2->execute();
    if ($stmt2->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
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
}

if($method == 'fetch_ojt_qualif'){
        $id = trim($_POST['id']); 
        $training_code = $_POST['training_code'];
        $c = 0;

$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,trs_for_training.process, trs_for_training.ojt_start,trs_for_training.ojt_end, trs_request.full_name
FROM trs_for_training 
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.ojt_status = '' OR
trs_for_training.ojt_status = 'For OJT Extension' AND trs_for_training.eval_status =
'OJT Extension' AND trs_for_training.training_code = '$training_code' AND trs_for_training.id = '$id' GROUP BY trs_for_training.employee_num";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
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
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['ojt_start'].'</td>';
                echo '<td>'.$x['ojt_end'].'</td>'; 
                echo '</tr>';
            }
        }
    }

    if ($method == 'update_ojt_qualif') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $ojt_start = $_POST['ojt_start'];
    $ojt_end = $_POST['ojt_end'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $approve = "UPDATE trs_for_training SET ojt_start = '$ojt_start', ojt_end = '$ojt_end' WHERE id = '$x'";
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