<script type="text/javascript">
	$(document).ready(function(){
		
		 load_cancelled_list();
        
	});


	// function in cancelled tab
const load_cancelled_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('cancelrequestDateFrom').value;
     var dateTo = document.getElementById('cancelrequestDateTo').value;
  // var batch = document.getElementById('batch_search_cancel').value;
     $.ajax({
                url: '../../process/requestor/request/cancelled.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_cancel_request_req',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('cancel_data_req').innerHTML = response;
                      $('#batch_search_cancel').val('');
                }
            });
   
}


// function cancel modal

const get_cancel_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var esection = '<?=$esection;?>';
  
    $('#id_cancel').val(id);
    $('#batch_number_cancel').val(batch_number);
    $('#approval_status_cancel').val(approval_status);
    $('#req_date_time_cancel').val(request_date_time);
  
    $.ajax({
        url:'../../process/requestor/request/cancelled.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatch_cancel',
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