<script type="text/javascript">
  $(document).ready(function(){
       load_exam_retain();
    });


const load_exam_retain =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('examfailedrequestDateFrom').value;
    var dateTo = document.getElementById('examfailedrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/examination_result/retain.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_retain',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    document.getElementById('retain_data_req').innerHTML = response;
               
                }
            });

}

const get_check_exam_retain_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var did_not_attend_exam = data[3];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_failed').val(training_code);
     $('#did_not_attend_failed').val(did_not_attend_exam);

    $.ajax({
        url:'../../process/requestor/examination_result/retain.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_exam_retain',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_retain_list_req').innerHTML = response;
           

        }
    });
}

const uncheck_all =()=>{
    var select_all = document.getElementById('check_all');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all');
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

const retain_req =()=>{
   var arr = [];

    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
    var newtraining_code= document.getElementById('training_code_failed').value;
    var last_status= document.getElementById('last_status').value;
    $('#confirm_sched').attr('disabled',true);


    $.ajax({
        url: '../../process/requestor/examination_result/retain.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'submit_retain',
            id:arr,
            newtraining_code:newtraining_code,
            last_status:last_status
        
        },success:function(a) {
               if (a == 'success') {
                      swal('SUCCESS','Success!','success');
                         load_exam_retain();
             }
              if (a == 'error')
             {
                swal('Not Qualified','Not Qualified!','info');
                         load_exam_retain();
             }
             $('#retain_req').attr('disabled',false);
        }
    });
   }

}

</script>