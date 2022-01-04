
<script type="text/javascript">
	$(document).ready(function(){
		
		 load_pending();
        
	});

 // function in pending tab

      function load_pending(){
       var role = '<?=$role;?>';
       var esection = '<?=$esection;?>';
        var dateFrom = document.getElementById('pendingrequestDateFrom').value;
        var dateTo = document.getElementById('pendingrequestDateTo').value;

            // var batch = document.getElementById('batch_search').value;
   
        // console.log(role);
            $.ajax({
                url: '../../process/requestor/request/pending.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_request',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('request_data').innerHTML = response;
               $('#batch_search').val('');
                }
            });
        }

        
// pending modal

const get_view =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
  

      $('#id_prev').val(id);
    $('#batch_number_prev').val(batch_number);
    $('#approval_status_prev').val(approval_status);
    $('#req_date_time_prev').val(request_date_time);
  console.log(batch_number);
    $.ajax({
        url:'../../process/requestor/request/pending.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatch',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time
        },success:function(response){
            $('#view_request_data').html(response);
        }
    });

}




</script>