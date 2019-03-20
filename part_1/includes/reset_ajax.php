<?php
/*
 *  Purpose: handle the reset ajax request and give a succ/fail reponse after resetting data to original status in the databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:    Feb 9, 2019
**/
header("Content-Type: application/json");

require_once("../../common/utilities/utilities.php");
require_once('../../common/utilities/dbHandler.php');
require_once('../../common/utilities/ValidateCSV.class.php');

//get the data from reponse
$pathName = $_POST['pathSel'];

//$pathName = "Pah 01";
$pathFileName = str_replace('Pah ', 'path', trim($pathName));

//var_dump($pathFileName);

//if the file is uploaded, read csv file to reset the data in the database
$pathFileName = check_file_existed("./uploads", $pathFileName);

//var_dump($pathFileName);

$ext = getExt4($pathFileName);

//var_dump($ext);
//var_dump(!in_array($ext, ["csv", "CSV"]));

if (!$ext) {
	echo '{ "code": "404" ,"data":{"msg":"The ' . $pathName . ' file is not uploaded"}}';
} else {
	if (!in_array($ext, ["csv", "CSV"])) {
		echo '{ "code": "404" ,"data":{"msg":"The file must be csv type"}}';
	}
}


if ($pathFileName) {

	//read the data from csv files;
	$path_data_arr = read_CSV("./uploads/" . $pathFileName);

	//create a validation object to validate the data from csv file
	$validationObj = new ValidateCSV($path_data_arr);

	$db_conn = connect_db();

	//declare arrays to save data of csv file
	$path_general_data = array();
	$path_endPoints_data = array();
	$path_midPoints_data = array();


	//validate the data and get the data from the csv File
	if (!count($validationObj->get_errors_arr())) {
		$path_general_data = $validationObj->get_path_general();
		$path_endPoints_data = $validationObj->get_path_endPoints();
		$path_midPoints_data = $validationObj->get_path_midPoints();
	}

	//get the path_ID from table path_general
	$path_ID = db_select($db_conn, 'path_general', 'path_ID', 'path_name', $pathName)[0];

	//an Array to save the reset operations SQL query
	$qrys_Arr = array();


	//Add SQL queries of deleting data in path_endPoints and path_midPoints

	$del_pathEndPoints_qry = "DELETE FROM path_endPoints WHERE path_ID = " . $path_ID . ";";
	$del_pathMidPoints_qry = "DELETE FROM path_midPoints WHERE path_ID = " . $path_ID . ";";
	array_push($qrys_Arr, $del_pathEndPoints_qry, $del_pathMidPoints_qry);


	// Add SQL queries of updating data in path_general table

	//prevent SQL injection of path_general
	$path_general_data = db_prevent_SQLInjection($db_conn, $path_general_data);
	$update_pathGenenal_qry = "UPDATE path_general SET path_name = '" . $path_general_data[0][0] . "', path_length ='" . $path_general_data[0][1] . "', description = '" . $path_general_data[0][2] . "', note = '" . $path_general_data[0][3] . "' WHERE path_ID = '" . $path_ID . "';";
	array_push($qrys_Arr, $update_pathGenenal_qry);


	// Add SQL queries of re-inserting the end point

	//prevent SQL injection of path_endPoints
	$path_endPoints_data = db_prevent_SQLInjection($db_conn, $path_endPoints_data);
	foreach ($path_endPoints_data as $lineArr) {
		$insert_endPoints_qry = "INSERT INTO path_endPoints(path_ID,dist_from_start,grd_height,atn_height) VALUES ('" . $path_ID . "', '" . $lineArr[0] . "', '" . $lineArr[1] . "', '" . $lineArr[2] . "');";
		array_push($qrys_Arr, $insert_endPoints_qry);
	}


	// Add SQL queries of re-inserting the mid point

	//prevent SQL injection of path_midPoints
	$path_midPoints_data = db_prevent_SQLInjection($db_conn, $path_midPoints_data);
	foreach ($path_midPoints_data as $lineArr) {
		$insert_midPoints_qry = "INSERT INTO path_midPoints(path_ID,dist_from_start,grd_height,trn_type,obstr_height,obstr_type) VALUES('" . $path_ID . "', '" . $lineArr[0] . "', '" . $lineArr[1] . "', '" . $lineArr[2] . "', '" . $lineArr[3] . "', '" . $lineArr[4] . "');";
		array_push($qrys_Arr, $insert_midPoints_qry);
	}

	//Begin to reset the data
	if (db_trans_exec($db_conn, $qrys_Arr)) {
		echo '{ "code": "200" ,"data":{"msg":"Success to reset ' . $pathName . ' data"}}';
	} else {
		echo '{ "code": "400" ,"data":{"msg":"Fail to reset ' . $pathName . ' data"}}';
	}
	disconnect_db($db_conn);
}

?>