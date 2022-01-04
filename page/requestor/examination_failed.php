<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/examination_failedbar.php'; ?>

  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Examinee Failed</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Examinee Failed</li>
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
                  <span for="">Date Submit From:</span> <input type="date" id="totalexamfailedrequestDateFrom" class="form-control" value="<?=$server_date_only;?>" autocomplete=off>
                  </div>
                </tr>
                <tr>
                  <div class="col-sm-6">
                  <span for="">Date Submit To:</span>  <input type="date" id="totalexamfailedrequestDateTo" class="form-control" value="<?=$server_date_only;?>" autocomplete=off>
                  </div>
                </tr>
              </thead>
            </table>
          </div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_exam_total_failed()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                 <thead style="text-align:center;">
                    <th> # </th>
                    <th> Training Code </th>
                    <th> Training Type </th>
                    <th>  Authorization Date</th>
                    <th>  Exam Status</th>
                
                </thead>
                <tbody id="total_failed_data_req" style="text-align:center;"></tbody>
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
<?php include 'plugins/javascript/examination_failed_script.php'; ?>