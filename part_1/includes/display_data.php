<?php
/*
 *  Purpose: a select form for users to reset the data in the database
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 12, 2019
**/
require_once("../../common/templates/header.php");

$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
if ($db_conn->connect_errno){
    die("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
}
?>

<?php
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


<form method="post" id="formSelectPath">
    <select name="selectedPath">

        <?php 
            for($x=0;$x<$arrlength;$x++)
            {
                echo '<option value="'.$paths[$x]->id.'">'.$paths[$x]->name.'</option>';
            }
        ?>

    </select>
    <input type="submit" name="submit" value="Get tables" />
</form>
<br>
<span>Table of the general path information</span>
<div id="output"></div><br>
<span>Starting point</span>
<div id="output2"></div><br>
<span>End Point</span>
<div id="output3"></div>


<script>
$(document).ready(function() {

    $("#formSelectPath").submit(function(event) {
        $.post("selectPath_ajax.php", $(this).serialize(),
            onPathSelected);
        event.preventDefault();
    });

    var onPathSelected = function(response) {
        var pd = response.pathData;
        // First table
        var table = "<table border=1><tr><th>ID</th><th>Path Name</th><th>Path length</th><th>Description</th><th>Note</th></tr>";
        
        table+="<tr><td>"+pd.id+"</td><td>"+pd.name + "</td><td>" + pd.length + "</td><td>" + pd.description + "</td><td>" + pd.note +"</td></tr>";
        table+="</table>";
        $("#output").html(table);

        // $("#output").html(response.midpoints[0].trnType +"<br>"+response.endpoints[0].atnHeight);

        //Second Table
        var sd = response.midpoints;
        var Stable = "<table border=1><tr><th>ID</th><th>Distance from start</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th></tr>";
        for (var i = 0; i < response.midpoints.length; i++) {
            Stable+="<tr><td>"+sd[i].midpointID+"</td><td>"+sd[i].distance + "</td><td>" + sd[i].groundHeight + "</td><td>" + sd[i].trnType 
            + "</td><td>" + sd[i].obstrHeight +"</td><td>"+sd[i].obstrType+"</td></tr>";
        }
        Stable+="</table>"; 
        $("#output2").html(Stable);       

        //Third Table
        var td = response.endpoints;
        var Ttable = "<table border=1><tr><th>ID</th><th>Distance from start</th><th>Ground Height</th><th>Atn Height</th></tr>";
        for (var j = 0; j < response.endpoints.length; j++) {
            
            Ttable+="<tr><td>"+td[j].endptID+"</td><td>"+td[j].distance+"</td><td>"+td[j].groundHeight+"</td><td>"+td[j].atnHeight+"</td></tr>";
        }
        Ttable+="</table>"; 
        $("#output3").html(Ttable);       
    };
});
</script>

<?php
require_once("../../common/templates/footer.php");
?>