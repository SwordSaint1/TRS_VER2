<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

 if ($method == 'fetch_acc_list') {
        $role = $_POST['role'];
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

?>