<script type="text/javascript">
	$(document).ready(function(){
         load_training_passed();  
	});


const load_training_passed =()=>{
var role = '<?=$role;?>';
var esection = '<?=$esection;?>';
var dateFrom = document.getElementById('trainingpassedrequestDateFrom').value;
var dateTo = document.getElementById('trainingpassedrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/training_status/passed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_training_passed',
                    role:role,
                    esection:esection,                   
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
          document.getElementById('passed_training_data').innerHTML = response;
                }
            });
    
} 	
const get_training_passed =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var training_type = data[2];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';
    $('#training_code_training_passed').val(training_code);
    $('#training_type_passed').val(training_type);
    $.ajax({
        url:'../../process/requestor/training_status/passed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_training_passed_data',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code,
            training_type:training_type
        },success:function(response){
   document.getElementById('training_passed_data_list').innerHTML = response;
        }
    });

}


</script>