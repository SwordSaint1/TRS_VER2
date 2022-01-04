<script type="text/javascript">
	$(document).ready(function(){
		load_ojt_period();
		
	});
 function load_ojt_period(){
       var role = '<?=$role;?>';
      
    var curiculum = document.getElementById('curiculum').value;

            $.ajax({
                url: '../../process/qualificator/curiculum_process/curiculum_process.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_ojt_period',
                    role:role,
                    curiculum:curiculum
                 

                },success:function(response){
                    document.getElementById('ojt_period_data').innerHTML = response;
               
                }
            });
        }

   const get_edit_ojt_period =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var eprocess = data[1];
    var training_type = data[2];
    var ojt_period = data[3];
    var curiculum = data[4];

      		document.getElementById('id_ojt_period').value = id;
            document.getElementById('curiculum_ojt_period').value = curiculum;
            document.getElementById('eprocess_ojt_period').value = eprocess;
             document.getElementById('ojt_period_ojt_period').value = ojt_period;

}
const update_ojt_period =()=>{
            var id = $('#id_ojt_period').val();
            var curiculum = $('#curiculum_ojt_period').val();
            var eprocess = $('#eprocess_ojt_period').val();
            var training_type = $('#training_type_ojt_period').val();
            var ojt_period = $('#ojt_period_ojt_period').val();
         
 
        $.ajax({
        url: '../../process/qualificator/curiculum_process/curiculum_process.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_ojt_period',
                id:id,
                curiculum:curiculum,
                eprocess:eprocess,
                ojt_period:ojt_period
           
        },success:function(i){

            if (i = 'y') {
                 swal('SUCCESS','success','success');
                load_ojt_period();
            }
           

        }
    });
    }

    
     const register_process=()=>{
           

            var newcuriculum = document.getElementById('newcuriculum').value;
            var neweprocess = document.getElementById('neweprocess').value;
            var newojt_period = document.getElementById('newojt_period').value;

              $.ajax({
            url: '../../process/qualificator/curiculum_process/curiculum_process.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'add_process',
                newcuriculum: newcuriculum,
                neweprocess: neweprocess,
                newojt_period: newojt_period
            },success:function(response){
                     if(response == 'success') {
                    swal('SUCCESS', 'Data Saved', 'success');
                     load_ojt_period();
                }else if(response == 'x'){
                    swal('FAILED', 'Existing Data', 'error');
                }else{
                    swal('FAILED', 'Error', 'error');
                }
               
            }
        });



    }

</script>