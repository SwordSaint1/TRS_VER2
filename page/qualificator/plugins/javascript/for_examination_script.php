<script type="text/javascript">
	$(document).ready(function(){
    	load_for_exam_list();
    });	


	const load_for_exam_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('for_examrequestDateFrom').value;
    var dateTo = document.getElementById('for_examrequestDateTo').value;
           $.ajax({
                url: '../../process/qualificator/for_exam/for_exam.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_exams',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                },success:function(response){
                    document.getElementById('for_exam_data').innerHTML = response;
               
                }
            });

}
//get data in for exam modal

const get_check_exam =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var attempt = data[2];
    var examiner = data[3];
    var auth_date = data[4];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_training_for_exam').val(training_code);
    $('#attempt_for_exam').val(attempt);
    $('#examiner_for_exam').val(examiner);
    $('#auth_date_for_exam').val(auth_date);

    $.ajax({
        url:'../../process/qualificator/for_exam/for_exam.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_examss',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code,
            examiner:examiner,
            auth_date:auth_date
        },success:function(response){
            document.getElementById('exam_list_qualif').innerHTML = response;
           

        }
    }); 

}

//function for_training_process ojt list  modal confirm function
const confirm_exam =()=>{
   var arr = [];

    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
    var newtraining_code= document.getElementById('training_code_training_for_exam').value;
    var newexam_stat= document.getElementById('exam_stat').value;
    var newattendance_stat= document.getElementById('attendance_stats_exam').value;
    var newremarks= document.getElementById('remarks_for_exam').value;
    var newattempt = document.getElementById('attempt_for_exam').value;
  
    if (newattendance_stat == 'Did Not Attend' && newexam_stat == 'Passed') {
        swal('INFORMATION','Invalid','info');
                    $('#exam_stat').val('');
                    $('#attendance_stats_exam').val('');
                    $('#remarks_for_exam').val('');
                    uncheck_all_examination();
    }
    else{
    $.ajax({
        url: '../../process/qualificator/for_exam/for_exam.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'confirm_exam',
            id:arr,
            newtraining_code:newtraining_code,
            newexam_stat:newexam_stat,
            newattendance_stat:newattendance_stat,
            newremarks:newremarks,
            newattempt:newattempt
        },success:function(a) {
               if (a = 'success') {
                 swal('SUCCESS','Success!','success');
                   $('#exam_stat').val('');
                    $('#attendance_stats_exam').val('');
                    $('#remarks_for_exam').val('');
                    uncheck_all_examination();
                    load_for_exam_list();
                
        }

        }
    });
   }
}
}

//uncheck and check all function in check eval modal
const uncheck_all_examination =()=>{
    var select_all = document.getElementById('check_all_examination');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func_examination =()=>{
    var select_all = document.getElementById('check_all_examination');
    if(select_all.checked == true){
        console.log('check');
        $('.singleCheck').each(function(){
            this.checked=true;
        });
    }else{
        console.log('uncheck');
        $('.singleCheck').each(function(){
            this.checked=false;
        });
    }
}
</script>