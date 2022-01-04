<script type="text/javascript">
  $(document).ready(function(){
       load_exam_total_failed();
    });

const load_exam_total_failed =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('totalexamfailedrequestDateFrom').value;
    var dateTo = document.getElementById('totalexamfailedrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/examination_result/failed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_total_failed',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    // console.log(response);
                    document.getElementById('total_failed_data_req').innerHTML = response;
               
                }
            });

}
 

const get_check_total_exam_failed_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var did_not_attend_exam = data[3];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_total_failed').val(training_code);

    $.ajax({
        url:'../../process/requestor/examination_result/failed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_total_exam_failed',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('total_data_failed_list_req').innerHTML = response;
           

        }
    });
}


</script>