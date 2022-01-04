<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

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
?>