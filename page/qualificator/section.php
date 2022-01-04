<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/sectionbar.php'; ?>

  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Section List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Section List</li>
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
                    <select id="section_search" class="form-control section_search">
                            <option value="">Select Section</option>
                          <?php
                            require '../../process/conn.php';
                            $get_curiculum = "SELECT DISTINCT section FROM trs_section";
                            $stmt = $conn->prepare($get_curiculum);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){
                                echo '<option value="'.$x['section'].'">'.$x['section'].'</option>';
                            }
                     ?>
                        </select>
                  </div>
                </tr>
                <tr>
                  <div class="col-1">
                  <a href="#" class="btn btn-primary"
                  class="nav-link" data-toggle="modal" data-target="#new_section">Add&nbsp;Section</a>
                  </div>
                </tr>
              </thead>
            </table>
          </div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_sections()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
         
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                 <thead style="text-align:center;">
                    <th> # </th>
                    <th> Section </th>
                    <th> Date Created </th>
                
                </thead>
                <tbody id="section_data" style="text-align:center;"></tbody>
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
<?php include 'plugins/javascript/section_script.php'; ?>