<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST


       if ($method == 'fetch_ojt_period') {
        $role = $_POST['role'];  
        $curiculum = trim($_POST['curiculum']);
        $c = 0;
        
    $query = "SELECT * FROM trs_category WHERE curiculum = '$curiculum'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#ojt_period_edit" onclick="get_edit_ojt_period(&quot;'.$x['id'].'~!~'.$x['eprocess'].'~!~'.$x['training_type'].'~!~'.$x['ojt_period'].'~!~'.$x['curiculum'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['curiculum'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                echo '<td>'.$x['ojt_period'].'</td>';
                
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


    if($method == 'update_ojt_period'){
        $id = trim($_POST['id']); 
        $curiculum = trim($_POST['curiculum']);
        $eprocess= trim($_POST['eprocess']);
        $training_type = trim($_POST['training_type']);
         $ojt_period= trim($_POST['ojt_period']);
 
        // SQL
        $update = "UPDATE trs_category SET ojt_period = '$ojt_period' WHERE id = '$id'";
        $stmt = $conn->prepare($update);
        if($stmt->execute()){
            echo 'y';
        }else{
            echo 'n';
        }
    }

if ($method == 'add_process') {
       $newcuriculum = $_POST['newcuriculum'];
        $neweprocess = $_POST['neweprocess'];
        $newojt_period = $_POST['newojt_period'];
        $check = "SELECT id FROM trs_category WHERE eprocess = '$neweprocess'";

    $stmt = $conn->prepare($check);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {

        echo 'x';
    
    }else{
         $insert = "INSERT INTO trs_category (`curiculum`, `eprocess`,`training_type`,`ojt_period`) VALUES ('$newcuriculum', '$neweprocess', 'Special Batch Training', '$newojt_period')";
        $stmt = $conn->prepare($insert);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    }
?>