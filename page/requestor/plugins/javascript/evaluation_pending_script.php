<script type="text/javascript">
 $(document).ready(function(){
       load_pending_val();
    });

const load_pending_val =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('pendingvalrequestDateFrom').value;
     var dateTo = document.getElementById('pendingvalrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/evaluation_result/pending.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_pending_val',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    document.getElementById('pending_val_data_req').innerHTML = response;
               
                }
            });
 
}


const get_check_pending_val_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_training_for_pending_val').val(training_code);

    $.ajax({
        url:'../../process/requestor/evaluation_result/pending.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_pending_val',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            console.log(response);
            document.getElementById('pending_val_list').innerHTML = response;
           

        }
    });

}
	
</script>