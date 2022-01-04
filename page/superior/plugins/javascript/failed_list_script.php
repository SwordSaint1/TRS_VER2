<script type="text/javascript">
	 $(document).ready(function(){
    load_failed_superior();

    });	


const load_failed_superior =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('failedrequestDateFrom').value;
    var dateTo = document.getElementById('failedrequestDateTo').value;
           $.ajax({
                url: '../../process/superior/failed_list/failed_list.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_failed_sup',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    document.getElementById('failed_data_sup').innerHTML = response;
               
                }
            });

}
const get_check_exam_failed_sup =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_failed_sup').val(training_code);

   console.log(param);
    $.ajax({
        url:'../../process/superior/failed_list/failed_list.php',
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
            document.getElementById('data_failed_list_sup').innerHTML = response;
           

        }
    });
 
}

</script>