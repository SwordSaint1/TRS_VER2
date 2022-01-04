<script type="text/javascript">

const load_accounts =()=>{
     var role = '<?=$role;?>';
     // var dateFrom = document.getElementById('accDateCreatedFrom').value;
     // var dateTo = document.getElementById('accDateCreatedTo').value;
     var roles = document.getElementById('role_search').value;
  
           $.ajax({
                url: '../../process/qualificator/account_section/account.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_acc_list',
                    role:role,
                   
                    roles:roles
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('accounts_data').innerHTML = response;
               
                }
            });
   
}
	
      function register(){
            var username = $('#username').val();
            var password = $('#password').val();
            var full_name = $('#full_name').val();
            var role = $('#role').val();
            var esection = $('#esection').val();
            if (username == '') {
                    swal('INFORMATION','Please Input Username','info');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
            }
            else if(password == ''){
                    swal('INFORMATION','Please Input Password','info');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
            }
            else if(full_name == ''){
                    swal('INFORMATION','Please Input Full Name','info');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
            }
            else if(role == ''){
                    swal('INFORMATION','Please Select Role','info');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
            }
            else if(esection == ''){
                    swal('INFORMATION','Please Select Section','info');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
            }
            else{
              $.ajax({
            
            url: '../../process/qualificator/account_section/account.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'register',
                username: username,
                password: password,
                full_name: full_name,
                role: role,
                esection: esection
            },success:function(response){
                // console.log(response);
                if(response == 'success') {
                    swal('SUCCESS', 'Data Saved', 'success');
                     $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
                    load_accounts();
                   
                }else if(response == 'x'){
                    swal('FAILED', 'Existing Data', 'error');
                    $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
                }else{
                    swal('FAILED', 'Error', 'error');
                    $('#username').val('');
                    $('#password').val('');
                    $('#full_name').val('');
                    $('#role').val('');
                    $('#esection').val('');
                }
            }
        });

}

    }

    const get_edit_acc =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var username = data[1];
    var password = data[2];
    var full_name = data[3];
    var role = data[4];
    var esection = data[5];

      document.getElementById('id_edit').value = id;
            document.getElementById('username_edit').value = username;
            document.getElementById('password_edit').value = password;
             document.getElementById('full_name_edit').value = full_name;
             document.getElementById('role_edit').value = role;
             document.getElementById('esection_edit').value = esection;



}

    const update_acc =()=>{
            var id = $('#id_edit').val();
            var username = $('#username_edit').val();
            var password = $('#password_edit').val();
            var full_name = $('#full_name_edit').val();
            var role = $('#role_edit').val();
            var esection = $('#esection_edit').val();

 
        $.ajax({
        url: '../../process/qualificator/account_section/account.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_accounts',
                id:id,
              username: username,
                password: password,
                full_name: full_name,
                role: role,
                esection: esection
           
        },success:function(i){
            console.log(i);

            if (i == 'y') {
             
                 swal('SUCCESS','Success','success');
                load_accounts();
            }
           

        }
    });
    }
</script>