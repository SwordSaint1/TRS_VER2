

<div class="modal fade bd-example-modal-xl" id="ojt_view" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         <span>Training Code: </span>  <input type="text" name="" id="training_code_ojt_qualif" readonly="" style="text-align: center;" class="form-control-lg">
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
                          <button class="btn btn-secondary" onclick="uncheck_all_ojt()">Uncheck</button>

                      </th>
                       <th>
                         <span>OJT Start Date:</span>
                         <input type="date" name="ojt_start_date_ojt" class="form-control" id="ojt_start_date_ojt">
                      </th>
                       <th>
                         <span>OJT End Date:</span> 
                        <input type="date" name="ojt_end_date_ojt" class="form-control" id="ojt_end_date_ojt">
                      </th>
                       <th>
                     
                          <button class="btn btn-primary" onclick="confirm_qualif_ojt()" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Approve</button>
                      </th>
                    </tr>
                    
                  </thead>
                  
                </table>

      
              </div>
              <!-- /.card-body -->
            </div>
                </h3>
                <br>
              <div class="row">
                <div class="col-12">
                    <p style="text-align:right">
                    <button class="btn btn-success" onclick="export_ojt_qualif('ojt_ojt_list_qualif')">Export</button>
                    </p>
                </div>
                
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="req_pending_qualif">
                      <thead style="text-align:center;">
                    <th>
                      <input type="checkbox" name="" id="check_all_ojt" onclick="select_all_func_ojt()">
                    </th>
                    <th>#</th>
                    <th>Training Code</th>
                    <th>Employee No.</th>
                    <th>Full Name</th>
                    <th>Training Type</th>
                    <th>Process</th>
                    <th>OJT Start Date</th>
                    <th>OJT End Date</th>

                </thead>
                <tbody id="data_ojt_list_qualif" style="text-align: center;"></tbody>
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

