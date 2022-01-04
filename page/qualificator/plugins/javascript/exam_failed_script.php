<script type="text/javascript">
	$(document).ready(function(){
    load_exam_failed_list();
	});
const load_exam_failed_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
    var dateFrom = document.getElementById('failedexamrequestDateFrom').value;
    var dateTo = document.getElementById('failedexamrequestDateTo').value;

           $.ajax({
                url: '../../process/qualificator/exam_result/failed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_failed',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    // console.log(response);
                    document.getElementById('failed_data').innerHTML = response;
               
                }
            });

}	

const get_check_exam_failed =(param)=>{
     var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var examiner = data[2];
    var auth_date = data[3];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#examiner_failed').val(examiner);
    $('#authdate_failed').val(auth_date);

    $.ajax({
        url:'../../process/qualificator/exam_result/failed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_exam_failed',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            console.log(response);
            document.getElementById('data_failed_list_qualif').innerHTML = response;
           

        }
    });

}

</script>