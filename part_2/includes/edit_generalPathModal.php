<?php require_once("../../common/templates/header.php"); ?>

<div id="myModal_GeneralPath" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
          <h5 class="modal-title">Editing General Path Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div><!--modal-header-->

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
            <label for="genPathInfoLength">path Length</label>
            <input type="text" class="form-control" id="genPathInfoLength" disabled>
        </div>

        <div class="form-group">
            <label for="genPathInfoDesc">Description</label>
            <input type="text" class="form-control" id="genPathInfoDesc" disabled>
        </div>

        <div class="form-group">
            <label for="genPathInfoNote">note</label>
            <input type="text" class="form-control" id="genPathInfoNote" disabled>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>

          </form>
        </div><!--container-->
      </div><!--modal-body-->

    </div><!--modal-content-->
  </div><!--"modal-dialog modal-lg-->
</div><!--modal fade bd-example-modal-lg-->

<script>
function fillFormGenPathInfo(GenPahtInfo){
  $('#genPathInfoid').val(GenPahtInfo.genPathInfoid);
  $('#genPathInfoName').val(GenPahtInfo.name);
  $('#genPathInfoLength').val(GenPahtInfo.length);
  $('#genPathInfoDesc').val(GenPahtInfo.description);
  $('#genPathInfoNote').val(GenPahtInfo.note);
}
</script>
