<?php
/**
 *  Purpose: multiple functions for handling databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Data:    Feb 10, 2019
 *
 */

function connect_db()
{
	$db_conn = new mysqli("localhost", "lamp2user", "Test123!", "microwave_path_data");
	if ($db_conn->connect_errno) {
		printf("Could not connect to database server\n Error: "
			. $db_conn->connect_errno . "\n Report: "
			. $db_conn->connect_error . "\n");
		die;
	}
	return $db_conn;
}

//discnnect database
function disconnect_db($db_conn)
{
	$db_conn->close();
}

//db_insert()
function db_insert($db_conn, $qry)
{

	$db_conn->query($qry);

	return mysqli_affected_rows($db_conn) ? mysqli_insert_id($db_conn) : false;
}

//db_trans_exec()
function db_trans_exec($db_conn, $qryArr)
{

	$db_conn->autocommit(false);

	$results = [];

	foreach ($qryArr as $qry) {
		$results[] = $db_conn->query($qry) ? 0 : 1;
	}

	if (!array_sum($results)) {
		$db_conn->commit();
		return true;
	} else {
		$db_conn->rollback();
		echo '{ "code": "1251" ,"data":{"msg":"Fail to execute SQL "}}';
		return false;
	}
}

//db_select(column)
function db_select($db_conn, $tableName, $objColName, $conColName, $condition)
{

	$sel_qry = "select " . $objColName . " from " . $tableName . " where " . $conColName . "= '" . $condition . "';";

	$result = $db_conn->query($sel_qry);
	$colData = array();

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			array_push($colData, $row[$objColName]);
		}
	}
	return $colData;
}


//db_select_oneCol
function db_select_oneCol($db_conn, $tableName, $objColName)
{

	$sel_qry = "select " . $objColName . " from " . $tableName . ";";

	$result = $db_conn->query($sel_qry);
	$colData = array();

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			array_push($colData, $row[$objColName]);
		}
	}
	return $colData;
}

/**
 *  Purpose: a function to prevent sql injection
 *  Parameters: @db_conn
 * @dataArr  array
 *  return: Array
 */

 
function db_prevent_SQLInjection($db_conn, $dataArr)
{
	if (is_array($dataArr)) {
		foreach($dataArr as $k =>$v) {
			db_prevent_SQLInjection($db_conn, $dataArr[$k]);
		}
	} else {
		$dataArr = $db_conn->real_escape_string(trim($dataArr));
	}
	return $dataArr;
} 

//get all the data from database
function db_get_all_data($db_conn,$selected_val)
{
	$qry = "select path_ID,path_name,path_length,description,note from path_general where path_ID=" . $selected_val . " ;";
	$rs = $db_conn->query($qry);
	if ($rs->num_rows > 0) {
		$row = $rs->fetch_assoc();
		$pathData = new stdClass();
		$pathData->id = $row['path_ID'];
		$pathData->name = $row['path_name'];
		$pathData->length = $row['path_length'];
		$pathData->description = $row['description'];
		$pathData->note = $row['note'];

	}

	$midPointsArr = array();

	$qry = "select path_midpt_ID,dist_from_start ,grd_height,trn_type,obstr_height,obstr_type  from path_midPoints where path_ID=" . $selected_val . " ;";
	$rs = $db_conn->query($qry);
	if ($rs->num_rows > 0) {
		while ($row = $rs->fetch_assoc()) {
			$midPoint = new stdClass();
			$midPoint->midpointID = $row['path_midpt_ID'];
			$midPoint->distance = $row['dist_from_start'];
			$midPoint->groundHeight = $row['grd_height'];
			$midPoint->trnType = $row['trn_type'];
			$midPoint->obstrHeight = $row['obstr_height'];
			$midPoint->obstrType = $row['obstr_type'];
			array_push($midPointsArr, $midPoint);
		}
	}

	$endPointsArr = array();

	$qry = "select path_endpt_ID, dist_from_start,grd_height, atn_height from path_endPoints where path_ID=" . $selected_val . " ;";
	$rs = $db_conn->query($qry);
	if ($rs->num_rows > 0) {
		while ($row = $rs->fetch_assoc()) {
			$endPoint = new stdClass();
			$endPoint->endptID = $row['path_endpt_ID'];
			$endPoint->distance = $row['dist_from_start'];
			$endPoint->groundHeight = $row['grd_height'];
			$endPoint->atnHeight = $row['atn_height'];
			array_push($endPointsArr, $endPoint);
		}
	}
	$data = new stdClass();
	$data->pathData = $pathData;
	$data->midpoints = $midPointsArr;
	$data->endpoints = $endPointsArr;

	return json_encode($data);
}

//update the data in databases and give the response to the browser
function updateDataAndReponse($db_conn, $qry)
{
	$db_conn->query($qry);

	if ($db_conn->errno != 0) {
		echo '{"status":"fail","data":[' . $db_conn->error . " query " . $qry . ']}';
	} else {
		echo '{ "status": "success" ,"data":"Success to modify the data"}';
	}
}
?>