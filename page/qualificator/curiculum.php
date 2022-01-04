<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/curiculumbar.php'; ?>

  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Curiculum & Process List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Curiculum & Process List</li>
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
                  <div class="col-9">
                     <select id="curiculum" class="form-control curiculum">
                            <option value="">Select Curiculum</option>
                          <?php
                            require '../../process/conn.php';
                            $get_curiculum = "SELECT DISTINCT curiculum FROM trs_category";
                            $stmt = $conn->prepare($get_curiculum);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){
                                echo '<option value="'.$x['curiculum'].'">'.$x['curiculum'].'</option>';
                            }
                     ?>
                        </select>
                  </div>
                </tr>
                <tr>
                  <div class="col-1">
                  <a href="#" class="btn btn-primary"
                  class="nav-link" data-toggle="modal" data-target="#new_curiculum">Add&nbsp;Curiculum&nbsp;&&nbsp;Section</a>
                  </div>
                </tr>
              </thead>
            </table>
          </div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_ojt_period()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
           
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                 <thead style="text-align:center;">
                    <th> # </th>
                    <th> Curiculum </th>
                    <th> Process</th>
                    <th> OJT Period </th>
                </thead>
                <tbody id="ojt_period_data" style="text-align:center;"></tbody>
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
<?php include 'plugins/javascript/curiculum_script.php'; ?>