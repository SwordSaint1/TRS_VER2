<script type="text/javascript">
	$(document).ready(function(){

         load_attendance_report_list();

	});

	// function for_attendacne_report_list
const load_attendance_report_list =()=>{
     var role = '<?=$role;?>';
     var dateFrom = document.getElementById('attendancerequestDateFrom').value;
     var dateTo = document.getElementById('attendancerequestDateTo').value;

           $.ajax({
                url: '../../process/training/attendance/attendance.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_attendance_data_list',
                    role:role,
                    dateFrom:dateFrom,
                    dateTo:dateTo
                    
                },success:function(response){
               document.getElementById('attendance_data').innerHTML = response;
                }
            });
   
}
	
//function for attendance modal
const get_attendance_view =(param)=>{
	var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var training_type = data[2];

  $('#training_code_attendance').val(training_code);
   $('#attendance_training_type').val(training_type);

  $.ajax({
    url:'../../process/training/attendance/attendance.php',
    type:'POST',
    cache:false,
    data:{
        method: 'view_attendance',
        id:id,
        training_code:training_code,
        training_type:training_type

    },success:function(response){
        $('#data_attendance_view').html(response);
    }


  });

}

//function export attendance
function export_attendance(table_id, separator = ',') {
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
    var filename = 'Attendance_List'+ '_' + new Date().toLocaleDateString() + '.csv';
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