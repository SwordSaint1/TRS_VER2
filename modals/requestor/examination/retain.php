

<div class="modal fade bd-example-modal-xl" id="check_exam_retain_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         <span>Training Code:</span> <input type="text" name="" id="training_code_failed" class="form-control-lg" readonly>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> 
                    <div class="row">
                        <div class="col-6">
                          <button class="btn btn-secondary " onclick="uncheck_all()">Uncheck</button>  
                        </div>
                        <div class="col-6">
                           <select id="last_status" class="form-control">
                          <option value="">Select Option</option>
                          <?php
                            require '../../process/conn.php';
                            $status = "SELECT DISTINCT final_status FROM trs_final_stat";
                            $stmt = $conn->prepare($status);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){

                                echo '<option value="'.$x['final_status'].'">'.$x['final_status'].'</option>';
                            }
                     ?>
                        </select>
                        </div>
                  
                </div>
                </h3>
                 <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 110px;">
                    <button class="btn btn-primary" onclick="retain_req()"
                    class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve <i class="fas fa-check"></i></button> 
                  </div>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                      <thead style="text-align:center;">
                    <th>
                        <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                    </th>
                    <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Authorization Date</th>
                     <th>Exam Status</th>
                    <th>Examiner</th>

                      </thead>
                <tbody id="data_retain_list_req" style="text-align: center;"></tbody>
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

