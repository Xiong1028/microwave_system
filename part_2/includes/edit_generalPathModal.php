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
            <form method="post" id="editGenPoint">
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="genPathInfoid">Path ID</label>
                            <input type="text" class="form-control" id="genPathInfoid" readonly="true"
                                   name="genPathInfoid">
                        </div>

                        <div class="form-group">
                            <label for="genPathInfoName">Path Name</label>
                            <input type="text" class="form-control" id="genPathInfoName" readonly="true"
                                   name="genPathInfoName">
                        </div>
                        <div class="form-group">
                            <label for="genPathInfoLen">Path Length</label>
                            <input type="text" class="form-control" id="genPathInfoLen" name="genPathInfoLen">
                        </div>

                        <div class="form-group">
                            <label for="genPathInfoDesc">Description</label>
                            <input type="text" class="form-control" id="genPathInfoDesc" name="genPathInfoDesc">
                        </div>
                        <div class="form-group">
                            <label for="genPathInfoNote">Note</label>
                            <input type="text" class="form-control" id="genPathInfoNote" name="genPathInfoNote">
                        </div>
                        <div id="genModMsg" style="color: red"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //a function to pass the data to genModal
    function fillFormGeneralPath(pathData) {
        $('#genPathInfoid').val(pathData.id);
        $('#genPathInfoName').val(pathData.name);
        $('#genPathInfoLen').val(pathData.length);
        $('#genPathInfoDesc').val(pathData.description);
        $('#genPathInfoNote').val(pathData.note);

        //clear the msg when each time it goes to genModal
        $('#genModMsg').html('');
    }
</script>

