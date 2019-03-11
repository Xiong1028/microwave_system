<?php
/*
 *  Purpose: a select form for users to reset the data in the database
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 12, 2019
**/

$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
if ($db_conn->connect_errno){
    die("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
}

$selected_val = $_POST['selectedPath'];

$qry = "select path_ID,path_name,path_length,description,note from path_general where path_ID=".$selected_val." ;";
$rs = $db_conn->query($qry);
if ($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
    $pathData = new stdClass();
    $pathData-> id = $row['path_ID'];
    $pathData-> name = $row['path_name'];
    $pathData-> length = $row['path_length'];
    $pathData-> description = $row['description'];
    $pathData-> note = $row['note'];

}

$midPointsArr=array();

$qry = "select path_midpt_ID,dist_from_start ,grd_height,trn_type,obstr_height,obstr_type  from path_midPoints where path_ID=".$selected_val." ;";
$rs = $db_conn->query($qry);
if ($rs->num_rows > 0){
    while ($row = $rs->fetch_assoc()){
            $midPoint = new stdClass();
            $midPoint-> midpointID = $row['path_midpt_ID'];
            $midPoint-> distance = $row['dist_from_start'];
            $midPoint-> groundHeight = $row['grd_height'];
            $midPoint-> trnType = $row['trn_type'];
            $midPoint-> obstrHeight = $row['obstr_height'];
            $midPoint-> obstrType = $row['obstr_type'];
            array_push($midPointsArr, $midPoint);
    }
}

$endPointsArr=array();

$qry = "select path_endpt_ID, dist_from_start,grd_height, atn_height from path_endPoints where path_ID=".$selected_val." ;";
$rs = $db_conn->query($qry);
if ($rs->num_rows > 0){
    while ($row = $rs->fetch_assoc()){
            $endPoint = new stdClass();
            $endPoint-> endptID = $row['path_endpt_ID'];
            $endPoint-> distance = $row['dist_from_start'];
            $endPoint-> groundHeight = $row['grd_height'];
            $endPoint-> atnHeight = $row['atn_height'];
            array_push($endPointsArr, $endPoint);
    }
}

$data = new stdClass();
$data -> pathData = $pathData;
$data -> midpoints = $midPointsArr;
$data -> endpoints = $endPointsArr;

header('Content-type: application/json');
echo json_encode( $data );


?>