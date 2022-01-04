<script type="text/javascript">
	  $(document).ready(function(){
      
	  		load_for_sched();
      
    });
	// SELECT SCHEDULE TAB
const load_for_sched =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('for_schedrequestDateFrom').value;
     var dateTo = document.getElementById('for_schedrequestDateTo').value;
           $.ajax({
                url: '../../process/requestor/select_sched/select_sched.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_sched_request_req',
                    role:role,
                    esection:esection,
                     dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
            document.getElementById('sched_data_req').innerHTML = response;
                }
            });
   
}

const get_view_req_sched =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var esection = '<?=$esection;?>';
    $('#batch_number_sched').val(batch_number);

  
    $.ajax({
        url:'../../process/requestor/select_sched/select_sched.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'schedbatch',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            $('#request_data_sched').html(response);
        }
    });

}


//function select training sched modal

const get_sched_approve =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var esection = '<?=$esection;?>';
    $.ajax({
        url:'../../process/requestor/select_sched/select_sched.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevsched_confirm',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            var string = response.split('~!~');
            $('#id_sched_for_training').val(string[0]);
            $('#sched_full_name').val(string[1]);
            $('#batch_number_for_training').val(string[2]);
            $('#sched_position').val(string[3]);
            $('#sched_department').val(string[4]);
            $('#sched_section').val(string[5]);
            $('#sched_line').val(string[6]);
            $('#sched_training_r').val(string[7]);
            $('#sched_training_t').val(string[8]);
            $('#sched_training_n').val(string[9]);
            $('#sched_training_process').val(string[10]);
            $('#ojt_period_sched').val(string[11]);
            $('#slot_for').val(string[12]);
            $('#trainer_for').val(string[13]);  
            $('#sched_training_location').val(string[14]); 
        }
    });

}

//function shift dropdown
const load_shift =()=>{
     
         var training_type = $('#sched_training_t').val();
         var process = $('#sched_training_process').val();

  
        $.ajax({
            url: '../../process/req_processor.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getshiftConfirm',
                training_type:training_type,
                process:process
            },success:function(data){
                load_start_date();
            }
        });
    }
 

const load_start_date =()=>{
      
        var value6 = $('#training_code_for_training').val();
         var value = $('#sched_training_shift').val();
         var value2 = $('#sched_training_process').val();
         var value3 = $('#sched_training_t').val();
        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getstartdateConfirm',
                value:value,
                value2:value2,
                value3:value3,
                value6:value6
            },success:function(data){
                $('#sched_training_startdate_schedule').html(data);
                load_end_date();


            } 
        });
    }

 const load_end_date =()=>{
         var startd = $('#sched_training_startdate_schedule').val();
         var process = $('#sched_training_process').val();
         var training_type = $('#sched_training_t').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getenddateConfirm',
                startd:startd,
                process:process,
                training_type:training_type
            },success:function(data){
                $('#sched_training_enddate_schedule').html(data);
                 setTimeout(load_start,100);
            }
        });
    }

   
    const load_start =()=>{
        var shift = $('#sched_training_shift').val();
        var start_d = $('#sched_training_startdate_schedule').val();
        var end_d = $('#sched_training_enddate_schedule').val();
        var process = $('#sched_training_process').val();
        var training_typee = $('#sched_training_t').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getSchedConfirmStart_time',
                shift:shift,
                start_d:start_d,
                end_d:end_d,
                process:process,
                training_typee:training_typee
            },success:function(data){
                $('#sched_training_start').html(data);
             setTimeout(load_slot,100);
             setTimeout(load_end_time,100);
             setTimeout(load_training_code,100);
             setTimeout(load_trainer,100);
         
            }
        });
    }
    
    const load_training_code =()=>{
      
         var processs = $('#sched_training_process').val();
         var typee = $('#sched_training_t').val();
         var start = $('#sched_training_startdate_schedule').val();
         var endd = $('#sched_training_enddate_schedule').val();
         var start_t = $('#sched_training_start').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'gettrainingcode',
                processs:processs,
                typee:typee,
                start:start,
                endd:endd,
                start_t:start_t
            },success:function(data){
                $('#training_code_for_training').html(data);
                  setTimeout(load_location,100);
            }
        });
    }

     const load_trainer =()=>{
      
         var processs = $('#sched_training_process').val();
         var typee = $('#sched_training_t').val();
         var start = $('#sched_training_startdate_schedule').val();
         var endd = $('#sched_training_enddate_schedule').val();
         var start_t = $('#sched_training_start').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'gettrainer',
                processs:processs,
                typee:typee,
                start:start,
                endd:endd,
                start_t:start_t
            },success:function(data){
                $('#trainer_for').html(data);
              
            }
        });
    }


     const load_slot =()=>{
      
         var processs = $('#sched_training_process').val();
         var typee = $('#sched_training_t').val();
         var start = $('#sched_training_startdate_schedule').val();
         var endd = $('#sched_training_enddate_schedule').val();
         var start_t = $('#sched_training_start').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getslot',
                processs:processs,
                typee:typee,
                start:start,
                endd:endd,
                start_t:start_t
            },success:function(data){
                $('#slot_for').html(data);
              
            }
        });
    }


    const load_end_time =()=>{
        var training_typee = $('#sched_training_t').val();
        var process = $('#sched_training_process').val();
        var shift = $('#sched_training_shift').val();
        var start_d = $('#sched_training_startdate_schedule').val();
        var end_d = $('#sched_training_enddate_schedule').val();
        var start_t = $('#sched_training_start').val();

        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getSchedConfirmend_time',
                training_typee:training_typee,
                process:process,
                shift:shift,
                start_d:start_d,
                end_d:end_d,
                start_t:start_t
               
            },success:function(data){
                $('#sched_training_end').html(data);
             
            }
        });
    }



    const load_location =()=>{
         var training_codee = $('#training_code_for_training').val();
         var processs = $('#sched_training_process').val();
         var typee = $('#sched_training_t').val();
         var start = $('#sched_training_startdate_schedule').val();
         var endd = $('#sched_training_enddate_schedule').val();
         var start_t = $('#sched_training_start').val();
        $.ajax({
            url: '../../process/requestor/select_sched/select_sched.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getLocation',
                processs:processs,
                typee:typee,
                start:start,
                endd:endd,
                start_t:start_t,
                training_codee:training_codee
            },success:function(data){
                console.log(data);
                $('#sched_training_location').html(data);

               
             
            }
        });
    }

  
  // select sched confirm function
const confirm_sched =()=>{
    var id = document.getElementById('id_sched_for_training').value;
    var batch_number = document.getElementById('training_code_for_training').value;
    var full_name = $('#sched_full_name').val();
    var position = $('#sched_position').val();
    var department = $('#sched_department').val();
    var section = $('#sched_section').val();
    var emline = $('#sched_line').val();
    var training_reason = $('#sched_training_r').val();
    var training_type = $('#sched_training_t').val();
    var training_need = $('#sched_training_n').val();
    var eprocess = $('#sched_training_process').val();
    var start_date = $('#sched_training_startdate_schedule').val();
    var end_date = $('#sched_training_enddate_schedule').val();
    var start_time = $('#sched_training_start').val();
    var end_time = $('#sched_training_end').val();
    var training_code = $('#training_code_for_training').val();
    var training_shift = $('#sched_training_shift').val();
    var slot = document.getElementById('training_code_for_training').value;

    if(slot == ''){
    
         swal('INFORMATION','Please Select Training Schedule!','info');
    }
    else{

        $.ajax({
        url: '../../process/requestor/select_sched/select_sched.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'confirm_sched_req',
            id:id,
            batch_number:batch_number,
            full_name:full_name,
            position:position,
            department:department,
            section:section,
            emline:emline,
            training_reason:training_reason,
            training_type:training_type,
            training_need:training_need,
            eprocess:eprocess,
            start_date:start_date,
            start_time:start_time,
            end_date:end_date,
            end_time:end_time,
            training_code:training_code,
            training_shift:training_shift

           
        },success:function(i){
            // console.log(i);
 
            if (i == 'y') {
                swal('SUCCESS','Success!','success');
                  $('#sched_training_startdate_schedule').val('');
                  $('#sched_training_shift').val('');
              
                
            }
           

        }
    });
    }
}
  
function url(){
   window.location.assign("select_schedule.php")
}
   
</script>