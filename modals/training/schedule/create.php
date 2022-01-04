

<div class="modal fade bd-example-modal-xl" id="create" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <div id="TrCode">
               
            </div>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-3">
                    <span> Training Type:   </span>   <select name="Training_type" id="training_type" class="form-control">
  <option value="">Choose your option</option>
  <option value="Special Batch Training">Special Batch Training</option>
  <option value="Cross And Refresh Training">Cross And Refresh Training</option>
  </select>
                </div>
                <div class="col-3">
                    <span> Refresh Training Type   </span>   <select name="rtraining_type" id="rtraining_type" class="form-control" >
  <option value="">Choose your option</option>
  <option value="Initial">Initial</option>
  <option value="Final">Final</option>

  </select>
                </div>
                <div class="col-3">
                     <span> Process   </span> 
 <select id="categ" class="form-control eprocess" onchange="load_curiculum()">
                            <option value="">Choose your option</option>
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
                <div class="col-3">
                      <span> Process   </span> 

 <select id="process" class="form-control eprocess">
    <option value=""></option>
 </select>
                </div>
           </div>
           <div class="row">
                <div class="col-3">
                      <span> Start Date </span> <input type="date" id="start_date"  class="form-control" autocomplete="OFF"> 
                </div>
                <div class="col-3">
                     <span> Start Time </span> <input type="time" id="start_time" readonly="" class="form-control" autocomplete="OFF"> 
                </div>
                <div class="col-3">
                     <span> End Date </span> <input type="date" id="end_date"  class="form-control" autocomplete="OFF"> 
                </div>
                <div class="col-3">
                      <span> End Time </span> <input type="time" id="end_time" readonly="" autocomplete="OFF" class="form-control"> 
                </div>
           </div>
           <div class="row">
                <div class="col-4">
                    <span> Slot </span> <input type="number" id="slot" class="form-control"  value="20" autocomplete="OFF"> 
                </div>
                <div class="col-4">
               
                         <span> Shift   </span>   <select name="shift" id="shift" class="form-control" >
                          <option value="">Choose your option</option>
                          <option value="DS">DS</option>
                          <option value="NS">NS</option>

                          </select>
                 </div>
                <div class="col-4">
                    
                    <span> Location:   </span> <input type="text" name="location" id="location" autocomplete="off" class="form-control">
                </div>              
           </div>
           <br>
           <div class="row">
                        <div class="col-12">
                          <p style="text-align:right;">
                        <button type="button" class="btn btn-primary"  onclick="save_request()" id="planBtnCreate">Submit</button>

                      
                          </p>
                        </div>
           </div>
      </div>
      <div class="modal-footer">

         <div class="card-body table-responsive p-0" style="height: 200px;">
       <table  class="table table-head-fixed text-nowrap table-hover" style="">
    <thead>
      
        <td>#</td>
        <td>Training Code</td>
        <td>Training Type</td>
        <td>Process</td>
        <td>Shift</td>
        <td>Slot</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Location</td>
      
    </thead>
    <tbody id="data_preview_train"></tbody>
</table>
</div>
      </div>
    </div>
  </div>
</div>






