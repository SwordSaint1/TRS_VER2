<script type="text/javascript">
	
	const load_sections =()=>{
     var role = '<?=$role;?>';
     var section_search = document.getElementById('section_search').value;
  
           $.ajax({
                url: '../../process/qualificator/account_section/section.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_section',
                    role:role,
                   
                    section_search:section_search
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('section_data').innerHTML = response;
               
                }
            });
   
}

function register_section(){
            var section = $('#section').val();
            if (section == '') {
                swal('INFORMATION','Please Input Section','info');
            }
            else{

              $.ajax({
            url: '../../process/qualificator/account_section/section.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'add_section',
                section: section
            },success:function(response){
                // console.log(response);
                if(response == 'success') {
                    swal('SUCCESS', 'Data Saved', 'success');
                        $('#section').val('');
                }else if(response == 'x'){
                    swal('FAILED', 'Existing Data', 'error');
                    $('#section').val('');
                }else{
                    swal('FAILED', 'Error', 'error');
                    $('#section').val('');
                }
            }
        });

}

    }


</script>