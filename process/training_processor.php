 <?php
	include 'conn.php';
	$method = $_POST['method'];

 if($method == 'generateTrCode'){
		$prefix = "TR:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if($method == 'generateBatchCode'){
        $prefix = "BC:";
        $dateCode = date('ymd');
        $randomCode = mt_rand(10000,50000);
        echo $prefix."".$dateCode."".$randomCode;
    }



	if ($method == 'insertSched') {
		$training_code = trim($_POST['TrCode']);
		$training_type = $_POST['training_type'];
		$slot = $_POST['slot'];
		$start_date = $_POST['start_date'];
		// $start_date_exp = explode('T',$start_date);
		// $new_start_date = $start_date_exp[0].' '.$start_date_exp[1];
		$end_date = $_POST['end_date'];
		// $end_date_exp = explode('T',$end_date);
		// $new_end_date = $end_date_exp[0].' '.$end_date_exp[1];
		$shift = $_POST['shift'];
		$process = $_POST['process'];
		$rtraining_type = $_POST['rtraining_type'];
        $location = $_POST['location'];
		$sched_stat = 1;


        //     $check = "SELECT id FROM trs_training_sched WHERE process = '$process' AND sched_stat = 1 ";

        // $stmt = $conn->prepare($check);
        // $stmt->execute();
        // if ($stmt->rowCount() > 0) {
        //     echo 'Already Have Training Schedule For this Training Code';
        // }
        // else{

		$query = "INSERT INTO trs_training_sched (`training_code`,`training_type`,`slot`,`start_date`,`end_date`,`shift`,`process`,`sched_stat`,`rtraining_type`,`location`) VALUES('$training_code','$training_type','$slot','$start_date','$end_date','$shift','$process', '$sched_stat', '$rtraining_type','$location')";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'Successfully';
		}else{
			echo 'Error';
		}
    }

	// }


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

if ($method == 'prev_sched') {
	$c =0;
	$training_code = trim($_POST['training_code']);
	$query = "SELECT * FROM trs_training_sched WHERE training_code = '$training_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';
		echo '<td>'.$c.'</td>';
		echo '<td>'.$x['training_code'].'</td>';
				echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['shift'].'</td>';
				echo '<td>'.$x['slot'].'</td>';
				echo '<td>'.$x['start_date'].'</td>';
				echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['location'].'</td>';

		echo '</tr>';
	}
}


if($method == 'set'){

        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];     
        $c=0;

        $query = "SELECT *,date_format(start_date, '%m-%d-%Y') as start_date
        ,date_format(end_date, '%m-%d-%Y') as end_date
        ,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE sched_stat = 1 AND (start_date >='$dateFrom 00:00:00' AND end_date <= '$dateTo 23:59:59')";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                $c++;

                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#set" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['training_type'].'~!~'.$x['slot'].'~!~'.$x['training_code'].'~!~'.$x['rtraining_type'].'~!~'.$x['sched_stat'].'&quot;)">'; 
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['rtraining_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['start_time'].'</td>';
                echo '<td>'.$x['end_time'].'</td>';
                echo '<td>'.$x['location'].'</td>';
                echo '</tr>';
            }
        }else{
        echo '<tr>';
        echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
        echo '</tr>';
            }
    }


if($method == 'update'){
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];           
        $c=0;
       $query = "SELECT *,date_format(start_date, '%m-%d-%Y') as start_date
       ,date_format(end_date, '%m-%d-%Y') as end_date
       ,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE sched_stat = 2 AND (start_date >='$dateFrom 00:00:00' AND end_date <= '$dateTo 23:59:59')";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               $c++; 

                
            echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_update(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['training_type'].'~!~'.$x['slot'].'~!~'.$x['training_code'].'~!~'.$x['rtraining_type'].'~!~'.$x['sched_stat'].'&quot;)">';

                echo '<td>'.$c.'</td>';   
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$x['start_time'].'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['end_time'].'</td>';
                echo '<td>'.$x['trainer'].'</td>';
                echo '<td>'.$x['location'].'</td>';
                

                echo '</tr>';
            }
        }else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }




 if($method == 'prevbatchtrain'){
  		$id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
   


      $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE sched_stat = 1 AND training_code LIKE '$training_code%'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){

            	

      
                	echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="train_edit" onclick="get_edit_train(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['training_type'].'~!~'.$x['slot'].'~!~'.$x['training_code'].'~!~'.$x['rtraining_type'].'~!~'.$x['sched_stat'].'&quot;)">';	
             
            			echo '<td>'.$x['training_type'].'</td>';
				echo '<td>'.$x['rtraining_type'].'</td>';
				echo '<td>'.$x['process'].'</td>';
				echo '<td>'.$x['slot'].'</td>';
				echo '<td>'.$x['start_date'].'</td>';
				echo '<td>'.$x['end_date'].'</td>';
				echo '<td>'.$x['start_time'].'</td>';
				echo '<td>'.$x['end_time'].'</td>';
            	echo '<td>'.$x['location'].'</td>';

                echo '</tr>';
            }
        }
    }

if($method == 'prevbatchApp_trainingedit'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        $sched_stat= trim($_POST['sched_stat']);
    
     

        $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time,TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE training_code = '$training_code' AND sched_stat = 1  AND id = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               echo $x['id'].'~!~'.$x['training_code'].'~!~'.$x['sched_stat'].'~!~'.$x['training_type'].'~!~'.$x['rtraining_type'].'~!~'.$x['process'].'~!~'.$x['start_date'].'~!~'.$x['start_time'].'~!~'.$x['end_date'].'~!~'.$x['end_time'].'~!~'.$x['slot'].'~!~'.$x['shift'].'~!~'.$x['location'];
            }
        }
    }



    if($method == 'prevbatchApp_trainingedit_updated'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        $sched_stat= trim($_POST['sched_stat']);
    
     

        $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time,TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE training_code = '$training_code' AND sched_stat = 2  AND id = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               echo $x['id'].'~!~'.$x['training_code'].'~!~'.$x['sched_stat'].'~!~'.$x['training_type'].'~!~'.$x['rtraining_type'].'~!~'.$x['process'].'~!~'.$x['start_date'].'~!~'.$x['start_time'].'~!~'.$x['end_date'].'~!~'.$x['end_time'].'~!~'.$x['slot'].'~!~'.$x['shift'].'~!~'.$x['trainer'].'~!~'.$x['location'];
            }
        }
    }




if($method =='update_training'){
	$id = $_POST['id'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
    $trainer = $_POST['trainer'];
     $slot = $_POST['slot'];
     $location = $_POST['location'];

		
	$query = "UPDATE trs_training_sched SET start_time = '$start_time', end_time = '$end_time', sched_stat = 2, trainer = '$trainer', slot = '$slot', location = '$location' WHERE id = '$id'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'y';
	}else{
		echo 'n';
	}
}


if($method =='updated_training'){
    $id = $_POST['id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $start_date = $_POST['start_date'];
     $end_date = $_POST['end_date'];
    $trainer = $_POST['trainer'];
     $slot = $_POST['slot'];
     $location = $_POST['location'];
     $training_code = $_POST['training_code'];
        
    $query = "UPDATE trs_training_sched SET start_date = '$start_date', start_time = '$start_time', end_time = '$end_time', sched_stat = 2, trainer = '$trainer', slot = '$slot', end_date ='$end_date', location = '$location' WHERE id = '$id'";

    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        echo 'y';
    }else{
        echo 'n';
    }
}





        if ($method == 'fetch_updated_sched') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];

    
        $c = 0;
    $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time  FROM trs_training_sched WHERE sched_stat = 2 AND slot != 0 AND (start_date >='$dateFrom 00:00:00' AND end_date <= '$dateTo 23:59:59')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        	

         
        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="sched_details" onclick="get_view_sched(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$x['start_time'].'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['end_time'].'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }




if($method == 'view_updated_sched_training'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        // $sched_stat= trim($_POST['sched_stat']);

       $query = "SELECT *,TIME_FORMAT(start_time, '%H:%i:%s') as start_time, TIME_FORMAT(end_time, '%H:%i:%s') as end_time FROM trs_training_sched WHERE sched_stat = 2 AND training_code = '$training_code' AND id = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                

                
            echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="train_edit_updated" onclick="get_edit_updated_train(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['training_type'].'~!~'.$x['slot'].'~!~'.$x['training_code'].'~!~'.$x['rtraining_type'].'~!~'.$x['sched_stat'].'&quot;)">';

                    
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$x['start_time'].'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$x['end_time'].'</td>';
                echo '<td>'.$x['trainer'].'</td>';
                echo '<td>'.$x['location'].'</td>';
                

                echo '</tr>';
            }
        }
    }


 if ($method == 'fetch_for_training_list') {
        $role = $_POST['role'];


    
        $c = 0;
    // $query = "SELECT * FROM e_r_training WHERE sched_stat = 2 GROUP BY training_code";


    $query = "SELECT e_r_training.id, e_r_training.training_code, e_r_training.training_typee, e_r_training.tprocess, e_r_training.start_date, e_r_training.end_date, e_r_training.start_time, e_r_training.end_time, e_r_req.employee_num FROM e_r_training LEFT JOIN e_r_req ON e_r_training.training_code = e_r_req.training_codee WHERE e_r_req.approval_status = '4'";


    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        	

            	$start_time = date('H:i:s');
            	$end_time = date('H:i:s');

        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="training_list" onclick="get_for_training_list(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_typee'].'&quot;)">';
                echo '<td>'.$c.'</td>';
             
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_typee'].'</td>';
                echo '<td>'.$x['tprocess'].'</td>';
       
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$start_time.'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$end_time.'</td>';
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }



if($method == 'fetch_for_training2'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        // $sched_stat= trim($_POST['sched_stat']);
           $c = 0;

       // $query = "SELECT * FROM e_r_training WHERE id = '$id'";

           $query = "SELECT e_r_req.employee_num,e_r_req.training_type,e_r_training.tprocess,e_r_training.slot,e_r_req.start_date,e_r_req.start_time,e_r_req.end_date,e_r_req.end_time FROM e_r_req LEFT JOIN e_r_training ON e_r_req.id = e_r_training.id WHERE e_r_req.approval_status = 4 ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                     $c++;

            	$start_time = date('H:i:s');
            	$end_time = date('H:i:s');

           
                echo '<tr>';

                    echo '<td>'.$c.'</td>';
                  echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['tprocess'].'</td>';
                echo '<td>'.$x['slot'].'</td>';
                echo '<td>'.$x['start_date'].'</td>';
                echo '<td>'.$start_time.'</td>';
                echo '<td>'.$x['end_date'].'</td>';
                echo '<td>'.$end_time.'</td>';
                

                echo '</tr>';
            }
        }
    }


//FOR TRAINING
        if ($method == 'fetch_for_training_data_list') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
    
        $c = 0;
    $query = "SELECT id, training_type, training_code,training_start_date,training_end_date,process FROM trs_for_training WHERE confirmation = 4 AND (training_start_date >='$dateFrom' AND training_end_date <= '$dateTo') GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
            

        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#training_filter_type" onclick="get_training_type_filter(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['process'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
        
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }




        if ($method == 'fetch_attendance_data_list') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
    
        $c = 0;
        // confirmation = '5' OR confirmation = '0' OR confirmation = '6' 
    $query = "SELECT id,training_code,training_type,process FROM trs_for_training WHERE
    (training_start_date >='$dateFrom' AND training_end_date <= '$dateTo') AND confirmation != 4
    GROUP BY training_code, training_type";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
            

        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="#attendance_view" data-toggle="modal" onclick="get_attendance_view(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                 echo '<td>'.$x['process'].'</td>';    
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="10" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }



    if ($method == 'fetch_for_ojt') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        
        $c = 0;
        
    $query = "SELECT id,training_code,training_type,process,ojt_start,ojt_end, eval_status FROM trs_for_training WHERE ojt_start >='$dateFrom' AND ojt_end <= '$dateTo' AND confirmation = '5' AND ojt_status = '' OR ojt_status = 'For OJT Extension' GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
            

        $c++;

            if ($role == 'training') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#ojt_view" onclick="get_ojt_view(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['ojt_end'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['training_code'].'</td>';
                echo '<td>'.$x['training_type'].'</td>';
                 echo '<td>'.$x['process'].'</td>';
        
                echo '</tr>';
            }
    }
}else{ 
        echo '<tr>';
            echo '<td colspan="4" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


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



     if($method == 'training_filter_type'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        $training_type= trim($_POST['training_type']);
       

     $c = 0;
    
   
 
       $query = "SELECT id,training_type,training_code,process FROM trs_for_training WHERE training_code = '$training_code' AND confirmation = '4' GROUP BY training_type,process";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                
 $c++;
           
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#training_filter_process" onclick="get_filter_process(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['process'].'&quot;)">';

                      echo '<td>'.$c.'</td>';
                   
                    echo '<td>'.$x['training_type'].'</td>';
                    echo '<td>'.$x['process'].'</td>';
                  
                

                echo '</tr>';
            }
        }
    }


     if($method == 'training_filter_process'){
        $id = trim($_POST['id']); 
      $training_code = trim($_POST['training_code']);
        $training_type= trim($_POST['training_type']);
        $process= trim($_POST['process']);
         $c = 0;
    

    $query = "SELECT trs_training_sched.id,trs_training_sched.process,trs_training_sched.training_code,trs_training_sched.training_type,trs_training_sched.start_time,TIME_FORMAT(trs_training_sched.start_time, '%H:%i:%s') as start_time,trs_training_sched.end_time,TIME_FORMAT(trs_training_sched.end_time, '%H:%i:%s') as end_time,trs_training_sched.location,trs_for_training.id,trs_for_training.employee_num,trs_request.full_name,trs_for_training.ojt_period,trs_training_sched.start_date,trs_training_sched.end_date,trs_for_training.process
        
        FROM trs_training_sched
        LEFT JOIN trs_for_training ON trs_for_training.training_code = trs_training_sched.training_code
        LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
        WHERE trs_for_training.confirmation = '4' AND trs_for_training.training_code = '$training_code' AND trs_for_training.process = '$process' GROUP BY trs_for_training.employee_num";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               
            $c++;


           echo $x['id'].'~!~'.$x['training_code'].'~!~'.$x['training_type'].'~!~'.$x['process'].'~!~'.$x['ojt_period'].'~!~'.$x['start_time'].'~!~'.$x['end_time'].'~!~'.$x['location'].'~!~'.$x['employee_num'];
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
                    echo '<td>'.$x['employee_num'].'</td>';

                     echo '<td>'.$x['full_name'].'</td>';
            
                    echo '<td>'.$x['start_date'].'</td>';
                   
                    echo '<td>'.$x['end_date'].'</td>';
                

                echo '</tr>';
            }
        }
    }


    if ($method == 'confirm_training') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $newtraining_stat = $_POST['newtraining_stat'];
    $newattendance_stat = $_POST['newattendance_stat'];
    $newremarks = $_POST['newremarks'];


    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $check ="SELECT ojt_period, training_start_date FROM trs_for_training WHERE id = '$x'";
        $stmt = $conn->prepare($check);
        $stmt->execute();
        foreach($stmt->fetchALL() as $data){
           echo $ojt_period =  $data['ojt_period'];
           $start = $data['training_start_date'];
        }

        $ojt_start = date("Y-m-d", strtotime('+1 day',strtotime($start)));
    echo  $end_date=  date('Y-m-d',(strtotime('+'.$ojt_period.' day', strtotime($ojt_start))));

        if ($newattendance_stat == 'Did Not Attend' && $newtraining_stat == 'Cancel.'){
                $query= "UPDATE trs_for_training SET did_not_attend = (did_not_attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt = $conn->prepare($query);
               if ($stmt->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt2 = $conn->prepare($select);
               $stmt2->execute();
               foreach($stmt2->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt3 = $conn->prepare($update);
               if ($stmt3->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

          
            
        }else{
      
        }
  
         } 
        

        if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Cancel.'){
                $query2= "UPDATE trs_for_training SET attend = (attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt4 = $conn->prepare($query2);
               if ($stmt4->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt5 = $conn->prepare($select);
               $stmt5->execute();
               foreach($stmt5->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt6 = $conn->prepare($update);
               if ($stmt6->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    }

     if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Cancel'){
                $query3= "UPDATE trs_for_training SET attend = (attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt7 = $conn->prepare($query3);
               if ($stmt7->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt8 = $conn->prepare($select);
               $stmt8->execute();
               foreach($stmt8->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt9 = $conn->prepare($update);
               if ($stmt9->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    }
    
       if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Failed'){
                $query4= "UPDATE trs_for_training SET attend = (attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt10 = $conn->prepare($query4);
               if ($stmt10->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt11 = $conn->prepare($select);
               $stmt11->execute();
               foreach($stmt11->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt12 = $conn->prepare($update);
               if ($stmt12->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    }

     if ($newattendance_stat == 'Did Not Attend' && $newtraining_stat == 'Failed'){
                $query5= "UPDATE trs_for_training SET did_not_attend = (did_not_attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt13 = $conn->prepare($query5);
               if ($stmt13->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt14 = $conn->prepare($select);
               $stmt14->execute();
               foreach($stmt14->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt15 = $conn->prepare($update);
               if ($stmt15->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    }
    
     if ($newattendance_stat == 'Did Not Attend' && $newtraining_stat == 'Cancel'){
                $query6= "UPDATE trs_for_training SET did_not_attend = (did_not_attend + 1),training_status = '$newtraining_stat', confirmation = '0', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt16 = $conn->prepare($query6);
               if ($stmt16->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt17 = $conn->prepare($select);
               $stmt17->execute();
               foreach($stmt17->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt18 = $conn->prepare($update);
               if ($stmt18->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    }
    
    if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Passed'){
                $query7 = "UPDATE trs_for_training SET attend = attend + 1,training_status = '$newtraining_stat', confirmation = '5', ojt_start = '$ojt_start', ojt_end = '$end_date' WHERE id = '$x'";
                $stmt19 = $conn->prepare($query7);
                if ($stmt19->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
}

    if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Ongoing') {
                $query8 = "UPDATE trs_for_training SET attend = (attend + 1), training_status = '$newtraining_stat' WHERE id = '$x'";
                $stmt20 = $conn->prepare($query8);
                if ($stmt20->execute()) {
            
            $count = $count - 1;
            // echo 'success';
        }else{
            // echo 'fail';
        }
        }

        if ($newattendance_stat == 'Attend' && $newtraining_stat == 'Done'){
                $query9= "UPDATE trs_for_training SET attend = (attend + 1),training_status = '$newtraining_stat', confirmation = '5', ojt_start = '$ojt_start', ojt_end = '$end_date', remarks = '$newremarks' WHERE id = '$x'";
                 $stmt21 = $conn->prepare($query9);
               if ($stmt21->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
  
          }
        }

}
if($method == 'view_attendance'){
        $id = trim($_POST['id']); 
        $training_code = trim($_POST['training_code']);
        $training_type = trim($_POST['training_type']);
         $c = 0;


$query ="SELECT DISTINCT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,trs_for_training.process,
trs_for_training.ojt_start,trs_for_training.ojt_end, trs_for_training.training_start_date,trs_for_training.training_end_date,trs_for_training.attend,
trs_for_training.did_not_attend,trs_for_training.training_status,
trs_request.position,trs_request.department,
trs_request.full_name,trs_training_sched.trainer
,date_format(trs_for_training.training_start_date, '%m-%d-%Y') as training_start_date
	,date_format(trs_for_training.training_end_date, '%m-%d-%Y') as training_end_date


FROM trs_for_training
LEFT JOIN trs_request ON trs_request.employee_num = trs_for_training.employee_num 
LEFT JOIN trs_training_sched ON trs_for_training.training_code = trs_training_sched.training_code
WHERE 
trs_for_training.training_code = '$training_code' AND confirmation != '4'
AND trs_for_training.training_type = '$training_type'


";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                
 $c++;
              

           
                echo '<tr>';
                 echo '<td>'.$c.'</td>';
                     echo '<td>'.$x['training_code'].'</td>';
                         echo '<td>'.$x['training_type'].'</td>';
                    echo '<td>'.$x['employee_num'].'</td>';
                     echo '<td>'.$x['full_name'].'</td>';
                  echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                echo '<td>'.$x['department'].'</td>';
            
                 echo '<td>'.$x['attend'].'</td>';
                 echo '<td>'.$x['did_not_attend'].'</td>';
                  echo '<td>'.$x['training_status'].'</td>';
                   echo '<td>'.$x['trainer'].'</td>';
                echo '<td>'.$x['training_start_date'].'</td>';
               
                echo '<td>'.$x['training_end_date'].'</td>';
        
                

                echo '</tr>';
            }
        }
    }
 


if($method == 'view_ojt'){
        $id = trim($_POST['id']); 
        $training_code = $_POST['training_code'];
        $training_type = $_POST['training_type'];
         $c = 0;


// $query = "SELECT trs_for_training.training_status, trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,trs_for_training.process, trs_for_training.ojt_start,trs_for_training.ojt_end, trs_request.full_name
// FROM trs_for_training 
// LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
// WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_status = '' OR trs_for_training.ojt_status = 'For OJT Extension' GROUP BY trs_for_training.employee_num";


$query = "SELECT trs_for_training.confirmation,trs_for_training.training_status, 
trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,
trs_for_training.process, trs_for_training.ojt_start,trs_for_training.ojt_end, trs_request.full_name
,date_format(trs_for_training.ojt_start, '%m-%d-%Y') as ojt_start
	,date_format(trs_for_training.ojt_end, '%m-%d-%Y') as ojt_end
FROM trs_for_training 
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE  trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation != 0 AND trs_for_training.confirmation = 5 
AND trs_for_training.ojt_status != 'Done' AND trs_for_training.training_type = '$training_type'
GROUP BY trs_for_training.training_type, trs_for_training.employee_num

";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                
 $c++;
              

           
                echo '<tr>';
                
                 echo '<td>'.$c.'</td>';
                     echo '<td>'.$x['training_code'].'</td>';
                      
                    echo '<td>'.$x['employee_num'].'</td>';
                     echo '<td>'.$x['full_name'].'</td>';
                        echo '<td>'.$x['training_type'].'</td>';
          
                echo '<td>'.$x['process'].'</td>';
               
               
                echo '<td>'.$x['ojt_start'].'</td>';
        

                echo '<td>'.$x['ojt_end'].'</td>';
        
                

                echo '</tr>';
            }
        }
    }


  if($method == 'get_training_status'){

      echo $training_type_for = $_POST['valueee'];
    
       $fetchReason = "SELECT DISTINCT training_status FROM trs_training_status WHERE training_type = '$training_type_for'";
        $stmt = $conn->prepare($fetchReason);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
                echo '<option value="'.$x['training_status'].'">'.$x['training_status'].'</option>';
            }
        }
    }


 if ($method == 'submit_eval') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
  
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $approve = "UPDATE e_r_for_training SET ojt_status = 'Done' WHERE id = '$x'";
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

?>