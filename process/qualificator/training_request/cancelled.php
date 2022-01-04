<?php  
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; // ajax method POST

if ($method == 'fetch_cancel_request_qualificator') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];

        $c = 0;
    $query = "SELECT * FROM trs_request WHERE approval_status = 0 AND qualifcancel_date IS NOT NULL AND (qualifcancel_date >='$dateFrom 00:00:00' AND qualifcancel_date <= '$dateTo 23:59:59')  GROUP BY batch_number";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#qualif_cancel" onclick="get_cancel_qualificator(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['batch_number'].'</td>';
                echo '<td>'.$x['qualifcancel_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


 if($method == 'cancelBatchqualif'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $c=0;

$query = "SELECT trs_request.id,trs_request.full_name,trs_request.position,trs_request.department,trs_request.section,trs_request.emline,
trs_request.training_reason,trs_request.request_date_time,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time,trs_qualif.employee_num,trs_qualif.qualif_cancel_date,trs_qualif.qualif_remarks, trs_qualif.batch_num,trs_request.eprocess
FROM trs_request
LEFT JOIN trs_qualif ON trs_request.employee_num = trs_qualif.employee_num
WHERE trs_qualif.batch_num = '$batch_number' AND trs_request.approval_status = 0 AND trs_qualif.qualif_cancel_date IS NOT NULL
";

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
                    echo '<td>'.$x['request_date_time'].'</td>';
                     echo '<td>'.$x['qualif_cancel_date'].'</td>';
                      echo '<td>'.$x['qualif_remarks'].'</td>';
                echo '</tr>';
            }
        }
    }
?>