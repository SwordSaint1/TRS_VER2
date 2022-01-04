<?php
	include 'conn.php';
	$method = $_POST['method'];

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
                    // echo '<td>  
                    //     <div class="row">
                    //     <div class ="col s12">
                    //     <input type="text" id="qualif_remarks" name="qualif_remarks" autocomplete="off" value="">
                    //     </div>
                    //     </div>

                    // </td>';
                echo '</tr>';
            }
        }
    }



// if ($method == 'qualif_confirm') {
//   $id = [];
//    $id = $_POST['id'];
//     $newbatch_number = $_POST['newbatch_number'];
//     $newstats = $_POST['newstats'];
//     $newneeds = $_POST['newneeds'];
//    echo $qremarks = $_POST['qremarks'];
   

//     //COUNT OF ITEM TO BE UPDATED
//     $count = count($id);
//     foreach($id as $x){
//             if ($newstats == 'Approve') {
//                 $approve = "UPDATE trs_for_training set remarks = '$qremarks' WHERE id='$x'";
//                 $stmt = $conn->prepare($approve);
//                 $stmt->execute();
//             }

//         }
// }

if ($method == 'qualif_confirm') {
    $id = [];
    $id = $_POST['id'];
    $newbatch_number = $_POST['newbatch_number'];
    $newstats = $_POST['newstats'];
    $qualif_remarks = $_POST['qualif_remarks'];
    $qualiftraining_t = $_POST['training_type'];
    $qualiftraining_n = $_POST['newneeds'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        if($newstats == 'Approve'){
        $approve = "UPDATE trs_request SET approval_status = '3', remarks = '$qualif_remarks', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifapproval_date = '$server_date_time'  WHERE id ='$x'";
        $stmt = $conn->prepare($approve);
        if($stmt->execute()){

        $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_approve_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifapproval_date FROM trs_request WHERE approval_status = 3 AND id ='$x'";

        $stmt = $conn->prepare($que);

        }
 
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }


    if ($newstats == 'Cancel') {
        $cancel = "UPDATE trs_request SET approval_status = '0', remarks = '$qualif_remarks', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifcancel_date = '$server_date_time'  WHERE id ='$x'";
        $stmt = $conn->prepare($cancel);
        if($stmt->execute()){

        $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_cancel_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifcancel_date FROM trs_request WHERE approval_status = 0 AND id ='$x'";

        $stmt = $conn->prepare($que);

        }
 
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




if($method == 'prevbatchApp_qualifedit'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
      
     
     

        $query = "SELECT * FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 2  AND id = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               echo $x['id'].'~!~'.$x['full_name'].'~!~'.$x['batch_number'].'~!~'.$x['position'].'~!~'.$x['department'].'~!~'.$x['section'].'~!~'.$x['emline'].'~!~'.$x['training_reason'].'~!~'.$x['approval_status'].'~!~'.$x['eprocess'].'~!~'.$x['ojt_period'];
            }
        }
    }


if($method == 'prevbatchApp_qualifview'){
        $id = trim($_POST['id']); 
        $batch_number = trim($_POST['batch_number']);
        $approval_status= trim($_POST['approval_status']);
        $request_date_time = trim($_POST['request_date_time']);
        $full_name = trim($_POST['full_name']);
         $eprocess = trim($_POST['eprocess']);
         $esection = $_POST['esection'];
    
     
     

        $query = "SELECT * FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 2 AND esection = '$esection' ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               


                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="qualif_edit" onclick="get_req_edit_qualif(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['request_date_time'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['department'].'~!~'.$x['section'].'~!~'.$x['emline'].'~!~'.$x['training_reason'].'&quot;)">';

                    
                    echo '<td>'.$x['employee_num'].'</td>';
                    echo '<td>'.$x['full_name'].'</td>';
                    echo '<td>'.$x['position'].'</td>';

                    echo '<td>'.$x['department'].'</td>';
                    echo '<td>'.$x['section'].'</td>';
                    echo '<td>'.$x['emline'].'</td>';
                    echo '<td>'.$x['training_reason'].'</td>';
                    echo '<td>'.$x['approval_status'].'</td>';
                    echo '<td>'.$x['request_date_time'].'</td>';
                

                echo '</tr>';
            }
        }
    }


if ($method == 'update_qualif') {
    $id = $_POST['id'];
    $qualif_status = $_POST['approval_status'];
    $qualiftraining_t = $_POST['training_type'];
    $qualiftraining_n = $_POST['training_need'];
 
    $qualifapproval_date = $_POST['qualifapproval_date'];
    $qualif_remarks = $_POST['qremarks'];

    $query = "UPDATE trs_request SET approval_status = '3', remarks = '$qualif_remarks', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifapproval_date = '$server_date_time'  WHERE id ='$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {

        
        $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_approve_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifapproval_date FROM trs_request WHERE approval_status = 3 AND id ='$id'";

        $stmt = $conn->prepare($que);
        
        if ($stmt->execute()) {
                
            echo 'y';

            }else{
                    echo 'n';
        }

        }
            
        }



if ($method == 'cancel_qualif') {
    $id = $_POST['id'];
    $qualif_status = $_POST['approval_status'];
    $qualiftraining_t = $_POST['training_type'];
    $qualiftraining_n = $_POST['training_need'];
    $qualifapproval_date = $_POST['qualifapproval_date'];
    $qualif_remarks = $_POST['qremarks'];

       $query = "UPDATE trs_request SET approval_status = '0', remarks = '$qualif_remarks', training_type = '$qualiftraining_t', training_need = '$qualiftraining_n', qualifcancel_date = '$server_date_time', ft_status = '0'  WHERE id ='$id'";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {


        $que = "INSERT INTO trs_qualif (batch_num, employee_num, qsection,qualif_remarks, training_need, qualif_cancel_date)
                SELECT batch_number, employee_num, esection, remarks, training_need, qualifcancel_date FROM trs_request WHERE approval_status = 0 AND id ='$id'";

        $stmt = $conn->prepare($que);
        
        if ($stmt->execute()) {
                
            echo 'y';

            }else{
                    echo 'n';
        }

        }
            
        }



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


        

//         if ($method == 'fetch_approve_request_qualif') {
//         $role = $_POST['role'];
//         $dateTo = $_POST['dateTo'];
//         $dateFrom = $_POST['dateFrom'];
//         $batch = trim($_POST['batch']);
    
//         $c = 0;
//     $query = "SELECT id,batch_number,qualifapproval_date, approval_status FROM trs_request WHERE approval_status = 3 AND (qualifcancel_date >='$dateFrom' AND qualifcancel_date <= '$dateTo') GROUP BY batch_number";
//     $stmt = $conn->prepare($query);
//     $stmt->execute();
//     if ($stmt->rowCount() > 0) {
//         foreach($stmt->fetchALL() as $x){
//         $c++;

//             if ($role == 'qualificator') {
//                 echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="qualif_approve" onclick="get_view_qualif(&quot;'.$x['id'].'~!~'.$x['batch_number'].'~!~'.$x['approval_status'].'~!~'.$x['qualifapproval_date'].'&quot;)">';
//                 echo '<td>'.$c.'</td>';
//                 echo '<td>'.$x['batch_number'].'</td>';
//                 // echo '<td>'.$x['approval_status'].'</td>';
//                 echo '<td>'.$x['qualifapproval_date'].'</td>';
//                 echo '</tr>';
//             }
//     }
// }else{
//         echo '<tr>';
//             echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
//             echo '</tr>';
//             }
//     }



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
                // echo '<td>'.$x['approval_status'].'</td>';
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
    

        // $query = "SELECT * FROM trs_request WHERE batch_number = '$batch_number' AND approval_status = 0 AND qualifcancel_date != '' ";

       $query = "SELECT trs_request.id,trs_request.full_name,trs_request.position,trs_request.department,trs_request.section,trs_request.emline,
trs_request.training_reason,trs_request.request_date_time,date_format(request_date_time, '%Y-%m-%d %H:%i:%s') as request_date_time,trs_qualif.employee_num,trs_qualif.qualif_cancel_date,trs_qualif.qualif_remarks, trs_qualif.batch_num,trs_request.eprocess

FROM trs_request
LEFT JOIN trs_qualif ON trs_request.employee_num = trs_qualif.employee_num
WHERE trs_qualif.batch_num = '$batch_number' AND trs_request.approval_status = 0 AND
trs_qualif.qualif_cancel_date IS NOT NULL
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
                    // echo '<td>'.$x['approval_status'].'</td>';
                    echo '<td>'.$x['request_date_time'].'</td>';
                     echo '<td>'.$x['qualif_cancel_date'].'</td>';
                      echo '<td>'.$x['qualif_remarks'].'</td>';
                     
                

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

    if ($method == 'register') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $full_name = $_POST['full_name'];
        $role = $_POST['role'];
        $esection = $_POST['esection'];



        $check = "SELECT id FROM trs_accounts WHERE username = '$username'";

    $stmt = $conn->prepare($check);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {

        echo 'x';
    
    }else{
         $insert = "INSERT INTO trs_accounts (`username`, `password`, `full_name`, `role`, `esection`, `date_created`) VALUES ('$username', '$password', '$full_name', '$role', '$esection', '$server_date_only')";
        $stmt = $conn->prepare($insert);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    }

       if ($method == 'fetch_acc_list') {
        $role = $_POST['role'];
        // $dateTo = $_POST['dateTo'];
        // $dateFrom = $_POST['dateFrom'];
        $roles = trim($_POST['roles']);
    
        $c = 0;
    $query = "SELECT * FROM trs_accounts WHERE role = '$roles'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#acc_edit" onclick="get_edit_acc(&quot;'.$x['id'].'~!~'.$x['username'].'~!~'.$x['password'].'~!~'.$x['full_name'].'~!~'.$x['role'].'~!~'.$x['esection'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['username'].'</td>';
                echo '<td>'.$x['full_name'].'</td>';
                echo '<td>'.$x['password'].'</td>';
                echo '<td>'.$x['role'].'</td>';
                echo '<td>'.$x['esection'].'</td>';
  
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


       if ($method == 'fetch_ojt_period') {
        $role = $_POST['role'];
        
        $curiculum = trim($_POST['curiculum']);
    
        $c = 0;
    $query = "SELECT * FROM trs_category WHERE curiculum = '$curiculum'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#ojt_period_edit" onclick="get_edit_ojt_period(&quot;'.$x['id'].'~!~'.$x['eprocess'].'~!~'.$x['training_type'].'~!~'.$x['ojt_period'].'~!~'.$x['curiculum'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['curiculum'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                echo '<td>'.$x['ojt_period'].'</td>';
                
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if ($method == 'add_process') {
       $newcuriculum = $_POST['newcuriculum'];
        $neweprocess = $_POST['neweprocess'];
        $newojt_period = $_POST['newojt_period'];



        $check = "SELECT id FROM trs_category WHERE eprocess = '$neweprocess'";

    $stmt = $conn->prepare($check);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {

        echo 'x';
    
    }else{
         $insert = "INSERT INTO trs_category (`curiculum`, `eprocess`,`training_type`,`ojt_period`) VALUES ('$newcuriculum', '$neweprocess', 'Special Batch Training', '$newojt_period')";
        $stmt = $conn->prepare($insert);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    }






if($method == 'prevEditAcc'){
        $id = trim($_POST['id']); 
        $username = trim($_POST['username']);
        $password= trim($_POST['password']);
        $full_name = trim($_POST['full_name']);
         $role= trim($_POST['role']);
        $esection = trim($_POST['esection']);
      
     
     

        $query = "SELECT * FROM e_r_accounts WHERE id = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach($stmt->fetchALL() as $x){
               // echo $x['id'].'~!~'.$x['username'].'~!~'.$x['password'].'~!~'.$x['full_name'].'~!~'.$x['role'].'~!~'.$x['esection'];

                echo  '<tr style="cursor:pointer;" class="modal-trigger" data-target="acc_edit" onclick="get_edit_acc(&quot;'.$x['id'].'~!~'.$x['username'].'~!~'.$x['password'].'~!~'.$x['full_name'].'~!~'.$x['role'].'~!~'.$x['esection'].'&quot;)">';
                echo '</tr>';
            }
        }
    }
if($method == 'update_accounts'){
        $id = trim($_POST['id']); 
        $username = trim($_POST['username']);
        $password= trim($_POST['password']);
        $full_name = trim($_POST['full_name']);
         $role= trim($_POST['role']);
        $esection = trim($_POST['esection']);
        // SQL
        $update = "UPDATE trs_accounts SET username = '$username', password = '$password', full_name = '$full_name', role = '$role', esection = '$esection' WHERE id = '$id'";
        $stmt = $conn->prepare($update);
        if($stmt->execute()){
            echo 'y';
        }else{
            echo 'n';
        }
    }



    if($method == 'update_ojt_period'){
        $id = trim($_POST['id']); 
        $curiculum = trim($_POST['curiculum']);
        $eprocess= trim($_POST['eprocess']);
        $training_type = trim($_POST['training_type']);
         $ojt_period= trim($_POST['ojt_period']);
 
        // SQL
        $update = "UPDATE trs_category SET ojt_period = '$ojt_period' WHERE id = '$id'";
        $stmt = $conn->prepare($update);
        if($stmt->execute()){
            echo 'y';
        }else{
            echo 'n';
        }
    }

if ($method == 'fetch_req_exam_qualif') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $c = 0;
    $query = "SELECT * FROM e_r_for_training WHERE request_exam = 1 AND exam_result = '' GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="exam_data" onclick="get_for_exam(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['request_exam'].'&quot;)">';
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


    


if ($method == 'fetch_evaluationn') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];

        $c = 0;

        $query = "SELECT *FROM trs_for_training WHERE 
        (eval_submit_date >= '$dateFrom' AND eval_submit_date <= '$dateTo')
        AND eval_submit LIKE 'done%'
        AND (eval_status = '' OR eval_status LIKE 'pending approval%' OR eval_status LIKE 'OJT Extension%')
        GROUP BY training_code";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal"  data-target="#check_eval" onclick="get_check_eval(&quot;'.$x['id'].'~!~'.$x['training_code'].'&quot;)">';
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

    
if ($method == 'fetch_validation') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date  ,examiner, eval_status FROM trs_for_training WHERE auth_date IS NOT NULL AND confirmation != '0' AND confirmation !='6' GROUP BY examiner,auth_date";
    $stmt = $conn->prepare($query);
  
    if ($stmt->execute()) {
        $search = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date  ,examiner, eval_status FROM trs_for_training WHERE (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') AND confirmation !='6' AND confirmation !='0' GROUP BY examiner,auth_date";
        $stmt2 = $conn->prepare($search);
         $stmt2->execute();
 
    if ($stmt2->rowCount() > 0) {
        foreach($stmt2->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_val" onclick="get_check_val(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['examiner'].'~!~'.$x['eval_status'].'~!~'.$x['auth_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['examiner'].'</td>';
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
   }



if ($method == 'fetch_for_exams') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date, attempt,examiner FROM trs_for_training WHERE ojt_status = 'Done' AND eval_submit = 'Done' AND eval_status = 'For Authorization' AND exam_status != 'Failed' AND confirmation != '6' AND confirmation !='0' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY examiner,auth_date ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam" onclick="get_check_exam(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['attempt'].'~!~'.$x['examiner'].'~!~'.$x['auth_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['examiner'].'</td>';
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
        $examiner = $_POST['examiner'];
        $auth_date = $_POST['auth_date'];
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";

 

$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,trs_for_training.examiner

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.ojt_status IS NOT NULL AND trs_for_training.auth_date IS NOT NULL AND trs_for_training.confirmation != '0' AND trs_for_training.confirmation !='6' AND trs_for_training.examiner ='$examiner' AND trs_for_training.auth_date = '$auth_date'
    
GROUP BY trs_for_training.employee_num
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
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';

               
            
                   // echo '<td>  
                   //      <div class="row">
                   //      <div class ="col s12">
                   //      <input type="text" id="remarks_for_exam" name"remarks_for_exam" autocomplete="off" value="">
                   //      </div>
                   //      </div>

                   //  </td>';
               
            
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}



if ($method == 'fetch_for_exam_passed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];        
        $c = 0;

$query = "SELECT DISTINCT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
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


if ($method == 'fetch_for_exam_failed') {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];        
        $c = 0;

$query = "SELECT DISTINCT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,trs_for_training.auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.exam_status,trs_for_training.examiner,
trs_request.full_name,trs_request.eprocess,trs_request.training_type
FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.training_code = '$training_code' AND trs_for_training.confirmation = '0' AND trs_for_training.exam_status = 'Failed' GROUP BY trs_for_training.employee_num
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

if ($method == 'add_section') {
        $section = $_POST['section'];
        


        $check = "SELECT id FROM trs_section WHERE section = '$section'";

    $stmt = $conn->prepare($check);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {

        echo 'x';
    
    }else{
         $insert = "INSERT INTO trs_section (`section`, `date_created`) VALUES ('$section', '$server_date_only')";
        $stmt = $conn->prepare($insert);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    }



 if ($method == 'confirm_exam') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
     $newexam_stat = $_POST['newexam_stat'];
      $newattendance_stat = $_POST['newattendance_stat'];
       $newremarks = $_POST['newremarks'];
       $newattempt = $_POST['newattempt'];
  

    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

     

if ($newattendance_stat == 'Attend' && $newexam_stat == 'Passed'){
                $q2= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '6', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt = $conn->prepare($q2);
               if ($stmt->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt = $conn->prepare($select);
               $stmt->execute();
               foreach($stmt->fetchALL() as $u)
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

          
            
        }else{
      
        }
  
         } if ($newattendance_stat == 'Did Not Attend' && $newexam_stat == 'Failed'){
                $q3= "UPDATE trs_for_training SET did_not_attend_exam = (did_not_attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt3 = $conn->prepare($q3);
               if ($stmt3->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt4 = $conn->prepare($select);
               $stmt4->execute();
               foreach($stmt4->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt5 = $conn->prepare($update);
               if ($stmt5->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }

                }else{
      
        }
    } if ($newattendance_stat == 'Attend' && $newexam_stat == 'Failed'){
                $q4= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt7 = $conn->prepare($q4);
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
}

}
if ($newattendance_stat == 'Attend' && $newexam_stat == 'Failed' && $newattempt == '0'){
                $q10= "UPDATE trs_for_training SET attend_exam = (attend_exam + 1),exam_status = '$newexam_stat', confirmation = '0', exam_remarks = '$newremarks' WHERE id = '$x'";
                 $stmt15 = $conn->prepare($q10);
               if ($stmt15->execute()) {

               $select = "SELECT employee_num FROM trs_for_training WHERE id = '$x'";
               $stmt16 = $conn->prepare($select);
               $stmt16->execute();
               foreach($stmt16->fetchALL() as $u)
               {
                $employee_num = $u['employee_num'];
               }
               $update ="UPDATE trs_request SET ft_status = '0' WHERE employee_num = '$employee_num'";
               $stmt17 = $conn->prepare($update);
               if ($stmt17->execute()) {
                  // echo 'approved';
                   $count = $count - 1;
               }else{
                     // echo 'error';
               }
}

}


}
 

}

if ($method == 'fetch_for_passed') {
        $role = $_POST['role'];
        $section = $_POST['esection'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date, exam_status,examiner FROM trs_for_training WHERE confirmation = '6' AND exam_status = 'Passed' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59') GROUP BY examiner,auth_date";
    $stmt = $conn->prepare($query);
    

        $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam_passed" onclick="get_check_exam_passed(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['examiner'].'~!~'.$x['auth_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['examiner'].'</td>';
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





if ($method == 'fetch_for_failed') {
        $role = $_POST['role'];
        $section = $_POST['esection'];   
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $c = 0;
    $query = "SELECT id, training_code, training_type, auth_date,Date_FORMAT(auth_date, '%Y-%m-%d %H:%i:%s') as auth_date, exam_status,examiner FROM trs_for_training WHERE confirmation = '0' AND exam_status = 'Failed' AND (auth_date >='$dateFrom 00:00:00' AND auth_date <= '$dateTo 23:59:59')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#check_exam_failed" onclick="get_check_exam_failed(&quot;'.$x['id'].'~!~'.$x['training_code'].'~!~'.$x['examiner'].'~!~'.$x['auth_date'].'&quot;)">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['examiner'].'</td>';
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



 if ($method == 'fetch_section') {
        $role = $_POST['role'];
      
        $section_search = trim($_POST['section_search']);
    
        $c = 0;
    $query = "SELECT * FROM trs_section WHERE section = '$section_search'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                // echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="section" onclick="get_edit_acc(&quot;'.$x['id'].'&quot;)">';
                echo '<tr>';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['section'].'</td>';
                echo '<td>'.$x['date_created'].'</td>';
               
  
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="5" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }






  if ($method == 'fetch_for_eval') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,trs_for_training.eval_remarks

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation != '0' AND trs_for_training.training_code = '$training_code' AND trs_for_training.ojt_status = 'Done'  AND trs_for_training.eval_status = '' OR trs_for_training.eval_status = 'Pending Approval' OR trs_for_training.eval_status = 'OJT Extension' AND trs_for_training.eval_submit = 'Done' GROUP BY trs_for_training.employee_num
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
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                 echo '<td>'.$x['eval_remarks'].'</td>';
                echo '<td>'.$x['eval_submit_date'].'</td>';
               

                 // echo '<td>  
                 //        <div class="row">
                 //        <div class ="col s12">
                 //        <input type="text" id="extension_days" name"extension_days" autocomplete="off" value="0">
                 //        </div>
                 //        </div>

                 //    </td>';
            
                   // echo '<td>  
                   //      <div class="row">
                   //      <div class ="col s12">
                   //      <input type="text" id="remarks_for_eval" name"remarks_for_eval" autocomplete="off" value="">
                   //      </div>
                   //      </div>

                   //  </td>';
                  // echo '<td>  
                  //       <div class="row">
                  //       <div class ="col s12">
                  //       <input type="datetime-local" id="authorize_date" name="authorize_date">
                  //       </div>
                  //       </div>


                  //   </td>';
            
                  

                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}


if ($method == 'fetch_for_val') {
        $role = $_POST['role'];
        $training_code = $_POST['training_code'];
        $examiner = $_POST['examiner'];
        $auth_date = $_POST['auth_date'];
        $c = 0;
    // $query = "SELECT * FROM e_r_for_training WHERE confirmation = 5  GROUP BY training_code ";



$query = "SELECT trs_for_training.id, trs_for_training.employee_num, trs_for_training.training_code,trs_for_training.ojt_end,trs_for_training.ojt_status,
trs_for_training.eval_submit_date,trs_for_training.extend_days,trs_for_training.eval_remarks,
trs_request.full_name,trs_request.eprocess,trs_request.training_type,
trs_for_training.auth_date,Date_FORMAT(trs_for_training.auth_date, '%Y-%m-%d %H:%i:%s') as auth_date,trs_for_training.examiner

FROM trs_for_training
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.auth_date IS NOT NULL AND trs_for_training.eval_status != 'Pending Approval' AND trs_for_training.confirmation !='6' AND trs_for_training.confirmation != '0' AND trs_for_training.auth_date = '$auth_date' AND trs_for_training.examiner = '$examiner' GROUP BY trs_for_training.employee_num
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
                echo '<td>'.$x['training_type'].'</td>';
                echo '<td>'.$x['eprocess'].'</td>';
                 echo '<td>'.$x['ojt_end'].'</td>';
                echo '<td>'.$x['ojt_status'].'</td>';
                echo '<td>'.$x['auth_date'].'</td>';
                echo '</tr>';
            }
    }else{
        echo '<tr>';
            echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }

}




 if ($method == 'eval') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $newextend = $_POST['newextend'];
    echo $newremarks = $_POST['newremarks'];
    $newevalstat = $_POST['newevalstat'];
    $authorize_date = $_POST['authorize_date'];
    $examiner = $_POST['examiner'];


    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
     foreach($id as $x){


            if ($newevalstat == 'OJT Extension') {
                $q = "UPDATE trs_for_training SET eval_status = '$newevalstat', extend_days = '$newextend',auth_date = '', eval_submit_date = ''  WHERE id = '$x'";
                $stmt = $conn->prepare($q);
                if ($stmt->execute()) {

               

        $check ="SELECT extend_days, ojt_end FROM trs_for_training WHERE id = '$x'";
        $stmt = $conn->prepare($check);
        $stmt->execute();
        foreach($stmt->fetchALL() as $data){
            $extend_days =  $data['extend_days'];
            $ojt_end = $data['ojt_end'];
        }

         $extension=  date('Y-m-d',(strtotime('+'.$extend_days.' day', strtotime($ojt_end))));

                    $try = "UPDATE trs_for_training set ojt_end = '$extension', eval_remarks = '$newremarks', ojt_status = 'For OJT Extension', eval_submit = '', training_status = 'Passed' WHERE id = '$x'";
                    $stmt2 = $conn->prepare($try);


                  if ($stmt2->execute()) {  
            
            $count = $count - 1;
            // echo 'success';
        }else{
            // echo 'fail';
        }
            


}





             }if ($newevalstat == 'For Authorization') {

                $q = "UPDATE trs_for_training SET eval_status = '$newevalstat', auth_date = '$authorize_date', examiner = '$examiner', eval_remarks = '$newremarks' WHERE id = '$x'";
                $stmt = $conn->prepare($q);
                if ($stmt->execute()) {
            
            $count = $count - 1;
            // echo 'success';
        }else{
            // echo 'fail';
        }


             }if ($newevalstat == 'Pending Approval') {
                $q = "UPDATE trs_for_training SET eval_status = '$newevalstat', eval_remarks = '$newremarks' WHERE id = '$x'";
                $stmt = $conn->prepare($q);
                if ($stmt->execute()) {
            
            $count = $count - 1;
            // echo 'success';
        }else{
            // echo 'fail';
        }
}


}
 if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }


} 



    if ($method == 'update_ojt_qualif') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $ojt_start = $_POST['ojt_start'];
    $ojt_end = $_POST['ojt_end'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){




        $approve = "UPDATE trs_for_training SET ojt_start = '$ojt_start', ojt_end = '$ojt_end' WHERE id = '$x'";
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



 

    if ($method == 'val') {
    $id = [];
    $id = $_POST['id'];
    $newtraining_code = $_POST['newtraining_code'];
    $authorize_date_val = $_POST['authorize_date_val'];
    $newexaminer = $_POST['newexaminer'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){




        $approve = "UPDATE trs_for_training SET auth_date = '$authorize_date_val', examiner = '$newexaminer' WHERE id = '$x'";
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

if($method == 'fetch_ojt_qualif'){
        $id = trim($_POST['id']); 
        $training_code = $_POST['training_code'];

         $c = 0;


$query = "SELECT trs_for_training.id,trs_for_training.training_code,trs_for_training.employee_num,trs_for_training.training_type,trs_for_training.process, trs_for_training.ojt_start,trs_for_training.ojt_end, trs_request.full_name
FROM trs_for_training 
LEFT JOIN trs_request ON trs_for_training.employee_num = trs_request.employee_num
WHERE trs_for_training.confirmation = 5 AND trs_for_training.ojt_status = '' OR
trs_for_training.ojt_status = 'For OJT Extension' AND trs_for_training.eval_status =
'OJT Extension' AND trs_for_training.training_code = '$training_code' AND trs_for_training.id = '$id' GROUP BY trs_for_training.employee_num";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
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
                        echo '<td>'.$x['training_type'].'</td>';
          
                echo '<td>'.$x['process'].'</td>';
               
               
                echo '<td>'.$x['ojt_start'].'</td>';
        

                echo '<td>'.$x['ojt_end'].'</td>';
        
                

                echo '</tr>';
            }
        }
    }






 if ($method == 'fetch_for_ojt') {
        $role = $_POST['role'];
        $process = $_POST['process'];
    
        $c = 0;
    // $query = "SELECT id,training_code,training_type,process,ojt_end FROM trs_for_training WHERE confirmation = '5' AND ojt_status ='' OR eval_status = 'OJT Extension' GROUP BY training_code";

        $query = " SELECT * FROM trs_for_training WHERE confirmation = '5' AND ojt_status ='' OR eval_status = 'OJT Extension' GROUP BY training_code
        ";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $a ="SELECT process FROM trs_for_training WHERE process LIKE '$process%'";
        $stmt2 = $conn->prepare($a);

    
        $stmt2->execute();
    if ($stmt2->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
            

        $c++;

            if ($role == 'qualificator') {
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



}


   if ($method == 'fetch_history_list') {
        $role = $_POST['role'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
    
        $c = 0;

    $query = " SELECT trs_request.cancel_date,trs_request.id,trs_request.employee_num,trs_request.full_name,trs_request.approval_date,trs_request.approval_status,trs_request.request_date_time,
trs_for_training.training_start_date,trs_for_training.training_end_date,trs_training_sched.trainer,
trs_for_training.training_status,trs_for_training.ojt_start,trs_for_training.ojt_end,trs_for_training.auth_date,
trs_for_training.examiner,trs_for_training.exam_status,trs_for_training.last_status

FROM trs_request
LEFT JOIN trs_for_training ON trs_for_training.employee_num = trs_request.employee_num
LEFT JOIN trs_training_sched ON trs_for_training.training_code = trs_training_sched.training_code
WHERE (trs_request.request_date_time >='$dateFrom 00:00:00' AND trs_request.request_date_time <= '$dateTo 23:59:59') GROUP BY trs_for_training.id
";



    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

            if ($role == 'qualificator') {
                echo '<tr">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['full_name'].'</td>';
                echo '<td>'.$x['approval_date'].$x['cancel_date'].'</td>';
                echo '<td>'.$x['approval_status'].'</td>';
                echo '<td>'.$x['training_start_date'].'</td>';
                 echo '<td>'.$x['training_end_date'].'</td>';
                  echo '<td>'.$x['trainer'].'</td>';
                   echo '<td>'.$x['training_status'].'</td>';
                   echo '<td>'.$x['ojt_start'].'</td>';
                    echo '<td>'.$x['ojt_end'].'</td>';
                     echo '<td>'.$x['auth_date'].'</td>';
                      echo '<td>'.$x['examiner'].'</td>';
                       echo '<td>'.$x['exam_status'].'</td>';
                       echo '<td>'.$x['last_status'].'</td>';

  
                echo '</tr>';
            }
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }






?>