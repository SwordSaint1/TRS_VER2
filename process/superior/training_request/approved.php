<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 
// fetch approve data tab

if ($method == 'fetch_approve_request_superior') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];

		$c = 0;
	$query = "SELECT id,batch_number, approval_status, approval_date	
    ,date_format(approval_date, '%m-%d-%Y') as approval_date
	 FROM trs_request WHERE approval_status = 2 AND (approval_date >='$dateFrom 00:00:00' AND approval_date <= '$dateTo 23:59:59') GROUP BY batch_number";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;


			if ($role == 'superior') {
				echo '<tr style="cursor:pointer;" class="modal-trigger"  data-toggle="modal" data-target="#request_view_superior" onclick="get_view_superior(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['approval_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

// fetch data approve modal
 if($method == 'approveBatch'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $c=0;
    
    
   

       $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time
	   ,date_format(approval_date, '%m-%d-%Y') as approval_date FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 2 ";

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
            		echo '<td>'.$x['approval_date'].'</td>';
            	

                echo '</tr>';
            }
        }
    }
?>