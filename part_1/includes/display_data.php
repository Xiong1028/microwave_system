
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

<select>
<?php 
for($x=0;$x<$arrlength;$x++)
{
echo '<option value="'.$paths[$x]->id.'">'.$paths[$x]->name.'</option>';
}
?>
</select>

<?php
require_once("../../common/templates/footer.php");
?>
