<?php
/*
 *  Purpose: launch a ajax request with selected path_name and earth curvature value
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   March 19, 2019
**/
require_once("../../common/templates/header.php");

$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
if ($db_conn->connect_errno) {
	die("Could not connect to database server \n Error: " . $db_conn->connect_errno . "\n Report: " . $db_conn->connect_error . "\n");
}

$paths = array();

$qry = "select path_ID, path_name from path_general;";
$rs = $db_conn->query($qry);
if ($rs->num_rows > 0) {
	while ($row = $rs->fetch_assoc()) {
		$obj = new stdClass();
		$obj->id = $row['path_ID'];
		$obj->name = $row['path_name'];
		array_push($paths, $obj);
	}
}
$arrlength = count($paths);
?>

<div class="container">
        <h2>Path Loss Statics</h2>

        <form method="post" id="formSelPathAndCurv" style="margin-top: 30px;">
            
            <p><i>Get more information about path loss...</i></p>
            <p><i>Please Select the path name and earth curvature</i></p>
            <!-- a select for path -->
            <label for="selectdPath">Path name:</label>
            <select name="selectedPath">
							<?php
							for ($x = 0; $x < $arrlength; $x++) {
								echo '<option value="' . $paths[$x]->id . '">' . $paths[$x]->name . '</option>';
							}
							?>
            </select>

            <!-- a select for earth curvature-->
            <label for="selectedCurv">Earcth Curvature:</label>
             <select name="selectedCurv" id="selectedCurv">
                            <option value="4/3">4/3</option>
                            <option value="1">1</option>
                            <option value="2/3">2/3</option>
                            <option value="infinity"><span style="font-size:150%">∞</span></option>
             </select>               
            
            <div style="margin-bottom:50px;">
                <input type="submit" name="submit" value="Submit"
                       class="btn btn-outline-secondary"/>
            </div>
            <!-- respond msg here -->
            <div id="msg" style="margin-bottom: 20px;color: blue;font-size: 150%"></div>
        </form>
        

        <!-- output the tables and graphic -->
        <div id="output"></div>

    </div>

<?php
require_once("../../common/templates/footer.php");
?>