<script type="text/javascript">
  $(document).ready(function(){
       load_exam_passed();
    });

const load_exam_passed =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('exampassedrequestDateFrom').value;
    var dateTo = document.getElementById('exampassedrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/examination_result/passed.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_passed',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    esection:esection
                },success:function(response){
                    document.getElementById('passed_data_req').innerHTML = response;
               
                }
            });

}

const get_check_exam_passed_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_passed').val(training_code);

    $.ajax({
        url:'../../process/requestor/examination_result/passed.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_exam_passed',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_passed_list_req').innerHTML = response;
           

        }
    });
 
}

</script>