<script type="text/javascript">
	$(document).ready(function(){		
         load_ojt_list();   
	});

// function ojt list

const load_ojt_list =()=>{
    var role = '<?=$role;?>';
    var dateFrom = document.getElementById('ojtrequestDateFrom').value;
    var dateTo = document.getElementById('ojtrequestDateTo').value;
           $.ajax({
                url: '../../process/training/ojt_list/ojt_list.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_for_ojt',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    role:role                   
                },success:function(response){
                    document.getElementById('ojt_list').innerHTML = response;
                }
            }); 
}


const get_ojt_view =(param)=>{
	var data = param.split('~!~');
	var id = data[0];
	var training_code = data[1];
	var training_type = data[2];
	var ojt_end = data[3];
			  $('#training_code_ojt').val(training_code);
			  $('#ojt_training_type').val(training_type);

			  $.ajax({
			    url:'../../process/training/ojt_list/ojt_list.php',
			    type:'POST',
			    cache:false,
			    data:{
			        method: 'view_ojt',
			        id:id,
			        training_code:training_code,
			        training_type:training_type

			    },success:function(response){
			        $('#data_ojt_list').html(response);
			    }
			  });
}
 function export_ojt(table_id, separator = ',') {
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
</script>