

<div class="modal fade bd-example-modal-xl" id="request" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <div id="batchID">
               
            </div>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-3">
                     <span> Employee No:   </span> <input type="text" id="employee_num" class="form-control-lg" onchange="detect_part_info()" autocomplete="OFF">
                </div>
                <div class="col-3">
                     <span> Batch No:   </span> <input type="text" id="batch_no" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Full Name:   </span> <input type="text" id="full_name" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Position:   </span> <input type="text" id="position" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
           </div>
           <div class="row">
                <div class="col-3">
                     <span> Department:   </span> <input type="text" id="department" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Section:   </span> <input type="text" id="section" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Line:   </span> <input type="text" id="emline" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Training Reason:   </span> <input type="text" id="training_reason" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
           </div>
           <div class="row">
                <div class="col-4">
                     <span> Curiculum:   </span> 

                       <select class="form-control eprocess" id="categ" onchange="load_curiculum()">
                          <option>Select Process</option>
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
                <div class="col-4">
               
                       <span>Process:</span>
                       <select class="form-control" id="eprocess"   onchange="load_eprocess()">
                          <option value=""></option>
                       </select>
                </div>
                <div class="col-4">
                       <span>OJT Period:</span>
                       <select class="form-control" id="ojt_period" disabled="">
                          <option value=""></option>
                       </select>
                </div>              
           </div>
           <br>
           <div class="row">
                        <div class="col-12">
                          <p style="text-align:right;">
                        <button type="button" class="btn btn-primary"  onclick="save_request()" id="planBtnCreate">Submit</button>

                         <!--  <button class="btn blue darken-3  col s12" onclick="save_request()" id="planBtnCreate">submit</button> -->
                          </p>
                        </div>
           </div>
      </div>
      <div class="modal-footer">

         <div class="card-body table-responsive p-0" style="height: 200px;">
       <table  class="table table-head-fixed text-nowrap table-hover" style="">
    <thead>
      
          <td>#</td>
          <td>Request Code</td>
        <td>Employee No.</td>
        <td>Full Name</td>
        <td>Position</td>
        <td>Process</td>
        <td>Training Reason</td>
        <td>Department</td>
        <td>Section</td>
        <td>Line</td>
        <td>OJT Period</td>
      
    </thead>
    <tbody id="data_preview_req"></tbody>
</table>
</div>
      </div>
    </div>
  </div>
</div>

