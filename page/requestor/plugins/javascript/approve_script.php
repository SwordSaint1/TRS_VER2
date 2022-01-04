<script type="text/javascript">
	$(document).ready(function(){
		 load_approved_list_req();       
	});
	// function in approved tab
const load_approved_list_req =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('approverequestDateFrom').value;
     var dateTo = document.getElementById('approverequestDateTo').value;          
           $.ajax({
                url: '../../process/requestor/request/approved.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_approve_request_req',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('approved_data_req').innerHTML = response;
           
                }
            });
    
}

// function approve modal

const get_view_approve_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var esection = '<?=$esection;?>';
    
    $('#id_approve').val(id);
    $('#batch_number_approve').val(batch_number);
    $('#approval_status_approve').val(approval_status);
    $('#req_date_time_approve').val(request_date_time);
  
    $.ajax({
        url:'../../process/requestor/request/approved.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatch_approve',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            $('#data_request_approve').html(response);
        }
    });

}




</script>