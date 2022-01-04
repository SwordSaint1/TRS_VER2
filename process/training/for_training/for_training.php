<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

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

?>