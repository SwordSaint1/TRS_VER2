

<div class="modal fade bd-example-modal-xl" id="training_filter_process" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         <h4>Process For Training</h4>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header ">
                <h3 class="card-title col-12"> 
                 
 <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      
                    <th style="text-align:center;"><span>Training Code:</span>
                          <input type="text" name="" id="training_code_training_for" readonly="" class="form-control">
                    </th>
                    <th style="text-align:center;"><span>Training Type:</span>
                          <input type="text" name="" id="training_type_for" readonly="" class="form-control">
                    </th>
                      <th style="text-align:center;">Process:
                        <input type="text" name="" id="training_process_for" readonly="" class="form-control">
                      </th>
                      <th style="text-align:center;"><span>OJT Period:</span>
                        <input type="text" name="" id="ojt_period_for" readonly="" class="form-control">
                      </th>
                    </tr>
                     <tr>
                      
                    <th style="text-align:center;">
                        <span><b>Start Time:</b></span>    
                        <input type="text" name="" id="start_time_for" readonly="" class="form-control"> 
                    </th>
                    <th style="text-align:center;">
                        <span><b>End Time:</b></span>    
                        <input type="text" name="" id="end_time_for" readonly="" class="form-control"> 
                    </th>
                      <th style="text-align:center;">
                        <span><b>Remarks:</b></span>    
                        <input type="text" name="" id="remarks" autocomplete="off" class="form-control"> 
                      </th>
                      <th style="text-align:center;">
                         <span><b>Location:</b></span>    
                        <input type="text" name="" id="location_for" autocomplete="off" class="form-control" readonly=""> 
                      </th>
                    </tr>

                    <tr>
                      <th style="text-align:center;">
                        <button class="btn btn-secondary" onclick="uncheck_all()">Uncheck</button>
                      </th>
                      <th style="text-align:center;">
                        <span><b>Attendance Status:</b></span>    
                        <select id="attendance_stat" class="form-control" >
                          <option value="">Select Option</option>
                          <?php
                        require '../../process/conn.php';
                        $get_attendance = "SELECT DISTINCT attendance_status FROM trs_training_categ";
                        $stmt = $conn->prepare($get_attendance);
                        $stmt->execute();
                        foreach($stmt->fetchALL() as $x){
                        echo '<option value="'.$x['attendance_status'].'">'.$x['attendance_status'].'</option>';
                              }
                      ?>    
                      </select>
                      </th>
                      <th style="text-align:center;">
                        <span><b>Training Status:</b></span>    
                        <select id="training_stat" class="form-control" >
                        <option value="">Select Option</option>
                         <?php
                      require '../../process/conn.php';
                      $get_stat = "SELECT DISTINCT training_status FROM trs_training_status ";
                      $stmt = $conn->prepare($get_stat);
                      $stmt->execute();
                      foreach($stmt->fetchALL() as $x){
                      echo '<option value="'.$x['training_status'].'">'.$x['training_status'].'</option>';
                       }
                       ?>
                    </select>
                      </th>
                      <th style="text-align:center;">
                        <button class="btn btn-primary" onclick="confirm()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve</button>
                      </th>
                    </tr>
                  </thead>              
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="req_pending_qualif">
                      <thead style="text-align:center;">
                    <th>
                      <input type="checkbox" name="" id="check_all" onclick="select_all_func()">
                    </th>
                    <th>#</th>
                   <th>Employee No.</th>
                   <th>Full Name</th>                   
                   <th>Start Date</th>                 
                   <th>End Date</th>
                </thead>
                <tbody id="training_process_filter" style="text-align: center;"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
          
      </div>
    </div>
  </div>
</div>

