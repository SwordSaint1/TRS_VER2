<div class="modal" tabindex="-1" role="dialog" id="ojt_period_edit">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update OJT Period</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
    <div class="col-4">
       <label>Curiculum:</label> <input type="text" name="curiculum_ojt_period"  id="curiculum_ojt_period" autocomplete="off" class="form-control" readonly="">
       <input type="hidden" name="id_ojt_period"  id="id_ojt_period" autocomplete="off">
       </div>
       <div class="col-4">
       <label>Process:</label> <input type="text" name="eprocess_ojt_period"  id="eprocess_ojt_period" autocomplete="off" class="form-control" readonly="">
       </div>
       <div class="col-4">
       <label>OJT Period:</label> <input type="text" name="ojt_period_ojt_period"  id="ojt_period_ojt_period" autocomplete="off" class="form-control">
       </div>
    </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  onclick="update_ojt_period()"
        class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">Update</button>
       
      </div>
    </div>
  </div>
</div>