<script type="text/javascript">
		$(document).ready(function(){
    	load_ojt_list_qualif();
    });	
// function ojt list

const load_ojt_list_qualif =()=>{
     var role = '<?=$role;?>';
     var process = document.getElementById('process_ojt').value;

           $.ajax({
                url: '../../process/qualificator/ojt_list/ojt_list.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_ojt',
                    role:role,
                    process:process
                    
                },success:function(response){
                    document.getElementById('ojt_list_qualif').innerHTML = response;
               
                }
            });
   
}

//function ojt list modal
const get_ojt_view =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_ojt_qualif').val(training_code);

   console.log(param);
    $.ajax({
        url:'../../process/qualificator/ojt_list/ojt_list.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_ojt_qualif',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_ojt_list_qualif').innerHTML = response;
            

        }
    });

}

  function export_ojt_qualif(table_id, separator = ',') {
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
    var filename = 'OJT_List'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


// check all and uncheck
const uncheck_all_ojt =()=>{
    var select_all = document.getElementById('check_all_ojt');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func_ojt =()=>{
    var select_all = document.getElementById('check_all_ojt');
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


// cancel function
const confirm_qualif_ojt =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    console.log(arr);
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

	var newtraining_code= document.getElementById('training_code_ojt_qualif').value;
    var ojt_start = document.getElementById('ojt_start_date_ojt').value;
    var ojt_end = document.getElementById('ojt_end_date_ojt').value;

    $.ajax({
        url: '../../process/qualificator/ojt_list/ojt_list.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_ojt_qualif',
            id:arr,
            newtraining_code:newtraining_code,
            ojt_start:ojt_start,
            ojt_end:ojt_end
            
        },success:function(a) {
            if (a = 'success') {
                      swal('SUCCESS','Success!','success');
                      $('#ojt_start_date_ojt').val('');
                       $('#ojt_end_date_ojt').val('');
                       uncheck_all_ojt();
             
        }
        }
    });
   }
}



</script>