<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/create_schedbar.php'; ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Training Schedule</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Training Schedule</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="#" class="btn btn-primary col-md-4 btn-lg" data-toggle="modal" data-target="#create" onclick="create_sched()"> <i class="fa fa-edit"></i> Create Training Schedule</a>

                  

                </div>
              </form>
            </div>
            <!-- /.card -->

<?php  include 'plugins/javascript/create_script.php';?>
<?php include 'plugins/footer.php'; ?>