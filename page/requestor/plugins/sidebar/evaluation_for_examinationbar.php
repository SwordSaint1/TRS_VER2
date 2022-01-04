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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="  fa fa-edit"></i>
              <p>
                Training Request
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request Training</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pending_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="approve_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve Request</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dis-Approved Request</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="pending_qualif_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Request (Qualif)</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="schedules.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Schedules
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="select_schedule.php" class="nav-link">
              <i class="nav-icon far fa-calendar-check"></i>
              <p>
                Select Schedule
               
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Training Status
                <i class="fas fa-angle-left right"></i>
            
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="training_passed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Passed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="training_failed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Failed</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                OJT List
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="for_evaluation.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Submit For Evaluation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_ojt_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View OJT List</p>
                </a>
              </li>             
            </ul>
          </li>
           <li class="nav-item">
            <a href="evaluation_request.php" class="nav-link">
              <i class="nav-icon far fa-calendar-check"></i>
              <p>
                Sched For Authorization
               
              </p>
            </a>
          </li>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Validation Result
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="evaluation_pending.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Validation Req</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="evaluation_for_examination.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>For Examination List</p>
                </a>
              </li>             
            </ul>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-address-card"></i>
              <p>
               Examination Result
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="examination_passed.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List of Passed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="examination_retain.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List for Retain</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="examination_failed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List of Failed</p>
                </a>
              </li>             
            </ul>
          </li>


         
        
         <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
