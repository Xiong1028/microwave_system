<?php 
/*
 *  Purpose: send data to be edited
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   March 09, 2019
**/
require_once("../../common/templates/header.php");

//ITEM D - EDITING ENDPOINT
 include_once("edit_endpointModal.php");

 // EDITING MIDPOINT
 include_once("edit_midPointModal.php");

 //EDITING GENERAL PATH
 include_once("edit_generalPathModal.php");




$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
if ($db_conn->connect_errno){
    die("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
}

$paths=array();

$qry = "select path_ID, path_name from path_general;";
$rs = $db_conn->query($qry);
if ($rs->num_rows > 0){
    while ($row = $rs->fetch_assoc()){
            $obj = new stdClass();
            $obj-> id = $row['path_ID'];
            $obj-> name = $row['path_name'];
             array_push($paths, $obj);
    }
}
$arrlength=count($paths);
?>



<div class="container">
    <h2>Display Microwave Data</h2>
    
<form method="post" id="formSelectPath" style="margin-top: 30px;">
    <label for="selectdPath">Please select the path name:</label>
    <select name="selectedPath">
        <?php 
            for($x=0;$x<$arrlength;$x++)
            {
                echo '<option value="'.$paths[$x]->id.'">'.$paths[$x]->name.'</option>';
            }
        ?>

    </select>
    <div style="margin-bottom:50px;"><input type="submit" name="submit" value="Edit Path" class="btn btn-outline-secondary" /></div>
    
</form>
<div id="output"></div>

</div>


<script>
//global being initiated so it doesnt get undefined
var data = {};

$(document).ready(function() {

    $("#formSelectPath").submit(function(event) {
        $.post("../../part_1/includes/selectPath_ajax.php", $(this).serialize(),
            onPathSelected);
            console.log("ba");
        event.preventDefault();
    });

    var onPathSelected = function(response) {
        data = response;
        displaydata(data);
    }

    function displaydata(data){
        var pd = data.pathData;
        // First table
        var table = "<h4>Path_General</h4><table class='table table-striped table-hover'><tr><th>Path Name</th><th>Path length</th><th>Description</th><th>Note</th><th>Select Path</th></tr>";
        
       table+="<tr><td>"+pd.name + "</td><td>" + pd.length + "</td><td>" + pd.description + "</td><td>" + pd.note +"</td> <td><a><i class='fas fa-pencil-alt' onclick='openGeneralPath();'></i></a></td> </tr>";
        table+="</table><br><br>";

         //Second Table
        var td = data.endpoints;
        table += "<h4>Path_EndPoints</h4><table class='table table-striped table-hover'><tr><th>Distance from start</th><th>Ground Height</th><th>Atn Height</th><th>Select Path</th></tr>";
        for (var j = 0; j < td.length; j++) {
            
            table+="<tr><td>"+td[j].distance+"</td><td>"+td[j].groundHeight+"</td><td>"+td[j].atnHeight+"</td><td><a><i class='fas fa-pencil-alt' onclick='openEndPointPath();'></i></a></td></tr>";
        }
        table+="</table><br><br>"; 

        //Third Table
        var sd = data.midpoints;
        console.log(sd);
        table += "<h4>Path_MidPoints</h4><table class='table table-striped table-hover'><tr><th>Distance from start</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th><th>Select Path</th></tr>";
        for (var i = 0; i < sd.length; i++) {
            table+="<tr><td>"+sd[i].distance + "</td><td>" + sd[i].groundHeight + "</td><td>" + sd[i].trnType 
            + "</td><td>" + sd[i].obstrHeight +"</td><td>"+sd[i].obstrType+"</td><td><a><i class='fas fa-pencil-alt' onclick='openMidPointPath();'></i></a></td></tr>";
        }
        table+="</table>"; 
           

        $("#output").html(table);       
    };
});

// MODAL THAT OPENS THE EDITNNG OPT
function openGeneralPath(){
    $('#myModal_GeneralPath').modal('toggle');
   
}

function openMidPointPath(){
    $('#myModal_MidPoint').modal('toggle');
   
}


function openEndPointPath(){
    $('#myModal_EndPoint').modal('toggle');
   
}
</script>



<?php
require_once("../../common/templates/footer.php");
?>