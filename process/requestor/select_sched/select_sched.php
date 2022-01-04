<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST
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
?>