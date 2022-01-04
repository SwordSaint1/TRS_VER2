<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

// fetch cancel data tab

if ($method == 'fetch_cancel_request_superior') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		$c = 0;
	$query = "SELECT id,batch_number, approval_status, cancel_date, qualifcancel_date 
	,date_format(cancel_date, '%m-%d-%Y') as cancel_date
	,date_format(qualifcancel_date, '%m-%d-%Y') as qualifcancel_date
	FROM trs_request WHERE approval_status = 0 AND (cancel_date >='$dateFrom 00:00:00' AND cancel_date <= '$dateTo 23:59:59')
GROUP BY batch_number";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'superior') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#superior_cancel" onclick="get_cancel_superior(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['cancel_date'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['cancel_date'].$x['qualifcancel_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

// fetch data cancel modal
 if($method == 'cancelBatch'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c=0;
        $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time 
		,date_format(cancel_date, '%m-%d-%Y') as cancel_date
		,date_format(qualifcancel_date, '%m-%d-%Y') as qualifcancel_date
		FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 0 AND esection = '$esection' ";

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
            		echo '<td>'.$x['cancel_date'].$x['qualifcancel_date'].'</td>';
            	

                echo '</tr>';
            }
        }
    }
?>