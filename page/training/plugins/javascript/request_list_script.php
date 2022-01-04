<script type="text/javascript">
$(document).ready(function(){

         load_request_list();

	});

// function request list

const load_request_list =()=>{
    var role = '<?=$role;?>';
    var dateFrom = document.getElementById('requestlistrequestDateFrom').value;
    var dateTo = document.getElementById('requestlistrequestDateTo').value;
           $.ajax({
                url: '../../process/training/request_list/request_list.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_pending_req',
                    role:role,
                    dateFrom:dateFrom,
					dateTo:dateTo                
                },success:function(response){
          document.getElementById('pending_request_list').innerHTML = response;
                }
            });   
}	
</script>