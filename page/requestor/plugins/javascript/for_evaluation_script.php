<script type="text/javascript">
$(document).ready(function(){
         load_ojt_list();  
	});

// OJT LIST TAB
const load_ojt_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('ojtrequestDateFrom').value;
     var dateTo = document.getElementById('ojtrequestDateTo').value;
           $.ajax({
                url: '../../process/requestor/ojt_list/submit_eval.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_ojt',
                    role:role,
                    esection:esection,                   
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                    document.getElementById('ojt_data').innerHTML = response;
               
                }
            });
   
} 	 

//function ojt list modal
const get_ojt_list =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';
    $('#training_code_ojt_eval').val(training_code);
    $.ajax({
        url:'../../process/requestor/ojt_list/submit_eval.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_ojt_exam_req',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_ojt_list_req').innerHTML = response;
            

        }
    });

}

// function ojt list modal done 
const ojt_done =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){
var newtraining_code= document.getElementById('training_code_ojt_eval').value;
var newojt_end =  document.getElementById('ojt_end_eval').value;
var server_date_only= '<?=$server_date_only;?>';

    $.ajax({
        url: '../../process/requestor/ojt_list/submit_eval.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'submit_eval',
            id:arr,
            newtraining_code:newtraining_code,
            newojt_end:newojt_end,
            server_date_only:server_date_only
            
        },success:function(a) {
            console.log(a);
               if (a == 'success') {
                      swal('SUCCESS','Success!','success');
             load_ojt_list();
         
        }

        }
    });
   }

}

const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_evaluation');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func_evaluation =()=>{
    var select_all = document.getElementById('check_all_evaluation');
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
  
function url(){
   window.location.assign("for_evaluation.php")
}

</script>