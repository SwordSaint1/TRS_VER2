<div class="modal" tabindex="-1" role="dialog" id="new_curiculum">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register Curiculum & Process</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
    <div class="col-4">
       <label>Curiculum:</label>
         <input list="curiculums" name="curiculum" id="newcuriculum" class="form-control">
         <datalist id="curiculums">
            <option></option>
           <?php 
                require '../../process/conn.php';
                $select = "SELECT DISTINCT curiculum FROM trs_category";
                $stmt = $conn->prepare($select);
                $stmt->execute();

                foreach($stmt->fetchALL() as $j){
                     echo '<option value="'.$j['curiculum'].'">';
                }
           ?>
         </datalist>
       </div>
       <div class="col-4">
       <label>Process:</label> <input type="text" name="neweprocess"  id="neweprocess" autocomplete="off" class="form-control">
       </div>
       <div class="col-4">
       <label>OJT Period:</label> <input type="text" name="newojt_period"  id="newojt_period" autocomplete="off" class="form-control">
       </div>
    </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  onclick="register_process()"
        class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">Register Curiculum & Process</button>
       
      </div>
    </div>
  </div>
</div>