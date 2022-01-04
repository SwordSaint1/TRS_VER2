<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if($method == 'generateTrCode'){
		$prefix = "TR:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000000);
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

?>