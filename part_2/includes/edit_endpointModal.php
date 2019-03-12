
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
                    <form method="POST" id="FormUpdateEndPoint">

                        <div class="form-group">
                            <label for="endpointid">end point id</label>
                            <input type="text" class="form-control" id="endpointid" name="endpointid">
                        </div>

                        <div class="form-group">
                            <label for="distance">distance from start</label>
                            <input type="text" class="form-control" id="distance" disabled>
                        </div>

                        <div class="form-group">
                            <label for="gheight">Ground height</label>
                            <input type="text" class="form-control" id="gheight" name="gheight"/>
                        </div>

                        <div class="form-group">
                            <label for="aheight">Antenna height</label>
                            <input type="text" class="form-control" id="aheight"  name="aheight" />
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" name="cancel">Cancel</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- java script portion to fill the field sent via ajax-->
<script>
function fillFormEndPoint(endpoint){
  $('#endpointid').val(endpoint.endptID);
  $('#distance').val(endpoint.distance);
  $('#gheight').val(endpoint.groundHeight);
  $('#aheight').val(endpoint.atnHeight);
}



// Ajax communication back to the server
function prepareUpdateEndpointForm () {

    $("#FormUpdateEndPoint").submit(function (event) {
        console.log("ta passando aqui?");
        $.post("./ajax/endpointupdateAjax.php", $(this).serialize(),
            onEndPointUpdateSuccess
        )  .fail(function(response) {
        alert( JSON.stringify(response));
    });
        event.preventDefault();
    });
}

var onEndPointUpdateSuccess = function (response) {
    alert( response );
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