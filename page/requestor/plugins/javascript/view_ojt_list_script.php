<script type="text/javascript">
$(document).ready(function(){
         load_ojtview_list();  
	});
	
const load_ojtview_list =()=>{
     var role = '<?=$role;?>';
     var esection = '<?=$esection;?>';
     var dateFrom = document.getElementById('ojtviewrequestDateFrom').value;
     var dateTo = document.getElementById('ojtviewrequestDateTo').value;
     
           $.ajax({
                url: '../../process/requestor/ojt_list/ojt_list.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_ojt_view',
                    role:role,
                    esection:esection,                   
                    dateFrom:dateFrom,
                    dateTo:dateTo
                },success:function(response){
                document.getElementById('view_ojt_data').innerHTML = response;
                }
            });   
} 	 

//function ojt list modal
const get_ojt_view_list =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var training_code = data[1];
    var esection = '<?=$esection;?>';
    var role = '<?=$role;?>';

    $('#training_code_ojt_view').val(training_code);

    $.ajax({
        url:'../../process/requestor/ojt_list/ojt_list.php',
        type: 'POST',
        cache:false,
        data:{
            method: 'fetch_ojt_view_data',
            id:id,
            esection:esection,
            role:role,
            training_code:training_code
        },success:function(response){
            document.getElementById('data_ojt_list_view_req').innerHTML = response;
            

        }
    });

}
</script>