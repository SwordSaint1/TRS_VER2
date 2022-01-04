<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/historybar.php'; ?>

  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">History List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">History List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
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
                  <span for="">Requested Date From:</span> <input type="date" id="historyrequestDateFrom" class="form-control" value="<?=$server_date_only;?>" autocomplete=off>
                  </div>
                </tr>
                <tr>
                  <div class="col-sm-6">
                  <span for="">Requested Date To:</span>  <input type="date" id="historyrequestDateTo" class="form-control" value="<?=$server_date_only;?>" autocomplete=off>
                  </div>
                </tr>
              </thead>
            </table>
          </div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_history()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
              <table>
                <thead style="text-align:center;">
                  <tr>
                   
                    <th>
                      Qualificator Approval Status:
                    </th>
                     <th>
                      1 = Request 
                    </th>
                     <th>
                      2 = Pending 
                    </th>
                     <th>
                      3 = Approved 
                    </th>
                    <th>
                      4 = For Training
                    </th>
                    <th>
                      0 = Cancelled
                    </th>
                  </tr>
                </thead>
              </table>
              <br>
              <div class="row">
                  <div class="col-12">
                    <p style="text-align:right;">
                     <button class="btn btn-success" onclick="export_history('history_export')">Export</button>
                    </p>
                  </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px; zoom:90%;">
                <table class="table table-head-fixed text-nowrap table-hover" id="history_export">
                 <thead style="text-align:center;">
                <th> # </th>     
                <th> Employee No:</th>
                <th> Full Name</th>
                <th>Superior Approval/Cancelled Date</th>
                <th>Qualificator Approval Status </th>
                <th>Training Start Date </th>
                <th>Training End Date </th>
                <th>Trainer </th>
                <th>Training Status </th>
                <th>OJT Start Date </th>
                <th>OJT End Date </th>
                <th>Authorization Date </th>
                <th>Examiner </th>
                <th>Exam Status</th>
                <th>Final Status</th>
                
                </thead>
                <tbody id="history_data_qualif" style="text-align:center;"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>
</div>
</section>


<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/javascript/history_script.php'; ?>