<?php
/*
 *  Purpose:	Get the data from request and save the data into database after validating the data.
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   March 11, 2019
**/

header("Content-Type: application/json");


require_once("../../../common/utilities/dbHandler.php");
require_once("../../../common/utilities/utilities.php");


//general Modal data
$genDataArr = array();
/*
$genDataArr['genPathInfoid'] = check_post_data($_POST['genPathInfoid']);
$genDataArr['genPathInfoName'] = check_post_data($_POST['genPathInfoName']);
$genDataArr['genPathInfoLen'] = check_post_data($_POST['genPathInfoLen']);
$genDataArr['genPathInfoDesc'] = check_post_data($_POST['genPathInfoDesc']);
$genDataArr['genPathInfoNote'] = check_post_data($_POST['genPathInfoNote']);
*/

$genDataArr['genPathInfoid'] = 1;
$genDataArr['genPathInfoName'] = 'Pah 01';
$genDataArr['genPathInfoLen'] = 13.0;
$genDataArr['genPathInfoDesc'] = 'Demonstration path';
$genDataArr['genPathInfoNote'] = 'a note about path 1, the first demo path';



//midPoint Modal data
$midDataArr = array();
/*
$midDataArr['midpointid'] = check_post_data($_POST['midpointid']);
$midDataArr['middiststart'] = check_post_data($_POST['middiststart']);
$midDataArr['midgheight'] = check_post_data($_POST['midgheight']);
$midDataArr['midtrntype'] = check_post_data($_POST['midtrntype']);
$midDataArr['midobheight'] = check_post_data($_POST['midobheight']);
$midDataArr['midobtype'] = check_post_data($_POST['midobtype']);
*/

/*
$midDataArr['midpointid'] = 43;
$midDataArr['middiststart'] = 0.2000;
$midDataArr['midgheight'] = 45.0000;
$midDataArr['midtrntype'] = 'Grassland';
$midDataArr['midobheight'] = 1.000;
$midDataArr['midobtype'] = 'Bush';
*/

$db_conn = connect_db();

if (!is_null($genDataArr['genPathInfoid'])) {
	//validate the general data
	$err_gen_data = valid_edit_gen($genDataArr);

	if (count($err_gen_data)) {
		echo '{ "status": "fail" ,"data":' . json_encode($err_gen_data) . '}';
	} else {
		//prevent SQL injection of path_general
		$genDataArr = db_prevent_SQLInjection($db_conn, $genDataArr);

		$qry = "UPDATE path_general SET path_length =" . $genDataArr['genPathInfoLen'] . ", description = '" . $genDataArr['genPathInfoDesc'] . "', note='" . $genDataArr['genPathInfoNote'] . "' WHERE path_ID =" . $genDataArr['genPathInfoid'] . ";";

		//updateDataAndReponse($db_conn,$qry,$_SESSION['selectedPath']);
		updateDataAndReponse($db_conn,$qry,'Pah 01');
	}

}
/*
else if(!is_null($midDataArr['midpointid'])){
	//validate the midpoint data
	$err_mid_data = valid_edit_mid($midDataArr);

	if(count($err_mid_data)){
		echo '{ "status": "fail" ,"data":' . $err_mid_data . '}';
	}else{
		//prevent SQL injection of path_midpoint
		$midDataArr = db_prevent_SQLInjection($db_conn,$midDataArr);

		$qry = "UPDATE path_midPoints SET grd_height =" .$midDataArr['midgheight']. ", trn_type = " .$midDataArr['midtrntype']. ", obstr_height=" .$midDataArr['midobheight'].", obstr_type=".$midDataArr['midobtype']." WHERE path_ID =" .$midDataArr['midpointid'].";";

		updateDataAndReponse($db_conn,$qry,$_SESSION['selectedPath']);
	}
}
*/

disconnect_db($db_conn);

function updateDataAndReponse($db_conn,$qry,$selectedPath){
	$db_conn->query($qry);
	if ($db_conn->errno != 0) {
		echo '{"status":"fail","data":[' . $db_conn->error . " query " . $qry . ']}';
	} else {
		$allData = db_get_all_data($db_conn, $selectedPath);
		echo '{ "status": "fail" ,"data":'. json_encode($allData ). '}';
	}
}

?>