<script type="text/javascript">
$(document).ready(function(){
         load_training_failed();  
	});


const load_training_failed =()=>{
var role = '<?=$role;?>';
var esection = '<?=$esection;?>';
var dateFrom = document.getElementById('trainingfailedrequestDateFrom').value;
var dateTo = document.getElementById('trainingfailedrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/training_status/failed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_training_failed',
                    role:role,
                    esection:esection,                   
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
          document.getElementById('failed_training_data').innerHTML = response;
                }
            });
   
} 	

const get_training_failed =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var training_type = data[2];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_training_failed').val(training_code);
     $('#training_type_failed').val(training_type);

   console.log(param);
    $.ajax({
        url:'../../process/requestor/training_status/failed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_training_failed_data',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code,
            training_type:training_type
        },success:function(response){
            console.log(response);
            document.getElementById('training_failed_data_list').innerHTML = response;
            

        }
    });

}
</script>