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
            <a href="dashboard.php" class="nav-link ">
              <i class="fas fa-chalkboard"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">
              <i class="  fa fa-edit"></i>
              <p>
                Training Request
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pending_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="approve_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cancelled_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dis-Approved Request</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item">
            <a href="for_evaluation.php" class="nav-link ">
              <i class="fas fa-tasks"></i>
              <p>
                For Validation
               
              </p>
            </a>
          </li>
         <li class="nav-item">
            <a href="update_authorization.php" class="nav-link active">
              <i class="fa fa-undo"></i>
              <p>
                Update Authorization Date
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="for_examination.php" class="nav-link">
              <i class="fas fa-chalkboard-teacher"></i>
              <p>
                For Examination
               
              </p>
            </a>
          </li>
          
          
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
               Examination Result
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="exam_passed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List of Passed</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="exam_failed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List of Failed</p>
                </a>
              </li>             
            </ul>
          </li>
          <li class="nav-item">
            <a href="curiculum.php" class="nav-link">
              <i class="far fa-copy"></i>
              <p>
               Curiculum & Process
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ojt_list.php" class="nav-link">
              <i class=" fas fa-list-ul"></i>
              <p>
                OJT List
            
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="history.php" class="nav-link">
              <i class="far fa-file-alt"></i>
              <p>
               History
               
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
               Account & Section 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="account.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account List</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="section.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section List</p>
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
