<script type="text/javascript">
	 $(document).ready(function(){
    	load_pending_qualificator();
    });	

	 //function pending tab data
function load_pending_qualificator(){
       var role = '<?=$role;?>';
       var dateFrom = document.getElementById('pending_qualifrequestDateFrom').value;
    var dateTo = document.getElementById('pending_qualifrequestDateTo').value;
    // var batch = document.getElementById('batch_search_pending_qualif').value;

         
       
        // console.log(role);
            $.ajax({
                url: '../../process/qualificator/pending.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_qualif',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                 

                },success:function(response){
                    // console.log(response);
                    document.getElementById('qualif_data').innerHTML = response;
               
                }
            });
        }

const get_req_qualif =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var batch_number = data[1];
    var approval_status = data[2];
    var request_date_time = data[3];
    var full_name = data[4];
    var position = data [5];
    var department = data [6];
    var section = data [7];
    var emline = data [8];
    var training_reason = data [9];
    var eprocess = data [10];


 
    $('#batch_number_prev_qualif').val(batch_number);


    $.ajax({
        url:'../../process/qualificator/pending.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'prevbatchApp_qualif',
            id:id,
            batch_number:batch_number,
            approval_status:approval_status,
            request_date_time:request_date_time,
            full_name:full_name
        },success:function(response){
            $('#view_request_details').html(response);
        }
    });

} 

// check all and uncheck
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

function export_req_pending(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'Pending_Training_Request'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// onchange process in request edit modal
const load_training =()=>{
        // VARIABLE X IS THE ID OF REASON SELECT TAG
        // var value = $('#categ').val();

         var value = document.querySelector('#qualiftraining_t').value;
        console.log(value);
        $.ajax({
            url: '../../process/qualificator/pending.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getTraining',
                value:value
            },success:function(data){
                // console.log(data);
                $('#qualiftraining_n').html(data);
            }
        });
    }


const update_remarks =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){


    var newbatch_number= document.getElementById('batch_number_prev_qualif').value;
    var qualif_remarks = $('#qualif_remarks').val();

 if(qualif_remarks == ''){
        swal('ALERT','Insert Remarks!','info'); 

   } else{

    $.ajax({
        url: '../../process/qualificator/pending.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_remarks_qualif',
            id:arr,
            newbatch_number:newbatch_number,
            qualif_remarks:qualif_remarks
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_pending_qualificator();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#qualif_remarks').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}

const cancel_pending =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    console.log(arr);
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){


    var newbatch_number= document.getElementById('batch_number_prev_qualif').value;
      var qualiftraining_n= document.getElementById('qualiftraining_n').value;
    var qualiftraining_t = $('#qualiftraining_t').val();
    var qualif_remarks = $('#qualif_remarks').val();

    if(qualif_remarks == ''){
        swal('ALERT','Insert Remarks!','info'); 

   } else{ 

    $.ajax({
        url: '../../process/qualificator/pending.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'cancel_qualif_pending',
            id:arr,
            newbatch_number:newbatch_number,
            qualif_remarks:qualif_remarks,
            qualiftraining_t:qualiftraining_t,
            qualiftraining_n:qualiftraining_n
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_pending_qualificator();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#qualif_remarks').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}



const approve_pending =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    console.log(arr);
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){


    var newbatch_number= document.getElementById('batch_number_prev_qualif').value;
      var qualiftraining_n= document.getElementById('qualiftraining_n').value;
    var qualiftraining_t = $('#qualiftraining_t').val();
    var qualif_remarks = $('#qualif_remarks').val();

    if (qualiftraining_t == '' && qualiftraining_n == '') {

        swal('ALERT','Select Training Type','info'); 
        uncheck_all();
   } 
    else{

    $.ajax({
        url: '../../process/qualificator/pending.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'approve_qualif_pending',
            id:arr,
            newbatch_number:newbatch_number,
            qualif_remarks:qualif_remarks,
            qualiftraining_t:qualiftraining_t,
            qualiftraining_n:qualiftraining_n
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_pending_qualificator();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#qualif_remarks').val('');
                $('#qualiftraining_t').val('');
                $('#qualiftraining_n').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            
            }
        }
    });
   }
}
}

</script>