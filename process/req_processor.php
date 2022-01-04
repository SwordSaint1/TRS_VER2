<?php
	include 'conn.php';
	include 'conn2.php';

//requestor  
	$method = $_POST['method'];
	if($method == 'generateBatchCode'){
		$prefix = "RC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

 if($method == 'fetch_details_req'){
        $employee_num = trim($_POST['employee_num']);
        // CHECK
        $sql = "SELECT idNumber, empName, batchNo, empPosition, empDeptCode, empDeptSection, lineNo, empArea FROM a_m_employee WHERE idNumber = '$employee_num'";
        $stmt = $conn2->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
        	foreach($stmt->fetchALL() as $x){
            echo $x['empName'].'~!~'.$x['batchNo'].'~!~'.$x['empPosition'].'~!~'.$x['empDeptCode'].'~!~'.$x['empDeptSection'].'~!~'.$x['lineNo'];
        }
    }else{
    	echo '';
    }
    }


if ($method == 'insert_req') {
	$employee_num = trim($_POST['employee_num']);
	$batch_no = $_POST['batch_no'];
	$full_name = $_POST['full_name'];
	$position = $_POST['position'];
	$department = $_POST['department'];
	$section = $_POST['section'];
	$emline = $_POST['emline'];
	$eprocess = $_POST['eprocess'];
	$training_reason = $_POST['training_reason'];
	$batch_number = trim($_POST['batchID']);
	$esection = $_POST['esection'];
	$ojt_period = $_POST['ojt_period'];


$check = "SELECT id FROM trs_request WHERE employee_num = '$employee_num' AND ft_status != '0' ";


	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {

		// echo 'Already have Training Request!';
		echo 'Already Have Training Request';
	
	}else{
		$insert = "INSERT INTO trs_request (`employee_num`, `batch_no`, `full_name`,`position`,`department`,`section`,`emline`,`eprocess`,`training_reason`,`batch_number`,`approval_status`,`request_date_time`,`esection`,`ojt_period`,`ft_status`) VALUES('$employee_num', '$batch_no','$full_name','$position','$department','$section','$emline','$eprocess','$training_reason','$batch_number', '1','$server_date_time', '$esection', '$ojt_period', '1')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Requested';
		
		}else{
			
			echo 'Error';
		
		}
	}

}

// PENDING REQUEST

	if ($method == 'fetch_request') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		    $dateFrom = $_POST['dateFrom'];
        	 $dateTo = $_POST['dateTo'];
 		

		$c = 0;

	$query = "SELECT *,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time FROM trs_request WHERE approval_status = '1' AND esection = '$esection' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') GROUP BY batch_number" ;


	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#request_view" onclick="get_view(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['request_date_time'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['request_date_time'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




if ($method == 'prev_req') {
	$c =0;
	$batch = trim($_POST['batch']);
	$query = "SELECT * FROM trs_request WHERE batch_number LIKE '$batch%' ORDER BY id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';

		echo '<td>'.$c.'</td>';
		echo '<td>'.$x['batch_number'].'</td>';
		echo '<td>'.$x['employee_num'].'</td>';
		echo '<td>'.$x['full_name'].'</td>';
			echo '<td>'.$x['position'].'</td>';
			echo '<td>'.$x['eprocess'].'</td>';
			echo '<td>'.$x['training_reason'].'</td>';
			echo '<td>'.$x['department'].'</td>';
			
			echo '<td>'.$x['section'].'</td>';
			echo '<td>'.$x['emline'].'</td>';
			echo '<td>'.$x['ojt_period'].'</td>';
		

		echo '</tr>';
	}
}

 if($method == 'prevbatch'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $c = 0;

      $query = "SELECT *,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 1 ORDER BY request_date_time ASC";

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
            	

                echo '</tr>';
            }
        }
    }


  


  if($method == 'prevbatch_cancel'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c = 0;

      $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time FROM trs_request WHERE approval_status = 0 AND esection = '$esection' AND batch_number = '$batch_number' ORDER BY request_date_time ASC";



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
            		echo '<td>'.$x['cancel_date'].'</td>';
            		echo '<td>'.$x['qualifcancel_date'].'</td>';
            		echo '<td>'.$x['remarks'].'</td>';

            	

                echo '</tr>';
            }
        }
    }



  if($method == 'getCuriculum'){
        $categ = $_POST['value'];
     
        $fetchReason = "SELECT eprocess FROM trs_category WHERE curiculum = '$categ'";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
            	
                echo '<option value="'.$x['eprocess'].'">'.$x['eprocess'].'</option>';
            	
            }
        }
    }

// APPROVE REQUEST TAB FUNCTION
if ($method == 'fetch_approve_request_req') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];	

		$c = 0;
	$query = "SELECT *,date_format(approval_date, '%m-%d-%Y') as approval_date FROM trs_request WHERE approval_status >= 2 AND esection = '$esection' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') GROUP BY batch_number";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#approve_req" onclick="get_view_approve_req(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
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


// APPROVE REQUEST TAB FUNCTION
if ($method == 'fetch_pendingq_request_req') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		

		$c = 0;

		// AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') AND batch_number LIKE '$batch%'
	$query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time FROM trs_request WHERE approval_status = 2 AND esection = '$esection' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') AND remarks != '' GROUP BY batch_number";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#pendingq_req" onclick="get_view_pendingq_req(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['request_date_time'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

  if($method == 'prevbatch_approve'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        // $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c = 0;

      $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time 
	  ,date_format(approval_date, '%m-%d-%Y') as approval_date  ,date_format(qualifapproval_date, '%m-%d-%Y') as qualifapproval_date 
	  FROM trs_request WHERE approval_status >= 2 AND esection = '$esection' AND batch_number = '$batch_number' ORDER BY approval_date ASC";

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
					echo '<td>'.$x['approval_date'].'</td>';
					echo '<td>'.$x['qualifapproval_date'].'</td>';
            	

                echo '</tr>';
            }
        }
    }
 




if ($method == 'fetch_cancel_request_req') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		
		$c = 0;
	$query = "SELECT *,date_format(cancel_date, '%m-%d-%Y') as cancel_date ,date_format(qualifcancel_date, '%m-%d-%Y') as qualifcancel_date  FROM trs_request WHERE approval_status = 0 AND esection = '$esection' AND (request_date_time >='$dateFrom 00:00:00' AND request_date_time <= '$dateTo 23:59:59') GROUP BY batch_number ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#cancel_req" onclick="get_cancel_req(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['cancel_date'].$x['qualifcancel_date'].'</td>';
				// echo '<td>'.$x['qualifcancel_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




 if($method == 'prev_pendingq'){
  		$id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        // $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c = 0;

      $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time FROM trs_request WHERE approval_status = 2 AND esection = '$esection' AND batch_number = '$batch_number' AND remarks!= '' ORDER BY approval_date ASC";

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
            		echo '<td>'.$x['remarks'].'</td>';
            	

                echo '</tr>';
            }
        }
    }







        if ($method == 'fetch_updated_sched') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		$process = trim($_POST['process']);

    
        $c = 0;
    $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time 
	,date_format(start_date, '%m-%d-%Y') as start_date, date_format(end_date, '%m-%d-%Y') as end_date FROM trs_training_sched WHERE sched_stat = 2 AND slot !=0 AND (start_date >='$dateFrom 00:00:00' AND end_date <= '$dateTo 23:59:59') AND process LIKE '$process%'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        	

         
        $c++;

            if ($role == 'requestor') {
                echo '<tr">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['shift'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$x['start_time'].'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['end_time'].'</td>';
                 echo '<td>'.$x['trainer'].'</td>';
                  echo '<td>'.$x['location'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }





if ($method == 'fetch_sched_request_req') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		// $batch = trim($_POST['batch']);
		$c = 0;



	
	$query = "SELECT id,batch_number,qualifapproval_date,approval_status 
	, date_format(qualifapproval_date, '%m-%d-%Y') as qualifapproval_date 
	FROM trs_request WHERE approval_status = 3 AND esection = '$esection' 
	AND (qualifapproval_date >='$dateFrom 00:00:00' AND qualifapproval_date <= '$dateTo 23:59:59')
	GROUP BY batch_number";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#req_sched" onclick="get_view_req_sched(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['qualifapproval_date'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
				// echo '<td>'.$x['approval_status'].'</td>';
				echo '<td>'.$x['qualifapproval_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}
 

if ($method == 'fetch_for_training') {
		$role = $_POST['role'];
		
		$c = 0;

		$query = "SELECT e_r_req.id, e_r_req.batch_number, e_r_req.confirm_date, e_r_for_training.process FROM e_r_req LEFT JOIN e_r_for_training ON e_r_req.employee_num = e_r_for_training.employee_no WHERE e_r_for_training.confirmation = 4 GROUP BY e_r_req.batch_number";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="req_for_training" onclick="get_view_req_training(&quot;'.$x['id'].'~!~'.$x['batch_number'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['batch_number'].'</td>';
		
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['confirm_date'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




if ($method == 'fetch_for_passed') {
        $role = $_POST['role'];
        $section = $_POST['esection'];        
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];

        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date, exam_status FROM trs_for_training WHERE confirmation = '6' AND exam_status = 'Passed' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam_passed_req" onclick="get_check_exam_passed_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
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

if ($method == 'fetch_for_retain') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date, exam_status, did_not_attend_exam FROM trs_for_training WHERE confirmation = '0' AND attempt !='0' AND f_status = '' AND exam_status = 'Failed' AND last_status = '' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') AND did_not_attend_exam =''  GROUP BY training_code
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam_retain_req" onclick="get_check_exam_retain_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['did_not_attend_exam'].'&quot;)">';
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


    if ($method == 'fetch_for_total_failed') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date, exam_status, did_not_attend_exam FROM trs_for_training WHERE (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') AND confirmation = '0' AND exam_status = 'Failed'  GROUP BY training_code
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_total_exam_failed_req" onclick="get_check_total_exam_failed_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['did_not_attend_exam'].'&quot;)">';
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




if ($method == 'fetch_for_exam_passed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT DISTINCT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
trs_request.full_name,trs_request.eprocess,trs_request.training_type

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation = '6' AND trs_for_training.exam_status = 'Passed' GROUP BY trs_for_training.employee_num
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
                
               
            
                  
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}


if ($method == 'fetch_for_exam_retain') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;


$query = "SELECT DISTINCT trs_for_training.attempt, trs_for_training.f_status,trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,trs_for_training.did_not_attend_exam

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.attempt != '0'  AND trs_for_training.confirmation = '0' AND trs_for_training.exam_status = 'Failed' AND trs_for_training.did_not_attend_exam ='' AND trs_for_training.f_status = '' GROUP BY trs_for_training.employee_num
";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
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
                echo '<td>'.$x['auth_date'].'</td>';
                echo '<td>'.$x['exam_status'].'</td>';
                 echo '<td>'.$x['examiner'].'</td>';
                
               
            
                  
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}



if ($method == 'fetch_for_total_exam_failed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;


$query = "SELECT DISTINCT trs_for_training.last_status,trs_for_training.f_status,trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
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
                    echo '<td>  
                        <div class="row">
                        <div class ="col s12">
                        <input type="text" value="Please ProcessTraining Requisition" readonly="">
                        </div>
                        </div>

                    </td>';              
               
            
                  
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}






	if($method == 'schedbatch'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $esection = $_POST['esection'];
        $c=0;

       $query = "SELECT *,date_format(request_date_time, '%m-%d-%Y %H:%i:%s') as request_date_time
	   ,date_format(qualifapproval_date, '%m-%d-%Y') as qualifapproval_date
	    FROM trs_request WHERE approval_status = 3 AND esection = '$esection' AND batch_number = '$batch_number'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                $c++;

           
              echo  '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#confirm_sched" onclick="get_sched_approve(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['approval_date'].'&quot;)">';

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
                    echo '<td>'.$x['qualifapproval_date'].'</td>';
                

                echo '</tr>';
            }
        }
    } 


    if($method == 'prevsched_confirm'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $esection = trim($_POST['esection']);


$query ="
SELECT trs_request.id,trs_request.full_name,trs_request.batch_number,trs_request.position,trs_request.department,trs_request.section,
trs_request.emline,trs_request.training_reason,trs_request.training_type,trs_request.training_need,trs_request.eprocess,trs_request.ojt_period,
trs_training_sched.trainer,trs_training_sched.slot,trs_training_sched.training_code,trs_training_sched.location
FROM trs_request 
LEFT JOIN trs_training_sched ON trs_request.id = trs_training_sched.id
WHERE trs_request.approval_status = 3 AND trs_request.batch_number = '$batch_number' AND
trs_request.id = '$id'
";


        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               	 echo $x['id'].'~!~'.$x['full_name'].'~!~'.$x['batch_number'].'~!~'.$x['position'].'~!~'.$x['department'].'~!~'.$x['section'].'~!~'.$x['emline'].'~!~'.$x['training_reason'].'~!~'.$x['training_type'].'~!~'.$x['training_need'].'~!~'.$x['eprocess'].'~!~'.$x['ojt_period'].'~!~'.$x['slot'].'~!~'.$x['trainer'].'~!~'.$x['location'];


            }
        }
    } 
     if($method == 'getshiftConfirm'){

       $sched_training_process = $_POST['process'];
       $sched_training_t = $_POST['training_type'];
       $fetchReason = "SELECT DISTINCT shift FROM trs_training_sched WHERE training_type = '$sched_training_t' AND process ='$sched_training_process' AND sched_stat = 2 AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['shift'].'">'.$x['shift'].'</option>';
            }
        }
    }
      if($method == 'gettrainingcode'){
      		$sched_training_startdate_schedule = $_POST['start'];
      		$sched_training_process = $_POST['processs'];
      		$sched_training_t = $_POST['typee'];
      		$sched_training_enddate_schedule = $_POST['endd'];
      		$sched_training_start = $_POST['start_t'];
   
       $fetchReason = "SELECT DISTINCT training_code FROM trs_training_sched WHERE sched_stat = 2 AND start_date = '$sched_training_startdate_schedule' AND process = '$sched_training_process' AND training_type = '$sched_training_t' AND end_date = '$sched_training_enddate_schedule' AND start_time = '$sched_training_start' AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['training_code'].'">'.$x['training_code'].'</option>';
            }
        }
    }

    if($method == 'gettrainer'){
      		$sched_training_startdate_schedule = $_POST['start'];
      		$sched_training_process = $_POST['processs'];
      		$sched_training_t = $_POST['typee'];
      		$sched_training_enddate_schedule = $_POST['endd'];
      		$sched_training_start = $_POST['start_t'];
   
       $fetchReason = "SELECT DISTINCT trainer FROM trs_training_sched WHERE sched_stat = 2 AND start_date = '$sched_training_startdate_schedule' AND process = '$sched_training_process' AND training_type = '$sched_training_t' AND end_date = '$sched_training_enddate_schedule' AND start_time = '$sched_training_start' AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['trainer'].'">'.$x['trainer'].'</option>';
            }
        }
    }

     if($method == 'getslot'){
      		$sched_training_startdate_schedule = $_POST['start'];
      		$sched_training_process = $_POST['processs'];
      		$sched_training_t = $_POST['typee'];
      		$sched_training_enddate_schedule = $_POST['endd'];
      		$sched_training_start = $_POST['start_t'];
   
       $fetchReason = "SELECT DISTINCT slot,start_time,TIME_FORMAT(start_time, '%H:%i:%s') as start_time  FROM trs_training_sched WHERE start_date = '$sched_training_startdate_schedule' AND sched_stat = 2 AND process LIKE '$sched_training_process%' AND training_type = '$sched_training_t' AND start_time LIKE'$sched_training_start%'
       AND start_time = '$sched_training_start' AND slot !=0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['slot'].'">'.$x['slot'].'</option>';
            }
        }
    }



     if($method == 'getLocation'){
      		$sched_training_startdate_schedule = $_POST['start'];
      		$sched_training_process = $_POST['processs'];
      		$sched_training_t = $_POST['typee'];
      		$sched_training_enddate_schedule = $_POST['endd'];
      		$sched_training_start = $_POST['start_t'];
      		$training_code_for_training = $_POST['training_codee'];
   
       $fetchReason = "SELECT DISTINCT location FROM trs_training_sched WHERE
       training_code = '$training_code_for_training' AND start_date = '$sched_training_startdate_schedule' AND process = '$sched_training_process' AND training_type = '$sched_training_t' AND end_date = '$sched_training_enddate_schedule' AND start_time = '$sched_training_start' AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['location'].'">'.$x['location'].'</option>';
            }
        }
    }

     if($method == 'getstartdateConfirm'){
   
	    $sched_training_shift = $_POST['value'];
	    $sched_training_process = $_POST['value2'];
	    $sched_training_t = $_POST['value3'];

       $fetchReason = "SELECT DISTINCT start_date FROM trs_training_sched WHERE shift = '$sched_training_shift' AND sched_stat = 2 AND slot != 0 AND process = '$sched_training_process' AND training_type = '$sched_training_t'";

 
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute(); 
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['start_date'].'">'.$x['start_date'].'</option>';
            }
        }
    }

 

     if($method == 'getenddateConfirm'){

       $sched_training_process = $_POST['process'];
       $sched_training_t = $_POST['training_type'];
       $sched_training_startdate_schedule = $_POST['startd'];
     
       $fetchReason = "SELECT DISTINCT end_date FROM trs_training_sched WHERE start_date = '$sched_training_startdate_schedule' AND sched_stat = 2 AND training_type = '$sched_training_t' AND process = '$sched_training_process' AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['end_date'].'">'.$x['end_date'].'</option>';
                
            }
        }
    }


 if($method == 'getSchedConfirmStart_time'){
 			$sched_training_shift = $_POST['shift'];
 			$sched_training_startdate_schedule = $_POST['start_d'];
 			$sched_training_enddate_schedule = $_POST['end_d'];
 			$sched_training_process = $_POST['process'];
 			$sched_training_t = $_POST['training_typee'];
 	
      
       $start_time = "SELECT DISTINCT  start_time,TIME_FORMAT(start_time, '%H:%i:%s') as start_time FROM trs_training_sched WHERE
       	shift = '$sched_training_shift' AND start_date = '$sched_training_startdate_schedule' AND end_date = '$sched_training_enddate_schedule' AND process ='$sched_training_process' AND training_type = '$sched_training_t'
       	AND sched_stat = 2 AND slot != 0";
        $stmt = $conn->prepare($start_time);
        $stmt->execute();
        if($stmt->rowCount() > 0){

            foreach($stmt->fetchALL() as $x){
            	$start_time = date('H:i:s');
                echo '<option value="'.$x['start_time'].'">'.$x['start_time'].'</option>';
            }
        }
    }

    if($method == 'getSchedConfirmend_time'){
        $sched_training_t = $_POST['training_typee'];
       	$sched_training_process = $_POST['process'];
       	$sched_training_shift = $_POST['shift'];
		$sched_training_startdate_schedule = $_POST['start_d'];
		$sched_training_enddate_schedule = $_POST['end_d'];
		$sched_training_start = $_POST['start_t'];

       $fetchReason = "SELECT DISTINCT end_time,TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE
       training_type = '$sched_training_t' AND process = '$sched_training_process' AND shift = '$sched_training_shift' AND
       start_date = '$sched_training_startdate_schedule' AND end_date = '$sched_training_enddate_schedule' AND start_time= '$sched_training_start' AND sched_stat = 2 AND slot != 0";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){

        	
        	$end_time = date('H:i:s');

            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['end_time'].'">'.$x['end_time'].'</option>';
            }
        }
    }


if ($method == 'confirm_sched_req') {
    $id = $_POST['id'];
    $batch_number_for_training = $_POST['batch_number'];
    $sched_full_name = $_POST['full_name'];
    $sched_position = $_POST['emposition'];
    $sched_department = $_POST['department'];
    $sched_section = $_POST['section'];
    $sched_line = $_POST['emline'];
    $sched_training_r = $_POST['training_reason'];
    $sched_training_t = $_POST['training_type'];
    $sched_training_n = $_POST['training_need'];
    $sched_training_process = $_POST['eprocess'];
    $sched_training_startdate_schedule = $_POST['start_date'];
    $sched_training_enddate_schedule = $_POST['end_date'];
    $sched_training_start = $_POST['start_time'];
    $sched_training_end = $_POST['end_time'];
    $training_code_for_training = trim($_POST['training_code']);
    $sched_training_shift = $_POST['training_shift'];


    $query = "UPDATE trs_request SET approval_status = '4', start_date = '$sched_training_startdate_schedule', start_time = '$sched_training_start', end_date = '$sched_training_enddate_schedule', end_time ='$sched_training_end', training_code = '$training_code_for_training', confirm_date = '$server_date_time', training_shift = '$sched_training_shift' WHERE id ='$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()){

   $quer = "UPDATE trs_training_sched SET trs_training_sched.slot = (trs_training_sched.slot - 1) WHERE trs_training_sched.start_date = '$sched_training_startdate_schedule' AND trs_training_sched.process = '$sched_training_process' AND training_code = '$training_code_for_training'";
      
        $stmt = $conn->prepare($quer);
        if($stmt->execute()) {

   $que = "INSERT INTO trs_for_training (`employee_num`, `training_code`, `confirmation`, `process`, `training_type`, `shift`, `training_start_date`, `start_time`, `training_end_date`, `end_time`, `ojt_period`)
SELECT employee_num, training_code, approval_status, eprocess, training_type, training_shift, start_date, start_time, end_date, end_time, ojt_period 
FROM trs_request WHERE approval_status = 4 AND id = '$id'";
                $stmt = $conn->prepare($que);
    		if ($stmt->execute()) {
           				echo 'y';
            }else{
                    	echo 'n';
        }
 
        }
            
      }

}




// if ($method == 'fetch_for_training_list') {
// 		$role = $_POST['role'];
// 		$id = $_POST['id'];
// 		$batch_number = $_POST['batch_number'];

		
// 		$c = 0;
// $query = "SELECT * FROM e_r_req WHERE approval_status = 4 AND batch_number = '$batch_number'";

// 		$query = "SELECT e_r_training.trainer, e_r_for_training.confirmation, e_r_for_training.process, e_r_for_training.training_code, e_r_for_training.employee_no, e_r_req.full_name,e_r_req.emposition,
// e_r_req.department, e_r_req.section, e_r_req.emline, e_r_req.training_reason, e_r_req.batch_number FROM e_r_for_training
// LEFT JOIN e_r_req ON e_r_for_training.employee_no = e_r_req.employee_num 
// LEFT JOIN e_r_training ON e_r_req.training_codee = e_r_training.training_code
// WHERE e_r_for_training.confirmation = 4 AND e_r_req.batch_number = '$batch_number'";

// 	$stmt = $conn->prepare($query);
// 	$stmt->execute();
// 	if ($stmt->rowCount() > 0) {
// 		foreach($stmt->fetchALL() as $x){
// 		$c++;

// 			if ($role == 'requestor') {
// 				echo '<tr>';
// 				echo '<td>'.$c.'</td>';
// 				echo '<td>'.$x['training_code'].'</td>';
// 				echo '<td>'.$x['employee_no'].'</td>';
// 				echo '<td>'.$x['full_name'].'</td>';
// 				echo '<td>'.$x['emposition'].'</td>';
// 				echo '<td>'.$x['process'].'</td>';
// 				echo '<td>'.$x['department'].'</td>';
// 				echo '<td>'.$x['section'].'</td>';
// 				echo '<td>'.$x['emline'].'</td>';
// 				echo '<td>'.$x['training_reason'].'</td>';
// 				echo '<td>'.$x['trainer'].'</td>';
// 				echo '</tr>';
// 			}
// 	}
// }else{
// 		echo '<tr>';
// 			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
// 			echo '</tr>';
// 			}
// 	}


//  if($method == 'getprocess'){
      	
//       		$categ = $_POST['value10'];
   
//        $fetchReason = "SELECT DISTINCT eprocess FROM trs_category WHERE curiculum = '$categ'";
//         $stmt = $conn->prepare($fetchReason);
//         $stmt->execute();
//         if($stmt->rowCount() > 0){
//             foreach($stmt->fetchALL() as $x){
//                 echo '<option value="'.$x['eprocess'].'">'.$x['eprocess'].'</option>';
//             }
//         }
//     }

     if($method == 'getOJT'){
      	
      		$categ = $_POST['value10'];
      		$eprocess = $_POST['value12'];
  
   
       $fetchReason = "SELECT DISTINCT ojt_period FROM trs_category WHERE eprocess LIKE '$eprocess%'";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['ojt_period'].'">'.$x['ojt_period'].'</option>';
            }
        }
    }
    

    if ($method == 'fetch_ojt') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		// $training = trim($_POST['training']);
		
		$c = 0;
	$query = "SELECT id,training_code,training_type,process,ojt_end,ojt_start,eval_status,ojt_status 
	,date_format(ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(ojt_end, '%m-%d-%Y') as ojt_end
	FROM trs_for_training WHERE confirmation = 5 AND eval_submit = ''  
	AND (ojt_start >='$dateFrom' AND ojt_end <= '$dateTo')
	 GROUP BY training_code ";

	 // ojt_status = '' OR eval_status = 'OJT Extension'
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#ojt_list_data" onclick="get_ojt_list(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
		
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


if ($method == 'fetch_ojt_view') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
		$c = 0;
	$query = "SELECT id,training_code,training_type,process,ojt_end,ojt_start 
	,date_format(ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(ojt_end, '%m-%d-%Y') as ojt_end
	FROM trs_for_training WHERE confirmation = 5 AND ojt_status = '' OR ojt_status='For OJT Extension' AND eval_submit = ''
		AND ojt_start >='$dateFrom' AND ojt_end <= '$dateTo' 
		GROUP BY training_code ";
// OR eval_status = 'OJT Extension'
	 
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#ojt_view_list_data" onclick="get_ojt_view_list(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
		
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}





if ($method == 'fetch_for_exams') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, eval_submit_date, auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date FROM trs_for_training WHERE ojt_status = 'Done' AND eval_submit = 'Done' AND eval_status = 'For Authorization' AND confirmation != '6' AND exam_status ='' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam_req" onclick="get_check_exam_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }





if ($method == 'fetch_for_examss') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%m-%d-%Y %H:%i:%s') as auth_date,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,trs_for_training.examiner
,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_status IS NOT NULL AND trs_for_training.auth_date IS NOT NULL AND trs_for_training.confirmation != '6' AND trs_for_training.exam_status = '' GROUP BY trs_for_training.employee_num
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
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '<td>'.$x['examiner'].'</td>';

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}




if ($method == 'fetch_pending_val') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
$dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, eval_submit_date, eval_status FROM trs_for_training WHERE ojt_status = 'Done' AND eval_submit = 'Done' AND eval_status = 'Pending Approval' AND confirmation != '6' AND
    	(eval_submit_date >='$dateFrom 00:00:00' AND eval_submit_date <= '$dateTo 23:59:59')
    	GROUP BY training_code
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_pending_val_req" onclick="get_check_pending_val_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eval_status'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }




if ($method == 'fetch_for_pending_val') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.eval_status,
trs_request.full_name,trs_request.eprocess,trs_request.training_type
,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE  trs_for_training.confirmation != '6'
AND trs_for_training.eval_status = 'Pending Approval' GROUP BY trs_for_training.employee_num
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
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['eval_status'].'</td>';
                echo '<td>'.$x['eval_remarks'].'</td>';

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}







 if ($method == 'submit_eval') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
  
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $approve = "UPDATE trs_for_training SET ojt_status = 'Done', eval_submit = 'Done', eval_submit_date = '$server_date_time' WHERE id = '$x'";
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




if ($method == 'submit_retain') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $last_status = $_POST['last_status'];
  
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
    		  
     		 $d = "SELECT did_not_attend_exam FROM trs_for_training WHERE id = '$x'";
    		 $stmt = $conn->prepare($d);
    		 $stmt->execute();

    		 foreach($stmt->fetchALL() as $i){
    		 	$did_not_attend_exam = $i['did_not_attend_exam'];
    		 }

if ($did_not_attend_exam != '') {
	echo 'error';

}
 

else{
		$check = "SELECT * FROM trs_for_training WHERE id = '$x'";
		$stmt = $conn->prepare($check);
		$stmt->execute();

		foreach($stmt->fetchALL() as $j){
			$employee_num = $j['employee_num'];
			$training_code = $j['training_code'];
			$confirmation = $j['confirmation'];
			$training_status = $j['training_status'];
			$attend = $j['attend'];
			$did_not_attend = $j['did_not_attend'];
			$remarks = $j['remarks'];
			$process = $j['process'];
			$training_type = $j['training_type'];
			$shift = $j['shift'];
			$ojt_start = $j['ojt_start'];
			$ojt_end = $j['ojt_end'];
			$start_time = $j['start_time'];
			$end_time = $j['end_time'];
			$ojt_status = $j['ojt_status'];
			$eval_remarks = $j['eval_remarks'];
			$extend_days = $j['extend_days'];
			$ojt_period = $j['ojt_period'];
			$training_start_date = $j['training_start_date'];
			$training_end_date = $j['training_end_date'];
			$eval_status = $j['eval_status'];
			$eval_submit = $j['eval_submit'];
			$eval_submit_date = $j['eval_submit_date'];
			$auth_date = $j['auth_date'];
			$examiner = $j['examiner'];
			$exam_remarks = $j['exam_remarks'];
			$attend_exam = $j['attend_exam'];
			$did_not_attend_exam = $j['did_not_attend_exam'];
			$exam_status = $j['exam_status'];
		}

$ojt_startt = date("Y-m-d", strtotime('+1 day',strtotime($server_date_only)));
$end_datee =  date('Y-m-d',(strtotime('+'.$ojt_period.' day', strtotime($ojt_startt))));

		$update = "UPDATE trs_for_training SET last_status = '$last_status' WHERE id= '$x'";
		$stmt = $conn->prepare($update);
		$stmt->execute();



if ($last_status == 'Retain') {

	$insert_into = "INSERT INTO trs_for_training (`employee_num`,`training_code`,`confirmation`,`training_status`,`attend`,`did_not_attend`,`remarks`,`process`,`training_type`,`shift`,`ojt_start`,`ojt_end`,`start_time`,`end_time`,`ojt_status`,`eval_remarks`,`extend_days`,`ojt_period`,`training_start_date`,`training_end_date`,`eval_status`,`eval_submit`,`eval_submit_date`,`auth_date`,`examiner`,`exam_remarks`,`attend_exam`,`did_not_attend_exam`,`exam_status`,`f_status`,`attempt`) SELECT '$employee_num','$training_code','$confirmation', '$training_status', '$attend', '$did_not_attend','$remarks', '$process', '$training_type', '$shift', '$ojt_start', '$ojt_end','$start_time', '$end_time','$ojt_status', '$eval_remarks','$extend_days','$ojt_period','$training_start_date','$training_end_date','$eval_status','$eval_submit','$eval_submit_date','$auth_date', '$examiner', '$exam_remarks', '$attend_exam', '$did_not_attend_exam', '$exam_status', 'Done','0' FROM trs_for_training WHERE id = '$x'";
			$stmt = $conn->prepare($insert_into);
 
				if ($stmt->execute()) {
	$approve = "UPDATE trs_for_training SET confirmation = 5, ojt_status = '', eval_remarks = '', extend_days = '', eval_status = '', eval_submit = '', auth_date = '', examiner = '', exam_remarks = '', attend_exam = '',
			did_not_attend_exam = '', exam_status = '', last_status = '$last_status', ojt_start = '$ojt_startt', ojt_end = '$end_datee', attempt = '0' WHERE attend_exam !='' AND id = '$x'";
        $stmt2 = $conn->prepare($approve);

        if ($stmt2->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
}


	
}else{

	$last = "UPDATE trs_for_training SET confirmation = 0, f_status = 'Done',last_status = '$last_status' WHERE id = '$x'  ";
		$stmt20 = $conn->prepare($last);
			if ($stmt20->execute()) {
				$select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
				$stmt21 = $conn->prepare($select);
				 $stmt21->execute();
               foreach($stmt21->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }

               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt1 = $conn->prepare($update);
                if ($stmt1->execute()) {
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
   }
     

       
} 

}



 if ($method == 'resubmit_eval') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
  
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $approve = "UPDATE trs_for_training SET ojt_status = '', eval_submit = '', eval_submit_date = '(NULL)',eval_status ='',auth_date='(NULL)',examiner='' WHERE id = '$x'";
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




if ($method == 'fetch_evaluationn_req') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];

        $c = 0;


        $query = "SELECT *,date_format(eval_submit_date, '%m-%d-%Y') as eval_submit_date FROM trs_for_training WHERE confirmation = '5' AND (eval_submit_date >='$dateFrom 00:00:00' AND eval_submit_date <= '$dateTo 23:59:59') AND ojt_status = 'Done' AND eval_submit = 'Done' OR eval_status LIKE 'OJT Extension%' GROUP BY training_code" ;

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_eval_req" onclick="get_check_eval_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eval_submit_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }



 


   if ($method == 'fetch_ojt_exam_req') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;


	$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end,
trs_request.full_name,trs_request.training_type
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5  AND trs_for_training.eval_submit ='' AND  trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_end <= '$server_date_only' 
";
 // AND trs_for_training.eval_status = '' OR trs_for_training.eval_status = 'OJT Extension'

// AND trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_end <= '$server_date_only' AND trs_for_training.eval_status = ''
// 		OR trs_for_training.eval_status = 'OJT Extension'
// GROUP BY trs_for_training.employee_num,trs_for_training.training_code
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
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
				   // echo '<td>  
       //                  <div class="row">
       //                  <div class ="col s12">
       //                  <input type="text" id="req_remarks" name"req_remakrs" autocomplete="off">
       //                  </div>
       //                  </div>

       //              </td>';
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}



   if ($method == 'fetch_ojt_view_data') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;


	$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end,
trs_request.full_name,trs_request.training_type,trs_for_training.eval_submit
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.eval_submit = '' AND trs_for_training.training_code = '$training_code'  GROUP BY trs_for_training.employee_num
";

 // AND trs_for_training.eval_status = '' OR trs_for_training.eval_status = 'OJT Extension'
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';


				
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['employee_num'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
				   // echo '<td>  
       //                  <div class="row">
       //                  <div class ="col s12">
       //                  <input type="text" id="req_remarks" name"req_remakrs" autocomplete="off">
       //                  </div>
       //                  </div>

       //              </td>';
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




   if ($method == 'fetch_ojt_eval_req') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;
 


	$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end,
trs_request.full_name,trs_request.training_type,trs_for_training.auth_date,Date_FORMAT(trs_for_training.auth_date, '%Y-%m-%d %H:%i:%s') as auth_date
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_status = 'Done' OR trs_for_training.eval_status LIKE 'OJT Extension%' GROUP BY trs_for_training.employee_num
";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
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
				echo '<td>'.$x['auth_date'].'</td>';
				   // echo '<td>  
       //                  <div class="row">
       //                  <div class ="col s12">
       //                  <input type="text" id="req_remarks" name"req_remakrs" autocomplete="off">
       //                  </div>
       //                  </div>

       //              </td>';
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


 if ($method == 'fetch_training_passed') {
		$role = $_POST['role'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
	
		
		$c = 0;
	$query = "SELECT * FROM trs_for_training WHERE confirmation != '0' AND training_status LIKE 'Done%' OR training_status LIKE 'Passed' GROUP BY training_code;

	 GROUP BY training_code ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
			

				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#passed" onclick="get_training_passed(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['training_status'].'</td>';
				
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


if ($method == 'fetch_training_failed') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$dateTo = $_POST['dateTo'];
		$dateFrom = $_POST['dateFrom'];
	
		
		$c = 0;
	$query = "SELECT * FROM trs_for_training WHERE confirmation = 0 AND training_status = 'Cancel.' OR training_status = 'Failed' 

	 GROUP BY training_code ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#training_failed" onclick="get_training_failed(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
		
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['training_status'].'</td>';
				
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


 if ($method == 'fetch_training_passed_data') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		$training_type = $_POST['training_type'];
		$c = 0;


	$query = "SELECT trs_request.employee_num,trs_request.full_name,
trs_for_training.training_type, trs_for_training.process,trs_for_training.training_status,trs_for_training.confirmation
FROM trs_request 
LEFT JOIN trs_for_training ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.training_type = '$training_type' AND trs_for_training.training_code = '$training_code' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['employee_num'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
			
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				
				echo '<td>'.$x['training_status'].'</td>';
				
			
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




if ($method == 'fetch_training_failed_data') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		$training_type = $_POST['training_type'];
		
		$c = 0;
	//LEFT JOIN query apply bukas

	$query = "SELECT trs_request.employee_num,trs_request.full_name,
trs_for_training.training_type, trs_for_training.process,trs_for_training.training_status,trs_for_training.confirmation
FROM trs_request 
LEFT JOIN trs_for_training ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 0 AND trs_for_training.training_type = '$training_type' AND trs_for_training.training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['employee_num'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
			
				echo '<td>'.$x['training_status'].'</td>';
				
			
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}














 if ($method == 'request_exam') {
	$id = [];
	$id = $_POST['id'];
	$newtraining_code = $_POST['newtraining_code'];
	//COUNT OF ITEM TO BE UPDATED
	$count = count($id);
	foreach($id as $x){
		$approve = "UPDATE e_r_for_training SET request_exam = '1', date_req_exam = '$server_date_time', date_exam_passed = '$server_date_time' WHERE id = '$x'";
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



if ($method == 'fetch_req_exam') {
		$role = $_POST['role'];
		$section = $_POST['esection'];
		$c = 0;
	$query = "SELECT * FROM e_r_for_training WHERE confirmation = 5 AND request_exam = 1 GROUP BY training_code";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="req_exam_data" onclick="get_req_exam(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['request_exam'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['date_req_exam'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


	 if ($method == 'fetch_exam_list') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;
	// $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";

	$query = "SELECT e_r_for_training.request_exam, e_r_for_training.id, e_r_for_training.training_code,e_r_for_training.employee_no,e_r_for_training.training_type,e_r_for_training.process,e_r_for_training.ojt_start, e_r_for_training.ojt_end, e_r_req.full_name FROM e_r_for_training LEFT JOIN e_r_req ON e_r_for_training.employee_no = e_r_req.employee_num WHERE e_r_for_training.confirmation = 5 AND e_r_for_training.request_exam = '1' AND e_r_for_training.training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['employee_no'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
			
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

	if ($method == 'fetch_exam_result') {
		$role = $_POST['role'];
		$section = $_POST['esection'];
		$c = 0;
	$query = "SELECT * FROM e_r_for_training WHERE request_exam = 1 AND sticker = 'granted' GROUP BY training_code";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="sticker_req" onclick="get_sticker_req(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['request_exam'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['date_exam_passed'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}


 if ($method == 'fetch_sticker_for_grant') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;
	// $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";

	$query = "SELECT e_r_for_training.remarks, e_r_for_training.sticker, e_r_for_training.request_exam, e_r_for_training.id, e_r_for_training.training_code,e_r_for_training.employee_no,e_r_for_training.training_type,e_r_for_training.process,e_r_for_training.ojt_start, e_r_for_training.ojt_end, e_r_req.full_name FROM e_r_for_training LEFT JOIN e_r_req ON e_r_for_training.employee_no = e_r_req.employee_num WHERE e_r_for_training.confirmation = 6 AND e_r_for_training.sticker = 'granted' AND e_r_for_training.training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['employee_no'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
				echo '<td>'.$x['remarks'].'</td>';
			
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}



if ($method == 'fetch_ojt_done') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$c = 0;
	$query = "SELECT * FROM e_r_for_training WHERE ojt_status != ''";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="evaL_req" onclick="eval_request(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}




 if ($method == 'fetch_evaluation_request') {
		$role = $_POST['role'];
		$training_code = $_POST['training_code'];
		
		$c = 0;


	$query = "SELECT e_r_for_training.id, e_r_for_training.training_code, e_r_for_training.employee_no, e_r_for_training.training_type,
e_r_for_training.process, e_r_for_training.ojt_start,e_r_for_training.ojt_end, e_r_for_training.ojt_status, e_r_req.full_name
from e_r_for_training
left join e_r_req on e_r_for_training.employee_no = e_r_req.employee_num
where e_r_for_training.ojt_status = 'Done' AND e_r_for_training.eval_submit == '' AND e_r_for_training.training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
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
				echo '<td>'.$x['employee_no'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['ojt_start'].'</td>';
				echo '<td>'.$x['ojt_end'].'</td>';
				echo '<td>'.$x['ojt_status'].'</td>';
			
                  

				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}



	 if ($method == 'submit_evaluation') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $approve = "UPDATE e_r_for_training SET eval_submit = 'Done', eval_submit_date = '$server_date_time' WHERE id = '$x'";
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
 

if ($method == 'fetch_scheds') {
		$role = $_POST['role'];
		$esection = $_POST['esection'];
		$c = 0;
	$query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time ,TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM e_r_training GROUP BY training_code ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
		$c++;

			if ($role == 'requestor') {
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_typee'].'</td>';
				echo '<td>'.$x['tprocess'].'</td>';
				echo '<td>'.$x['shift'].'</td>';
				echo '<td>'.$x['slot'].'</td>';
				echo '<td>'.$x['start_date'].'</td>';
				echo '<td>'.$x['end_date'].'</td>';
				echo '<td>'.$x['start_time'].'</td>';
				echo '<td>'.$x['end_time'].'</td>';
				echo '<td>'.$x['trainer'].'</td>';
				echo '</tr>';
			}
	}
}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
	}

if ($method == 'fetch_auth_req') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $c = 0;
    $query = "SELECT * FROM e_r_for_training WHERE auth_date != '' GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="req_check_auth" onclick="get_req_check_auth(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if ($method == 'fetch_auth_reqs') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $training_code = $_POST['training_code'];
        $c = 0;
    $query = "SELECT e_r_for_training.id,e_r_for_training.training_code, e_r_for_training.training_type, e_r_for_training.process,e_r_for_training.ojt_end,e_r_for_training.ojt_status,
e_r_for_training.eval_submit_date,e_r_for_training.extend_days,e_r_for_training.eval_remarks,e_r_for_training.auth_date,
e_r_for_training.employee_no,e_r_req.full_name
FROM e_r_for_training
LEFT JOIN e_r_req ON e_r_for_training.employee_no = e_r_req.employee_num WHERE e_r_for_training.training_code = '$training_code'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'requestor') {
                echo '<tr>';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['employee_no'].'</td>';
                echo '<td>'.$x['full_name'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['eval_submit_date'].'</td>';
                echo '<td>'.$x['extend_days'].'</td>';
                echo '<td>'.$x['eval_remarks'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

?>