<script type="text/javascript">
 
 $(document).ready(function(){
       load_for_exam_val();
    });

const load_for_exam_val =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';

     var dateFrom = document.getElementById('forexamrequestDateFrom').value;
     var dateTo = document.getElementById('forexamrequestDateTo').value;

           $.ajax({
                url: '../../process/requestor/evaluation_result/for_exam.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_exams',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('for_exam_data_req').innerHTML = response;
               
                }
            });
  
}
//get data in for exam modal

const get_check_exam_req =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_training_for_exam').val(training_code);

   console.log(param);
    $.ajax({
        url:'../../process/requestor/evaluation_result/for_exam.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_examss',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            console.log(response);
            document.getElementById('exam_list_qualif').innerHTML = response;
           

        }
    });

}

</script>