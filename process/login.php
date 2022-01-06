<?php
 include 'conn.php';
 session_start();
 if (isset($_POST['login_btn'])) {
 	$username = $_POST['username'];
 	$password = $_POST['password'];
    // $role = $_POST['role'];
    $esection = $_POST['section'];
 	if (empty($username)) {
 		echo 'Please Enter Username';
 	}else if(empty($password)){
 		echo 'Please Enter Password';
 	}else if(empty($esection)){
        echo 'Please Select Section';
    }else{

 		$check = "SELECT id,role FROM trs_accounts WHERE BINARY username = '$username' AND BINARY password = '$password' AND esection = '$esection'";
 		$stmt = $conn->prepare($check);
 		$stmt->execute();
 		if ($stmt->rowCount() > 0) {
 			foreach($stmt->fetchALL() as $x){
 				$role = $x['role'];
 			}
 			if($role == 'requestor'){
 				$_SESSION['username'] = $username;
 				header('location: page/requestor/dashboard.php');
 			}else if($role == 'superior'){
                $_SESSION['username'] = $username;
                header('location: page/superior/dashboard.php');    
            }else if($role == 'qualificator'){               
                $_SESSION['username'] = $username;
                header('location: page/qualificator/dashboard.php'); 

            }else if($role == 'training'){
                
                $_SESSION['username'] = $username;
                header('location: page/training/dashboard.php');    
            }

    //         else if($role == 'admin'){
 			// 	$_SESSION['username'] = $username;
 			// 	header('location: page/qualificator.php');
 			// }
 		}else{
 			echo 'Wrong Username, Password or Section';
 		}
 	}
 }
 if (isset($_POST['Logout'])) {
 	session_unset();
 	session_destroy();
 	header('location: ../index.php');
 }
?>