<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

if ($method == 'fetch_qualif') {
		$role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
		$c = 0;

	 $q = "SELECT id, batch_number, approval_status, request_date_time,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time, full_name, position, department, section, emline, training_reason, eprocess FROM trs_request WHERE approval_status = '2' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') GROUP BY batch_number ";
	$stmt = $conn->prepare($q);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;
			if ($role == 'qualificator') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#qualif_details" onclick="get_req_qualif(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['request_date_time'].'~!~'.$x['full_name'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['request_date_time'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

	if($method == 'prevbatchApp_qualif'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $full_name = trim($_POST['full_name']);
        $c=0;
        $query = "SELECT *,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 2 ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
            $c++;
                echo '<tr style="cursor:pointer;" &quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['request_date_time'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['department'].'~!~'.$x['section'].'~!~'.$x['emline'].'~!~'.$x['training_reason'].'~!~'.$x['training_need'].'&quot;">';


                        echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="selectLot" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
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
                    echo '<td>'.$x['remarks'].'</td>';
                echo '</tr>';
            }
        }
    }

if($method == 'getTraining'){
        $qualiftraining_t = $_POST['value'];
        $fetchReason = "SELECT DISTINCT training_need FROM trs_type WHERE training_type = '$qualiftraining_t'";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['training_need'].'">'.$x['training_need'].'</option>';
            }
        }
    }


 if ($method == 'update_remarks_qualif') {
    $id = [];
    $id = $_POST['id'];
    $newbatch_number = $_POST['newbatch_number'];
    $qualif_remarks = $_POST['qualif_remarks'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $approve = "UPDATE trs_request SET remarks = '$qualif_remarks' WHERE batch_number = '$newbatch_number' AND id = '$x'";
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


 if ($method == 'cancel_qualif_pending') {
    $id = [];
    $id = $_POST['id'];
    $newbatch_number = $_POST['newbatch_number'];
    $qualif_remarks = $_POST['qualif_remarks'];
    $qualiftraining_t = $_POST['qualiftraining_t'];
    $qualiftraining_n = $_POST['qualiftraining_n'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $cancel = "UPDATE trs_request SET approval_status = '0', remarks = '$qualif_remarks', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifcancel_date = '$server_date_only', ft_status = '0' WHERE batch_number = '$newbatch_number' AND id = '$x'";
        $stmt = $conn->prepare($cancel);
        if ($stmt->execute()) {
                
             $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_cancel_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifcancel_date FROM trs_request WHERE approval_status = 0 AND id ='$x'";

        $stmt2 = $conn->prepare($que);

        }
        if ($stmt2->execute()) {
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


if ($method == 'approve_qualif_pending') {
    $id = [];
    $id = $_POST['id'];
    $newbatch_number = $_POST['newbatch_number'];
    $qualif_remarks = $_POST['qualif_remarks'];
    $qualiftraining_t = $_POST['qualiftraining_t'];
    $qualiftraining_n = $_POST['qualiftraining_n'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $cancel = "UPDATE trs_request SET approval_status = '3', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifapproval_date = '$server_date_only' WHERE batch_number = '$newbatch_number' AND id = '$x'";
        $stmt = $conn->prepare($cancel);
        if ($stmt->execute()) {
                
             $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_approve_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifapproval_date FROM trs_request WHERE approval_status = 3 AND id ='$x'";

        $stmt2 = $conn->prepare($que);

        }
        if ($stmt2->execute()) {
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