<?php
	include 'conn.php';
	$method = $_POST['method'];



//fetch pending request

	if($method == 'fetch_superior') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		

		$c = 0;
	 $q = "SELECT id, batch_number, approval_status, request_date_time,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time, esection FROM trs_request WHERE approval_status = '1' AND esection = '$esection' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59')
	 GROUP BY batch_number ORDER BY request_date_time ASC";
	$stmt = $conn->prepare($q);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;
			if ($role == 'superior') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#request_details" onclick="get_req(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['request_date_time'].'&quot;)">';
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

//preview the pending request

 if($method == 'prevbatchApp'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c =0;
    	
    
      
$query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = '1' AND esection = '$esection' ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
            	$c++;
                echo '<tr>';

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
            		// echo '<td>'.$x['approval_status'].'</td>';
            		echo '<td>'.$x['request_date_time'].'</td>';
            	

                echo '</tr>';
            }
        }
    }

//approve the pending request function

    if ($method == 'approve_request') {
	$id = [];
	$id = $_POST['id'];
	$newbatch_number = $_POST['newbatch_number'];
	//COUNT OF ITEM TO BE UPDATED
	$count = count($id);
	foreach($id as $x){
		$approve = "UPDATE trs_request SET approval_status = '2', approval_date = '$server_date_time' WHERE batch_number = '$newbatch_number' AND id = '$x'";
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

// cancel the pending request

if ($method == 'cancel_request') {
	$id = [];
	$id = $_POST['id'];
	$newbatch_number = $_POST['newbatch_number'];
	//COUNT OF ITEM TO BE UPDATED
	$count = count($id);
	foreach($id as $x){
		$approve = "UPDATE trs_request SET approval_status = '0', cancel_date = '$server_date_time', ft_status = '0' WHERE batch_number = '$newbatch_number' AND id = '$x'";
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


if ($method == 'fetch_for_failed_sup') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date, exam_status FROM trs_for_training WHERE confirmation = '0' AND exam_status = 'Failed' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'superior') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#check_exam_failed_sup" onclick="get_check_exam_failed_sup(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                 echo '<td>'.$x['exam_status'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


    if ($method == 'fetch_for_exam_failed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.last_status, trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
trs_request.full_name,trs_request.eprocess,trs_request.training_type

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation = '0' AND trs_for_training.exam_status = 'Failed' GROUP BY trs_for_training.id
";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

           
                echo '<tr>';


              
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['full_name'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '<td>'.$x['exam_status'].'</td>';
                 echo '<td>'.$x['examiner'].'</td>';
                echo '<td>'.$x['last_status'].'</td>';
               
            
                  
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}


?>