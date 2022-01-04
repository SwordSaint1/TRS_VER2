<script type="text/javascript">
	 $(document).ready(function(){
	 	load_update();

    });
   function load_update(){
        var role = '<?=$role;?>';
    var dateFrom = document.getElementById('update2requestDateFrom').value;
       var dateTo = document.getElementById('update2requestDateTo').value;

       $.ajax({
         url: '../../process/training/training_sched/update.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'update',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('update_data').innerHTML = response;
               
                } 

       });
    }

    const get_update =(param)=>{
    console.log(param);
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[4];
    var sched_stat = data[6];
   
   
  
    $.ajax({
        url:'../../process/training/training_sched/update.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatchApp_trainingedit_updated',
            id:id,
            training_code:training_code,
            sched_stat:sched_stat
        },success:function(response){
            console.log(response);
            var string = response.split('~!~');
            $('#id_edit_updated_train').val(string[0]);
            $('#training_code_edit_updated').val(string[1]);
            $('#sched_stat_edit_updated').val(string[2]);
            $('#training_typee_edit_updated').val(string[3]);
            $('#rtraining_type_edit_updated').val(string[4]);
            $('#tprocess_edit_updated').val(string[5]);
            $('#start_date_edit_updated').val(string[6]);
            $('#start_time_edit_updated').val(string[7]);
            $('#end_date_edit_updated').val(string[8]);
            $('#end_time_edit_updated').val(string[9]);
            $('#slot_edit_updated').val(string[10]);
            $('#shift_edit_updated').val(string[11]);
            $('#trainer_updated').val(string[12]);
            $('#location_updated').val(string[13]);
          

        }
    });

}

//update function in update_sched modal
const updated_sched =()=>{
    var id = document.getElementById('id_edit_updated_train').value;
    var shift = document.getElementById('shift_edit_updated').value;
    var training_type = $('#training_typee_edit_updated').val();
    var slot = $('#slot_edit_updated').val();
    var start_date = $('#start_date_edit_updated').val();   
    var end_date = $('#end_date_edit_updated').val();
    var training_code = $('#training_code_edit_updated').val();
    var start_time = $('#start_time_edit_updated').val();
    var end_time = $('#end_time_edit_updated').val();   
    var process = $('#tprocess_edit_updated').val();
    var rtraining_type = $('#rtraining_type_edit_updated').val();
    var trainer = $('#trainer_updated').val();
    var location = $('#location_updated').val();
    if (trainer == '') {
        swal('INFORMATION','Please Insert Trainer!','info');
    }
    else if (start_time == '') {
        swal('INFORMATION','Please Insert Start Time!','info');
    }
    else if (end_time == '') {
        swal('INFORMATION','Please Insert End Time!','info');
    }
    else{
        $.ajax({
        url: '../../process/training/training_sched/update.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'updated_training',
            id:id,
            shift:shift,
            training_type:training_type,
            slot:slot,
            start_date:start_date,
            end_date:end_date,
            training_code:training_code,
            start_time:start_time,
            end_time:end_time,
            process:process,
            rtraining_type:rtraining_type,
            trainer:trainer,
            location:location
        },success:function(i){
            console.log(i);
            if (i = 'y') {
                
                 swal('SUCCESS','Success!','success');
                	load_update();
            }
           

        }
    });
    }
}

</script>