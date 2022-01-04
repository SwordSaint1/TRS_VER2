<script type="text/javascript">
	

//function for exam result tab data

const load_history =()=>{
     $('#render_modal').load('../../forms/newhistory.php');
     var role = '<?=$role;?>';
     var dateFrom = document.getElementById('historyrequestDateFrom').value;
     var dateTo = document.getElementById('historyrequestDateTo').value;
	
		
           $.ajax({
                url: '../../process/qualificator/history/history.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_history_list',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    role:role
                    
                },success:function(response){
                    console.log(response);
                    document.getElementById('history_data_qualif').innerHTML = response;
               
                }
            });
   
}


function export_history(table_id, separator = ',') {
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
    var filename = 'History_Logs'+ '_' + new Date().toLocaleDateString() + '.csv';
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