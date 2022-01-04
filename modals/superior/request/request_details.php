

<div class="modal fade bd-example-modal-xl" id="request_details" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         <span>Request Code:</span> <input type="text" name="" id="batch_number_prev_superior" class="form-control-lg" readonly>
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

            <table>
              <thead>
                <tr>
                  <div class="col-sm-6">
                  <button class="btn btn-secondary" onclick="uncheck_all()">Uncheck</button> 
                  </div>
                </tr>
                <tr>
                  <div class="col-sm-6">
                  <button class="btn btn-danger" onclick="cancel_req()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Cancel</button> 
                  </div>
                </tr>
              </thead>
            </table>
          </div>
                </h3>
                 <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 110px;">
                    <button class="btn btn-primary" onclick="approve_req()"
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
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Position</th>
                     <th>Process</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Line</th>
                    <th>Training Reason</th>
                    <th>Request Date</th>

                      </thead>
                <tbody id="request_list_data" style="text-align: center;"></tbody>
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

