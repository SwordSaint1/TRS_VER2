<script type="text/javascript">
	$(document).ready(function(){		
	load_exam_passed_list();
	});
const load_exam_passed_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('examresultrequestDateFrom').value;
    var dateTo = document.getElementById('examresultrequestDateTo').value;
           $.ajax({
                url: '../../process/qualificator/exam_result/passed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_passed',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    console.log(response);
                    document.getElementById('passed_data').innerHTML = response;
               
                }
            });

} 

const get_check_exam_passed =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var examiner = data[2];
    var auth_date = data[3];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#examiner_passed').val(examiner);
    $('#authdate_passed').val(auth_date);



    $.ajax({
        url:'../../process/qualificator/exam_result/passed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_exam_passed',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            console.log(response);
            document.getElementById('data_passed_list').innerHTML = response;
           

        }
    });
 
}
</script>