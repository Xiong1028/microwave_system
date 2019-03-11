<div id="myModal_GeneralPath" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" 
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header">
          <h5 class="modal-title">Editing General Path Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <div class="modal-body">
        <div class="container">
          <form>
            <div class="form-group">
              <label for="genPathInfoid">Path ID</label>
              <input type="text" class="form-control" id="genPathInfoid" disabled>
            </div>

            <div class="form-group">
              <label for="genPathInfoName">Path Name</label>
              <input type="text" class="form-control" id="genPathInfoName" disabled>
            </div>

            <div class="form-group">
                <label for="genPathInfoLength">Path Length</label>
                <input type="text" class="form-control" id="genPathInfoLen">
            </div>

            <div class="form-group">
                <label for="genPathInfoDesc">Description</label>
                <input type="text" class="form-control" id="genPathInfoDesc">
            </div>

            <div class="form-group">
                <label for="genPathInfoNote">Note</label>
                <input type="text" class="form-control" id="genPathInfoNote">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>

          </form>
        </div>       
      </div>

    </div>
  </div>
</div>

<script>
function fillFormGeneralPath(pathData){
  $('#genPathInfoid').val(pathData.id);
  $('#genPathInfoName').val(pathData.name);
  $('#genPathInfoLen').val(pathData.length);
  $('#genPathInfoDesc').val(pathData.description);
  $('#genPathInfoNote').val(pathData.note);
}
</script>

