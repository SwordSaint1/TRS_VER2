<script type="text/javascript">
	$(document).ready(function(){
	 	load_for_training_list();

    });	

const load_for_training_list =()=>{
    var role = '<?=$role;?>';
    var dateFrom = document.getElementById('fortrainingrequestDateFrom').value;
    var dateTo = document.getElementById('fortrainingrequestDateTo').value;
           $.ajax({
                url: '../../process/training/for_training/for_training.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_training_data_list',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                    
                },success:function(response){
                    console.log(response);
                    document.getElementById('training_sched_data_list').innerHTML = response;
               
                }
            });
     
}
// function for_training_modal
const get_training_type_filter =(param)=>{
     var esection = '<?=$esection;?>';
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var training_type = data[2];
    var process = data[3];
    $('#id_training_type').val(id);
    $('#training_type_code').val(training_code);
    $('#training_type_train').val(training_type);
    $('training_process_for').val(process);

    $.ajax({
        url:'../../process/training/for_training/for_training.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'training_filter_type',
            id:id,
            training_code:training_code,
            training_type:training_type,
            esection:esection,
            process:process
        },success:function(response){
            $('#training_type_filter').html(response);
            
        }
    });

}

const get_filter_process =(param)=>{
    var esection = '<?=$esection;?>';
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var training_type = data[2];
    var process = data[3];

    $('#id_training_process').val(id);
    $('#training_process_code').val(training_code);
    $('#training_process_train').val(training_type); 
    $('#training_process_for').val(process);
    $.ajax({
        url:'../../process/training/for_training/for_training.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'training_filter_process',
            id:id,
            training_code:training_code,
            training_type:training_type,
            esection:esection,
            process:process
        },success:function(response){
            console.log(response);
            $('#training_process_filter').html(response);
            var string = response.split('~!~');
            $('#training_code_training_for').val(string[1]);
            $('#training_type_for').val(string[2]);
            $('#training_process_for').val(string[3]);
            $('#ojt_period_for').val(string[4]);
            $('#start_time_for').val(string[5]);
            $('#end_time_for').val(string[6]);
            $('#location_for').val(string[7]);
            load_training_statuss();
        }
    });

}
 
// function check all / uncheck all for training tab
const uncheck_all =()=>{
    var select_all = document.getElementById('check_all');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all');
    if(select_all.checked == true){
        console.log('check');
        $('.singleCheck').each(function(){
            this.checked=true;
        });
    }else{
        console.log('uncheck');
        $('.singleCheck').each(function(){
            this.checked=false;
        });
    }
}

//function for_training_process ojt list  modal confirm function
const confirm =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
    var newtraining_code= document.getElementById('training_code_training_for').value;
    var newtraining_stat= document.getElementById('training_stat').value;
    var newattendance_stat= document.getElementById('attendance_stat').value;
    var newprocess =document.getElementById('training_process_for').value;
    var newremarks= document.getElementById('remarks').value;
    var ojt_period= document.getElementById('ojt_period_for').value;
    if(newattendance_stat == 'Did Not Attend' && newtraining_stat == 'Passed'){
        swal('ALERT','Invalid!','info');
         $('#attendance_stat').val('');
               $('#training_stat').val('');
    }
    else if(newattendance_stat == 'Did Not Attend' && newtraining_stat == 'Done'){
        swal('ALERT','Invalid!','info');
         $('#attendance_stat').val('');
               $('#training_stat').val('');
    }
   
else{
    $.ajax({
        url: '../../process/training/for_training/for_training.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'confirm_training',
            id:arr,
            newtraining_code:newtraining_code,
            newtraining_stat:newtraining_stat,
            newattendance_stat:newattendance_stat,
            newremarks:newremarks,
            ojt_period:ojt_period,
            newprocess:newprocess
        },success:function(a) {
            console.log(a);
               if (a = 'success') {
                 swal('SUCCESS','Success!','success');
               $('#attendance_stat').val('');
               $('#training_stat').val('');
                load_for_training_list();

        }

        }
    });
   }

}
}
const load_training_statuss =()=>{
       
         var valueee = $('#training_type_for').val();
   
       // console.log(valueee);
        $.ajax({
            url: '../../process/training/for_training/for_training.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'get_training_status',
                valueee:valueee
            },success:function(data){
                console.log(data);
             $('#training_stat').html(data);
            
            }
        });
    }
</script>