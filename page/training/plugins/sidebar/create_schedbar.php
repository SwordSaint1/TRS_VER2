  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/TRS.png" alt="TRS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=$esection;?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$full_name;?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="fas fa-chalkboard"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link  active">
              <i class="  fa fa-edit"></i>
              <p>
                Training Schedule
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="create_sched.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="set_time.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Time / Trainer</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="update.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Schedules</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="for_training.php" class="nav-link">
              <i class="far fa-list-alt"></i>
              <p>
                For Training
               
              </p>
            </a>
          </li>  
           <li class="nav-item">
            <a href="attendance.php" class="nav-link">
              <i class="fa fa-address-card"></i>
              <p>
                Attendance Report List
               
              </p>
            </a>
          </li>        
            <li class="nav-item">
            <a href="ojt_list.php" class="nav-link">
              <i class="far fa-list-alt"></i>
              <p>
                OJT List
               
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="request_list.php" class="nav-link">
              <i class="far fa-file-alt"></i>
              <p>
                Request List
               
              </p>
            </a>
          </li>    
          </li>  
         <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
