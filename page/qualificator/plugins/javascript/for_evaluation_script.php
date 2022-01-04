<script type="text/javascript">
$(document).ready(function(){
         load_for_eval_list();  
	});

//function for eval tab data

const load_for_eval_list =()=>{
var role = '<?=$role;?>';
var esection = '<?=$esection;?>';
var dateFrom = document.getElementById('forvalqualifrequestDateFrom').value;
var dateTo = document.getElementById('forvalqualifrequestDateTo').value;
           $.ajax({
                url: '../../process/qualificator/for_validation/for_validation.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_evaluationn',
                    role:role,
                    esection:esection,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    document.getElementById('evall_data').innerHTML = response;
               
                }
            });

} 

//function distribute data in table check eval modal
const get_check_eval =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_for_eval').val(training_code);

   console.log(param);
    $.ajax({
        url:'../../process/qualificator/for_validation/for_validation.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_for_eval',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            console.log(response);
            document.getElementById('eval_list_qualif').innerHTML = response;
           
 
        }
    });

} 
	
//uncheck and check all function in check eval modal
const uncheck_all_for_eval =()=>{
    var select_all = document.getElementById('check_all_for_eval');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func_for_eval =()=>{
    var select_all = document.getElementById('check_all_for_eval');
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
const confirm_eval =()=>{
   var arr = [];

    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
    var newtraining_code= document.getElementById('training_code_for_eval').value;
    var newextend = document.getElementById('extension_days').value;
    var newremarks = document.getElementById('remarks_for_eval').value;
    var newevalstat = $('#eval_stat').val();
    var authorize_date = $('#authorize_date').val();
    var examiner = $('#examiner').val();


  if(newevalstat == 'For Authorization' && examiner == ''){
      swal('ALERT','Please Input Examiner!','info');
      $('#eval_stat').val('');
      $('#extension_days').val('');
      $('#remarks_for_eval').val('');
      $('#authorize_date').val('');
      $('#examiner').val('');
  }
 else if(newevalstat == 'OJT Extension' && newremarks == ''){
      swal('ALERT','Please Input Remarks!','info');
        $('#eval_stat').val('');
      $('#extension_days').val('');
      $('#remarks_for_eval').val('');
      $('#authorize_date').val('');
      $('#examiner').val('');
  }
else{
    $.ajax({
        url: '../../process/qualificator/for_validation/for_validation.php',
        type: 'POST',
        cache: false, 
        data:{
            method: 'eval',
            id:arr,
            newtraining_code:newtraining_code,
            newremarks:newremarks,
            newextend:newextend,
            newevalstat:newevalstat,
            authorize_date:authorize_date,
            examiner:examiner
            
        },success:function(a) {
            console.log(a);
               if (a = 'success') {
                  swal('SUCCESS','Success!','success');
                      $('#eval_stat').val('');
                      $('#extension_days').val('');
                      $('#remarks_for_eval').val('');
                      $('#authorize_date').val('');
                      $('#examiner').val('');
                  load_for_eval_list();
             
        }

        }
    });
   }

}
}
</script>