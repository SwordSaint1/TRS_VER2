
<script type="text/javascript">

// const close=()=> {
//  // header("Refresh:0; url=request.php");
// }

  const create_sched =()=> {
    setTimeout(generateTrCode,100);
       // generateTrCode();


}

//generate training code
const generateTrCode =()=>{
    $.ajax({
        url: '../../process/training/training_sched/create.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'generateTrCode'
        },success:function(response){

            $('#TrCode').html(response);
        }
    });
} 



// create tab save sched
function save_request(){
    var TrCode = document.querySelector('#TrCode').innerHTML;
    var training_type = document.querySelector('#training_type').value;
     var rtraining_type = document.querySelector('#rtraining_type').value;
    var slot = document.querySelector('#slot').value;
    var start_date = document.querySelector('#start_date').value;
    var end_date = document.querySelector('#end_date').value;
    var shift = document.querySelector('#shift').value;
    var process = document.querySelector('#process').value;
    var location =document.querySelector('#location').value;

    

     if(training_type == ''){
       
        swal('Notification','Please Select Training Type','info');
    }
    else if(slot == ''){
       
        swal('Notification','Please Enter Slot!','info');
    }
    else if(start_date == ''){
  
           swal('Notification','Please Select Start Date!','info');
    }
    else if(end_date == ''){
     
         swal('Notification','Please Select Select End Date!','info');
    }else if(process == ''){
   
         swal('Notification','Please Select Process!','info');
    }
    else if(process == '-'){
   
         swal('Notification','Invalid Process!','info');
    }
    else if(TrCode == ''){
        swal('Notification','Missing Training Number, Please reload your browser!','info');
    }else if(location == ''){
        swal('Notification','Please Set Location!','info');

    }else if(shift == ''){
        swal('Notification','Please Select Shift!','info');

    }else{
        $.ajax({
            url: '../../process/training/training_sched/create.php',
            type: 'POST',
            cache:false,
            data:{
                method:'insertSched',
                TrCode:TrCode,
                training_type:training_type,
                slot:slot,
                start_date:start_date,
                end_date:end_date,
                shift:shift,
                process:process,
                rtraining_type:rtraining_type,
                location:location
            },success:function(x){
                 // console.log(x);
           
           swal('Notification',x,'success');


           // M.toast({html:x});
           $('#training_type').val('');
              $('#rtraining_type').val('');
           $('#start_date').val('');
           $('#end_date').val('');
           $('#shift').val('');
            $('#process').val('');
             $('#categ').val('');
             $('#location').val('');
            
      
            load_prev();
            }

        });


    }



}

//preview sched
const load_prev =()=>{
     var training_code = $('#TrCode').html();

    console.log(TrCode);
    $.ajax({
        url:'../../process/training/training_sched/create.php',
        type:'POST',
        cache:false,
        data:{
            method:'prev_sched',
            training_code:training_code
        },success:function(response){
            $('#data_preview_train').html(response);
        }
    });
}

//onchange process

const load_curiculum =()=>{
        // VARIABLE X IS THE ID OF REASON SELECT TAG
        var value = $('#categ').val();
        console.log(value);
        $.ajax({
            url: '../../process/training/training_sched/create.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'getCuriculum',
                value:value
            },success:function(data){
                // console.log(data);
                $('#process').html(data);
            }
        });
    }






</script>

