

<div class="modal fade bd-example-modal-xl" id="check_exam_failed_sup" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h3 class="card-title"> <span>Training Code:</span>     <input type="text" name="training_code_failed_sup" id="training_code_failed_sup" class="form-control-lg" readonly=""></h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                      <thead style="text-align:center;">
                     <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Authorization Date</th>
                     <th>Exam Status</th>
                    <th>Examiner</th>
                    <th>Last Status</th>


                </thead>
                <tbody id="data_failed_list_sup" style="text-align: center;"></tbody>
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

