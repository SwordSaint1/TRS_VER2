

<div class="modal fade bd-example-modal-xl" id="check_exam" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <h4>For Examination</h4>
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
                  <thead style="text-align:center;">
                    <tr>
                      <th >
                         <span>Training Code: </span>  <input type="text" name="" id="training_code_training_for_exam" readonly="" style="text-align: center;" class="form-control">
                         <input type="hidden" name=""     id="id_for_exam">
                         <input type="hidden" name=""     id="attempt_for_exam" placeholder="attempt">
                        
                         <input type="hidden" name=""     id="auth_date_for_exam">
                      </th>
                      <th colspan="2">
                        <span>Examiner:</span> <input type="text" name=""     id="examiner_for_exam" class="form-control" style="text-align: center;" readonly="">
                      </th>
                       <th colspan="">
                         <span>Remarks:  </span>    <input type="text" name="" id="remarks_for_exam" class="form-control" autocomplete="off" >
                      </th>
                       
                    </tr>
                    
                  </thead>

                   <thead style="text-align:center;">
                    <tr>
                      <th>
                          <button class="btn btn-secondary" onclick="uncheck_all_examination()">Uncheck</button>
                      </th>
                       <th>
                         <span>Attendance Status:  </span>
                         <select id="attendance_stats_exam" class="form-control" >
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
                       <th>
                         <span>Exam Status: </span> 
                         <select id="exam_stat" class="form-control" >
                        <option value="">Select Option</option>
                         <?php
                            require '../../process/conn.php';
                            $get_stat = "SELECT DISTINCT exam_status FROM trs_exam_status ";
                            $stmt = $conn->prepare($get_stat);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){
                                echo '<option value="'.$x['exam_status'].'">'.$x['exam_status'].'</option>';
                            }
                     ?>
                        

</select>
                      </th>
                       <th>
                         <button class="btn btn-primary" onclick="confirm_exam()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve</button>
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
                      <input type="checkbox" name="" id="check_all_examination" onclick="select_all_func_examination()">
                    </th>
                    <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Training Type</th>
                    <th>Process</th>
                    <th>OJT End Date</th>
                    <th>OJT Status</th>
                    <th>Authorization Date</th>

                </thead>
                <tbody id="exam_list_qualif" style="text-align: center;"></tbody>
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

