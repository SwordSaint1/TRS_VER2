

<div class="modal fade bd-example-modal-xl" id="confirm_sched" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <h4>Select Training Schedule</h4>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
           
                <div class="col-3">
                     <span> ID:   </span> <input type="text" id="id_sched_for_training" class="form-control-lg" readonly="">
                </div>
                <div class="col-3">
                     <span> Full Name:   </span> <input type="text" id="sched_full_name" class="form-control-lg"  autocomplete="OFF" readonly="">
                </div>
                <div class="col-3">
                     <span> Position:   </span> <input type="text" id="sched_position" class="form-control-lg" autocomplete="OFF" readonly="">
                </div>
                
                  <div class="col-3">
                     <span> Department:   </span> <input type="text" id="sched_department" class="form-control-lg"  autocomplete="OFF" readonly="">
                </div>
           </div>
           <div class="row">

             <div class="col-3">
                     <span> Training Type:   </span> <input type="text" id="sched_training_t" class="form-control-lg"  autocomplete="OFF" readonly="">
                </div>
                <div class="col-3">
                     <span> Training Needs:   </span> <input type="text" id="sched_training_n" class="form-control-lg" readonly="">
                </div>
                <div class="col-3">
                     <span> Training Reason:   </span> <input type="text" id="sched_training_r" class="form-control-lg"  autocomplete="OFF">
                </div>
                <div class="col-3">
                     <span> Process:   </span> <input type="text" id="sched_training_process" class="form-control-lg" autocomplete="OFF" readonly="">
                </div>
               
           </div>
           <div class="row">

             <div class="col-3">
                     <span> Section:   </span> <input type="text" id="sched_section" class="form-control-lg" readonly="">
                </div>
                <div class="col-3">
                     <span> Line:   </span> <input type="text" id="sched_line" class="form-control-lg" readonly="">
                </div>
                <div class="col-3">
                     <span> Slot:   </span> <select id="slot_for" class="form-control"  disabled="" >
                            <option></option>

                        </select>
                </div>
                <div class="col-3">
                    <span>Training Code:</span>
                       <select id="training_code_for_training" class="form-control"  disabled="" onchange="load_location()">
                    </select>
                    
                </div>
               
           </div>
           <div class="row">
              <div class="col-3">
                     <span>Shift:</span>
                       <select id="sched_training_shift" class="form-control"  onchange="load_shift()">
                        <option value="">Select Shift</option>
                        <?php
                        require '../../process/conn.php';
                        $get_curiculum = "SELECT DISTINCT shift FROM trs_training_sched ";
                        $stmt = $conn->prepare($get_curiculum);
                        $stmt->execute();
                        foreach($stmt->fetchALL() as $x){
                        echo '<option value="'.$x['shift'].'">'.$x['shift'].'</option>';
                         }
                        ?>            
                        </select>
                </div>
                 <div class="col-3">
                     <span>Start Date:</span>
                      <select id="sched_training_startdate_schedule" class="form-control" onchange="load_end_date()">
                        <option value="">Select Date</option>
                    
                        </select>
                </div>
                 <div class="col-3">
                     <span>Start Time:</span>
                    <select id="sched_training_start" class="form-control" onchange="load_slot(), load_end_time(),load_training_code(),load_trainer()">
                    </select>
                   
                </div>
                 <div class="col-3">
                     <span>Trainer:</span>
                       <select class="form-control" id="trainer_for" disabled="">
                          <option value=""></option>
                       </select>
                </div>
                
      </div>
      <div class="row">
              <div class="col-3">
                     <span>Location:</span>
                       <select class="form-control" id="sched_training_location" disabled="">
                       </select>
                </div>
                 <div class="col-3">
                     <span>End Date:</span>
                       <select id="sched_training_enddate_schedule" class="form-control"  disabled="">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-3">
                        <span>OJT Period:</span>
                       <input type="text" name="ojt_period_sched" id="ojt_period_sched" readonly="" class="form-control">
                </div>
    
                 <div class="col-3">
                     <span>End Time:</span>
                      <select id="sched_training_end" class="form-control"  disabled="">
                         <option value=""></option>
                    </select>
                </div>                
      </div>
      <br>
      <div class="row">
             <div class="col-12">
                          <p style="text-align:right;">
                       
                         <button type="button" class="btn btn-primary" onclick="confirm_sched(),url()"  class="close" data-dismiss="modal" aria-label="Close" class="close" data-dismiss="modal" aria-label="Close">
                                Submit
                            </button>
                          </p>
                        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

