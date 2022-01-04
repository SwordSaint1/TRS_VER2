<?php 
include '../../conn.php';
include '../../conn2.php';
$method = $_POST['method']; //ajax method POST

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

?>