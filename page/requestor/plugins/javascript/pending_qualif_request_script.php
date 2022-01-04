<script type="text/javascript">
		$(document).ready(function(){
		
		 load_pendingq_list();
        
	});

		// function in approved tab
const load_pendingq_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('pendingqrequestDateFrom').value;
     var dateTo = document.getElementById('pendingqrequestDateTo').value;
    
           $.ajax({
                url: '../../process/requestor/request/pending_qualif.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_pendingq_request_req',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('request_pendingq_data').innerHTML = response;
    
                }
            });
    
}


const get_view_pendingq_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var esection = '<?=$esection;?>';
  
    $('#id_pending').val(id);
    $('#batch_number_pending').val(batch_number);
    $('#approval_status_pending').val(approval_status);
    $('#req_date_time_pending').val(request_date_time);
 
    $.ajax({
        url:'../../process/requestor/request/pending_qualif.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prev_pendingq',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            esection:esection
        },success:function(response){
            $('#data_pendingq_request').html(response);
        }
    });

}


</script>