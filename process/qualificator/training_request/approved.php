<?php  
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; // ajax method POST



if ($method == 'fetch_approve_request_qualif') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        // $batch = trim($_POST['batch']);
        $c = 0;
    $query = "SELECT * FROM trs_request WHERE approval_status = 3 AND qualifapproval_date IS NOT NULL AND (qualifapproval_date >='$dateFrom' AND qualifapproval_date <= '$dateTo') GROUP BY batch_number";


    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#qualif_approve" onclick="get_view_qualif(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['batch_number'].'</td>';
                // echo '<td>'.$x['approval_status'].'</td>';
                echo '<td>'.$x['qualifapproval_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }
if($method == 'approveBatch'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $c=0;
    $query ="SELECT trs_qualif.id, trs_qualif.employee_num,trs_qualif.qualif_approve_date,trs_qualif.batch_num,
trs_request.full_name,trs_request.position,trs_request.department,trs_request.section,trs_request.emline,
trs_request.training_reason,trs_request.request_date_time,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time,trs_request.approval_status,trs_request.eprocess

FROM trs_qualif
LEFT JOIN trs_request ON trs_qualif.employee_num = trs_request.employee_num 
WHERE trs_request.approval_status = 3 AND trs_request.batch_number = '$batch_number'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                $c++;

           
                echo '<tr>';

                     echo '<td>'.$c.'</td>';
                    echo '<td>'.$x['employee_num'].'</td>';
                    echo '<td>'.$x['full_name'].'</td>';
                    echo '<td>'.$x['position'].'</td>';
                    echo '<td>'.$x['eprocess'].'</td>';
                    echo '<td>'.$x['department'].'</td>';
                    echo '<td>'.$x['section'].'</td>';
                    echo '<td>'.$x['emline'].'</td>';
                    echo '<td>'.$x['training_reason'].'</td>';
                    // echo '<td>'.$x['approval_status'].'</td>';
                    echo '<td>'.$x['request_date_time'].'</td>';
                    echo '<td>'.$x['qualif_approve_date'].'</td>';
                
                echo '</tr>';
            }
        }
    }


?>