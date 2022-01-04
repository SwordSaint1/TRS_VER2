

<div class="modal fade bd-example-modal-xl" id="ojt_view" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <h4>View OJT List</h4>
          
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
                    <span>Training Code:</span>     <input type="text" name="training_code_ojt" id="training_code_ojt" class="form-control-lg" readonly="">
                 </h3>

              </div>
              <br>
              <div class="row">
                <div class="col-12">
                  <p style="text-align:right;"><button class="btn btn-success" onclick="export_ojt('ojt_list')">Export</button></p>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="ojt_list">
                      <thead style="text-align:center;">
                    <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Training Type</th>
                    <th>Process</th>
                    <th>OJT Start Date</th>
                    <th>OJT End Date</th>

                </thead>
                <tbody id="data_ojt_list" style="text-align: center;"></tbody>
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

