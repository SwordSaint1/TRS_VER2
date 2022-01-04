

<div class="modal fade bd-example-modal-xl" id="acc_edit" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          
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
                <h4>Register Account</h4>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover">
                    <thead style="text-align:center;">
                    <th>
                       <label>Username:</label> <input type="text" name="username_edit"  id="username_edit" autocomplete="off" class="form-control">
                         <input type="hidden" name="id_edit"  id="id_edit" autocomplete="off">
                    </th>
                    <th>
                      <label>Password:</label> <input type="password" name="password_edit" id="password_edit" autocomplete="off" class="form-control">
                    </th>
                    <th>
                      <label>Full Name:</label> <input type="text" name="full_name_edit" id="full_name_edit" autocomplete="off" class="form-control">
                    </th>
                    <th>
                      <label> Role:   </label>   <select name="role_edit" id="role_edit" class="form-control">
                        <option value="">Choose your option</option>
                        <option value="requestor">Requestor</option>
                        <option value="superior">Superior</option>
                        <option value="qualificator">Qualificator</option>
                        <option value="training">Training Group</option>
                       <!--  <option value="qa">QA</option> -->
                        </select>
                    </th>
                    <th>
                        <label>Section:</label>
                         <select id="esection_edit" class="form-control esection_edit">
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

                    </th>
                    </thead>
                    <br>
                    <tbody>
                      <tr>
                        <td colspan="5">
                          
                        </td>
                      </tr>
                       <tr>
                        <td colspan="5">
                          <p style="text-align:right;">
                            <button class="btn btn-primary" onclick="update_acc()" id="planRegister" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">Register User</button>
                          </p>
                        </td>
                      </tr>
                    </tbody>
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

