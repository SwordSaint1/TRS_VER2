<?php 
include '../../conn.php';
include '../../conn2.php';

$method = $_POST['method']; //ajax method POST

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

?>