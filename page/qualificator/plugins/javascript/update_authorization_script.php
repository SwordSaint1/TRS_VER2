<script type="text/javascript">
	 $(document).ready(function(){
    	load_val_list();
    });	
	 const load_val_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('valresultrequestDateFrom').value;
     var dateTo = document.getElementById('valresultrequestDateTo').value;

           $.ajax({
                url: '../../process/qualificator/update_auth/update_auth.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_validation',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    // console.log(response);
                    document.getElementById('val_data').innerHTML = response;
               
                }
            });

}
 
//function distribute data in table check eval modal
const get_check_val =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var examiner = data[2];
    var eval_status = data[3];
    var auth_date = data[4];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_for_val').val(training_code);
    $('#examiner_val').val(examiner);
    $('#eval_stat_val').val(eval_status);
    $('#authorize_date_val').val(auth_date);

    $.ajax({
        url:'../../process/qualificator/update_auth/update_auth.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_val',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code,
            auth_date:auth_date,
            examiner:examiner
        },success:function(response){
            document.getElementById('val_list_qualif').innerHTML = response;
           

        }
    });

}


//uncheck and check all function in check eval modal
const uncheck_all_for_val =()=>{
    var select_all = document.getElementById('check_all_for_val');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func_for_val =()=>{
    var select_all = document.getElementById('check_all_for_val');
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



//function confirm on check eval modal
const confirm_val =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
 var newtraining_code= document.getElementById('training_code_for_val').value;
 var authorize_date_val = $('#authorize_date_val').val();
 var newexaminer = $('#examiner_val').val();


    $.ajax({
        url: '../../process/qualificator/update_auth/update_auth.php',
        type: 'POST',
        cache: false, 
        data:{
            method: 'val',
            id:arr,
            newtraining_code:newtraining_code,
            authorize_date_val:authorize_date_val,
            newexaminer:newexaminer
            
        },success:function(a) {
               if (a == 'success') {
                   swal('SUCCESS','Success!','success');            
                 load_val_list();
                
          
        }

        }
    });
   }

}
</script>