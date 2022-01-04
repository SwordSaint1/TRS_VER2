

<div class="modal fade bd-example-modal-xl" id="check_eval" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <h4>For Evaluation</h4>
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
                      <th>
                         <span>Training Code: </span>  <input type="text" name="" id="training_code_for_eval" readonly="" style="text-align: center;" class="form-control">
                      </th>
                       <th>
                         <span>Examiner:  </span>    <input type="text" name="" id="examiner" class="form-control" autocomplete="off">
                      </th>
                       <th>
                         <span>OJT Extension Days:  </span>    <input type="number" name="" id="extension_days" class="form-control" autocomplete="off">
                      </th>
                       <th>
                        <span>Remarks:  </span>    <input type="text" name="" id="remarks_for_eval" class="form-control" autocomplete="off">
                      </th>
                    </tr>
                    
                  </thead>

                   <thead style="text-align:center;">
                    <tr>
                      <th>
                          <button class="btn btn-secondary" onclick="uncheck_all()">Uncheck</button>
                      </th>
                       <th>
                         <span>Valdiation Status:  </span>
                         <select id="eval_stat" class="form-control eprocess">
                            <option value="">Select Option</option>
                          <?php
                            require '../../process/conn.php';
                            $get_curiculum = "SELECT DISTINCT eval_status FROM trs_eval";
                            $stmt = $conn->prepare($get_curiculum);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){

                                echo '<option value="'.$x['eval_status'].'">'.$x['eval_status'].'</option>';
                            }
                     ?>
                        </select>
                      </th>
                       <th>
                         <span>Authorization Date:  </span> 
                         <input type="datetime-local" name="authorize_date" id="authorize_date" class="form-control">
                      </th>
                       <th>
                         <button class="btn btn-primary" onclick="confirm_eval()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve</button>
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
                      <input type="checkbox" name="" id="check_all_for_eval" onclick="select_all_func_for_eval()">
                    </th>
                    <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Training Type</th>
                    <th>Process</th>
                    <th>OJT End Date</th>
                    <th>OJT Status</th>
                    <th>Requirements</th>
                    <th>Submitted Date</th>

                </thead>
                <tbody id="eval_list_qualif" style="text-align: center;"></tbody>
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

