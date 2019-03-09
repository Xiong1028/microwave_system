<?php require_once("../../common/templates/header.php"); ?>

<div id="myModal_EndPoint" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editing End Point Path</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container">
                    <form>

                        <div class="form-group">
                            <label for="exampleInputPassword1">end point id</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">path id</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">distance from start</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" disabled>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">grd height</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">atn height</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">
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
</div>

<script>
function fillFormEndPoint(){


}
</script>

<!-- CREATE TABLE `path_endPoints`
(
`path_endpt_ID` int(11) not null auto_increment,
`path_ID` int(11) not null,
`dist_from_start` float(6,4) not null,
`grd_height` float(6,4) not null,
`atn_height` float(6,4) not null,
primary key(`path_endpt_ID`),
FOREIGN KEY(`path_ID`) REFERENCES path_general(`path_ID`)
); -->