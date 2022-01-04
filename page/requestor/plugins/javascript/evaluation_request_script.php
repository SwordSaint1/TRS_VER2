<script type="text/javascript">
$(document).ready(function(){
        load_validation_request_list();
    });	
const load_validation_request_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';

      var dateFrom = document.getElementById('valreqrequestDateFrom').value;
        var dateTo = document.getElementById('valreqrequestDateTo').value;
            // var training = document.getElementById('training_search_valreq').value;
           $.ajax({
                url: '../../process/requestor/sched_for_auth/sched_for_auth.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_evaluationn_req',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('val_req').innerHTML = response;
               
                }
            });

}


const get_check_eval_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';
    console.log(param);
    $('#training_code_ojt_evals').val(training_code);

console.log(training_code);
    $.ajax({
        url:'../../process/requestor/sched_for_auth/sched_for_auth.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_ojt_eval_req',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_eval_list_req').innerHTML = response;
           

        }
    });

}

const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_evaluation2');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_evaluation2');
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



const ojt_cancel =()=>{
   var arr = [];

    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
    var newtraining_code= document.getElementById('training_code_ojt_eval').value;
    var newojt_end =  document.getElementById('ojt_end_eval').value;
    var server_date_only= '<?=$server_date_only;?>';

    $.ajax({
        url: '../../process/requestor/sched_for_auth/sched_for_auth.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'resubmit_eval',
            id:arr,
            newtraining_code:newtraining_code,
            newojt_end:newojt_end,
            server_date_only:server_date_only
            
        },success:function(a) {
            console.log(a);
               if (a = 'success') {
                      swal('SUCCESS','Success!','success');
          
             load_validation_request_list();
        }

        }
    });
   }

}
</script>