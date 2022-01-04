<?php
  include '../../conn.php';
  include '../../conn2.php';

  $method = $_POST['method']; //ajax method POST
//requestor  
  if($method == 'generateBatchCode'){
    $prefix = "RC:";
    $dateCode = date('ymd');
    $randomCode = mt_rand(10000,50000);
    echo $prefix."".$dateCode."".$randomCode;
  }
// detect
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

//insert request
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

//preview request
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

//DROP DOWN CURICULUM
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

//OJT PERIOD
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
    


?>