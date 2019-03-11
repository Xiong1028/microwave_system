<div id="myModal_MidPoint" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editing MidPoint Path</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container">

                    <form>
                        <div class="form-group">
                            <label for="midpointid">Midpoint id</label>
                            <input type="text" class="form-control" id="midpointid" readonly="true">
                        </div>

                        <div class="form-group">
                            <label for="middiststart">Distance from start</label>
                            <input type="text" class="form-control" id="middiststart" readonly="true">
                        </div>

                        <div class="form-group">
                            <label for="midgheight">Ground height</label>
                            <input type="text" class="form-control" id="midgheight">
                        </div>

                        <div class="form-group">
                            <label for="midtrntype">Terrain Type</label>
                            <input type="text" class="form-control" id="midtrntype">
                        </div>

                        <div class="form-group">
                            <label for="midobheight">Obstruction height</label>
                            <input type="text" class="form-control" id="midobheight">
                        </div>

                        <div class="form-group">
                            <label for="midobtype">Obstruction type</label>
                            <input type="text" class="form-control" id="midobtype">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>