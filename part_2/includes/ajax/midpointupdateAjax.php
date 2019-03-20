<?php
/*
 *  Purpose:	Get the data from request and save the data into database after validating the data.
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   March 15, 2019
**/


header("Content-Type: application/json");

require_once("../../../common/utilities/dbHandler.php");
require_once("../../../common/utilities/utilities.php");

//midPoint Modal data
$midDataArr = array();

$midDataArr['midpointid'] = check_post_data($_POST['midpointid']);
$midDataArr['pathid'] = check_post_data($_POST['pathid']);
$midDataArr['middiststart'] = check_post_data($_POST['middiststart']);
$midDataArr['midgheight'] = check_post_data($_POST['midgheight']);
$midDataArr['midtrntype'] = check_post_data($_POST['midtrntype']);
$midDataArr['midobheight'] = check_post_data($_POST['midobheight']);
$midDataArr['midobtype'] = check_post_data($_POST['midobtype']);

$db_conn = connect_db();


if (!is_null($midDataArr['midpointid'])) {
	//validate the midpoint data
	$err_mid_data = valid_edit_mid($midDataArr);

	if (count($err_mid_data)) {
		echo '{ "status": "failOnMid" ,"data":' . json_encode($err_mid_data) . '}';
	} else {
		//prevent SQL injection of path_midpoint
		$midDataArr = db_prevent_SQLInjection($db_conn, $midDataArr);

		/*
		$qry = "UPDATE path_midPoints SET grd_height =" . $db_conn->real_escape_string((float)$midDataArr['midgheight']) . ", trn_type = '" . $db_conn->real_escape_string($midDataArr['midtrntype']). "', obstr_height=" . $db_conn->real_escape_string((float)$midDataArr['midobheight']) . ", obstr_type='" . $db_conn->real_escape_string($midDataArr['midobtype']) . "' WHERE path_midpt_ID=" .$db_conn->real_escape_string($midDataArr['midpointid']). ";";
		*/

		$qry = "UPDATE path_midPoints SET grd_height = " . (float)$midDataArr['midgheight'] . ", trn_type = '" . $midDataArr['midtrntype']. "', obstr_height=" . (float)$midDataArr['midobheight']. ", obstr_type='" . $midDataArr['midobtype'] . "' WHERE path_midpt_ID=" .$midDataArr['midpointid']. ";";
		

		//$db_conn->query($qry);

		// echo '{ "status": "success" ,"data":"Success to modify the data"}';

		//updateDataAndReponse($db_conn, $qry, (int)$midDataArr['pathid']);
		updateDataAndReponse($db_conn, $qry);
	}
}

?>