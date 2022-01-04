

<div class="modal fade bd-example-modal-xl" id="qualif_details" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <span>Request Code:</span>     <input type="text" name="batch_number_prev_qualif" id="batch_number_prev_qualif" class="form-control-lg" readonly="">
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
                      
                      <th style="text-align:center;">Training Type</th>
                      <th style="text-align:center;">Training Needs</th>
                      <th style="text-align:center;">Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>
                         <select id="qualiftraining_t" class="form-control training_type" onchange="load_training()">
                            <option value="">Select Training Type</option>
                        <?php
                            require '../../process/conn.php';
                            $get_curiculum = "SELECT DISTINCT training_type FROM trs_type";
                            $stmt = $conn->prepare($get_curiculum);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){
                                echo '<option value="'.$x['training_type'].'">'.$x['training_type'].'</option>';
                            }
                     ?>
                        </select>
                      </td>
                      <td>
                         <select id="qualiftraining_n" class="form-control eprocess"  >
                            <option value=""></option>
                         </select>
                      </td>
                      <td>
                         <input type="text" id="qualif_remarks" class="form-control" name="qualif_remarks" autocomplete="off" value="">
                      </td>
                    </tr>
                    
                  </tbody>
                </table>

                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <button class="btn btn-secondary" onclick="uncheck_all()">Uncheck</button>
                        <button class="btn btn-success " onclick="export_req_pending('req_pending_qualif')">Export</button>  
                         <button class="btn btn-warning " onclick="update_remarks()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Set Remarks</button>  
                         <button class="btn btn-danger" onclick="cancel_pending()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Cancel</button>
                      </th>
                      </th>
                      <th  style="width: 40px">
                        <button class="btn btn-primary" onclick="approve_pending()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve</button>
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
                    <th>Position</th>
                    <th>Process</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Line</th>
                    <th>Training Reason</th>
                    <th>Request Date</th>
                    <th>Remarks</th>


                </thead>
                <tbody id="view_request_details" style="text-align: center;"></tbody>
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

