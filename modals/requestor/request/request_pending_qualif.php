

<div class="modal fade bd-example-modal-xl" id="pendingq_req" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
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
                <h3 class="card-title"> <span>Request Code:</span>     <input type="text" name="batch_number_pending" id="batch_number_pending" class="form-control-lg" readonly=""></h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                      <thead style="text-align:center;">
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
                <tbody id="data_pendingq_request" style="text-align: center;"></tbody>
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

