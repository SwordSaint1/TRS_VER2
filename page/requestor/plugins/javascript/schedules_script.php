<script type="text/javascript">
	$(document).ready(function(){
		
		 load_sched_list();
        
	});

const load_sched_list =()=>{
     var role = '<?=$role;?>';

       var dateFrom = document.getElementById('processrequestDateFrom').value;
        var dateTo = document.getElementById('processrequestDateTo').value;

            var process = document.getElementById('process_search').value;

           $.ajax({
                url: '../../process/requestor/sched/sched.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_updated_sched',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    process:process
                    
                },success:function(response){
                    console.log(response);
                    document.getElementById('updated_sched_list').innerHTML = response;
               
                }
            });
   
} 


</script>