<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if ($method == 'fetch_for_pending_req') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
        $query = "SELECT id, training_code,batch_number,training_type,eprocess, count(id) as total, request_date_time FROM trs_request WHERE approval_status = 3 AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59')
     GROUP BY training_type,eprocess";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'training') {
                echo '<tr">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['batch_number'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['total'].'</td>';
        
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }
?>