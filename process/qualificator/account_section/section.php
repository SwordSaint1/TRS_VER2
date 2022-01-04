<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

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
?>