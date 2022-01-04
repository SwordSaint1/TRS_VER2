<script type="text/javascript">
	 $(document).ready(function(){
    load_cancelled_list_superior();

    });	

	//function cancelled tab

const load_cancelled_list_superior =()=>{
     var role = '<?=$role;?>';
      var dateFrom = document.getElementById('cancel_suprequestDateFrom').value;
    var dateTo = document.getElementById('cancel_suprequestDateTo').value;
 

           $.ajax({
                url: '../../process/superior/training_request/cancelled.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_cancel_request_superior',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('cancel_data').innerHTML = response;
               
                }
            });
   
} 

//cancel modal

const get_cancel_superior =(param)=>{
     var esection = '<?=$esection;?>';
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
  
      $('#id_cancel_superior').val(id);
    $('#batch_number_cancel_superior').val(batch_number);
    $('#approval_status_cancel_superior').val(approval_status);
    $('#req_date_time_cancel_superior').val(request_date_time);
  
    $.ajax({
        url:'../../process/superior/training_request/cancelled.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'cancelBatch',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            $('#data_request_cancel').html(response);
        }
    });

}


</script>