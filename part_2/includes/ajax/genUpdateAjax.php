<?php
/*
 *  Purpose:	Get the data from request and save the data into database after validating the data.
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   March 15, 2019
**/
header("Content-Type: application/json");

require_once("../../../common/utilities/dbHandler.php");
require_once("../../../common/utilities/utilities.php");

//general Modal data
$genDataArr = array();


$genDataArr['genPathInfoid'] = check_post_data($_POST['genPathInfoid']);
$genDataArr['genPathInfoName'] = check_post_data($_POST['genPathInfoName']);
$genDataArr['genPathInfoLen'] = check_post_data($_POST['genPathInfoLen']);
$genDataArr['genPathInfoDesc'] = check_post_data($_POST['genPathInfoDesc']);
$genDataArr['genPathInfoNote'] = check_post_data($_POST['genPathInfoNote']);


/*
$genDataArr['genPathInfoid'] = 1;
$genDataArr['genPathInfoName'] = 'Pah 01';
$genDataArr['genPathInfoLen'] = 17.0;
$genDataArr['genPathInfoDesc'] = 'Demonstartion path';
$genDataArr['genPathInfoNote'] = 'A Note about path 1, the first demo path';
*/

$db_conn = connect_db();

if (!is_null($genDataArr['genPathInfoid'])) {

	//validate the general data
	$err_gen_data = valid_edit_gen($genDataArr);

	if (count($err_gen_data)) {
		echo '{ "status": "failOnGen" ,"data":' . json_encode($err_gen_data) . '}';
	} else {
		//prevent SQL injection of path_general
		$genDataArr = db_prevent_SQLInjection($db_conn, $genDataArr);
	
		
		/*
		$qry = "UPDATE path_general SET path_length =" .$db_conn->real_escape_string((float)$genDataArr['genPathInfoLen'] ). ", description = '" . $db_conn->real_escape_string($genDataArr['genPathInfoDesc']) . "', note='" . $db_conn->real_escape_string($genDataArr['genPathInfoNote']) . "' WHERE path_ID =" . $db_conn->real_escape_string($genDataArr['genPathInfoid']) . ";";
		*/

		$qry = "UPDATE path_general SET path_length =" .$genDataArr['genPathInfoLen']. ", description = '" . $genDataArr['genPathInfoDesc']. "', note='" . $genDataArr['genPathInfoNote'] . "' WHERE path_ID =" . $genDataArr['genPathInfoid']. ";";

		// $db_conn->query($qry);

		// echo '{ "status": "success" ,"data":"Success to modify the data"}';

		updateDataAndReponse($db_conn, $qry);
	}
}

disconnect_db($db_conn);

?>