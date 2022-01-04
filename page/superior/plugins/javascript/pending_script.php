<script type="text/javascript">
 $(document).ready(function(){
    load_pending_superior();

    });	

 //function pending tab
 function load_pending_superior(){
       var role = '<?=$role;?>';
       var esection = '<?=$esection;?>';
       var dateFrom = document.getElementById('pending_suprequestDateFrom').value;
    var dateTo = document.getElementById('pending_suprequestDateTo').value;

        // console.log(role);
            $.ajax({
                url: '../../process/superior/training_request/pending.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_superior',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo

                },success:function(response){
                    console.log(response);
                    // document.getElementById('request_data_superior').innerHTML = response;
                    $('#request_data_superior').html(response);
                }
            });
        }

// 
const get_req =(param)=>{
     var esection = '<?=$esection;?>';
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
  
      $('#id_prev_superior').val(id);
    $('#batch_number_prev_superior').val(batch_number);
    $('#approval_status_prev_superior').val(approval_status);
    $('#req_date_time_prev_superior').val(request_date_time);
  
    $.ajax({
        url:'../../process/superior/training_request/pending.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatchApp',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            $('#request_list_data').html(response);
        }
    });

}

// check all and uncheck
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


// cancel function
const cancel_req =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    console.log(arr);
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    // var id = document.getElementById('id_prev_superior').value;
    var newbatch_number= document.getElementById('batch_number_prev_superior').value;
    // var newapproval_status= document.getElementById('approval_status_prev').value;

    $.ajax({
        url: '../../process/superior_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'cancel_request',
            id:arr,
            newbatch_number:newbatch_number
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
                load_pending_superior();
                 uncheck_all();
                swal('Cancel!', 'Cancel', 'info');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}


//approved tab
const approve_req =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    console.log(arr);
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    // var id = document.getElementById('id').value;
    var newbatch_number= document.getElementById('batch_number_prev_superior').value;
    // var newapproval_status= document.getElementById('approval_status_prev').value;

    $.ajax({
        url: '../../process/superior_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'approve_request',
            id:arr,
            newbatch_number:newbatch_number
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
                load_pending_superior();
                uncheck_all();
                swal('SUCCESS!', 'APPROVED', 'success');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
//approve tab

</script>