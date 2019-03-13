<?php
/**
 *  Purpose: mutiple functions for handling databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Data:    Feb 10, 2019
 *
 */


/*
 *  Purpose: A function to read CSV file
 *  Parameter: @path
 *  Return: array
 *
 * */
function read_CSV($path)
{
	$data_array = [];
	$file = fopen($path, 'r') or die('Can not open ' . $path);

	while ($data = fgetcsv($file)) {
		//return an array for each line
		if (count($data) > 1) {
			$data_array[] = $data;
		}
	}

	fclose($file);
	return $data_array;

}


/*
 *  Purpose: A function to check if a file including pathName fields is uploaded
 *  Paramerte: @path  eg:the uploaded permanent location directory /lamp2project_group2/part_1/includes/uploads
 *             @pathName string eg 'path01'
 *  return: true  -> file is already existed
 *          false -> file is not existed
 *
 * */

function check_file_existed($path, $pathName)
{

	$handler = opendir($path);
	while (($filename = readdir($handler)) !== false) {
		if ($filename != "." && $filename != "..") {
			if (strpos($filename, $pathName) !== false) {
				return true;
			}
		}
	}
	return false;
}

//check post data is set
function check_post_data($postData)
{
	return isset($postData) ? $postData : null;
}


//validate the general path data
function valid_edit_gen($postGen)
{
	$errArr = array();
	//id and path_name is uneditable
	if (!isset($postGen['genPathInfoLen'])) {
		$errArr['genPathInfoLen'] = "The path_length must exist";
	} else if (empty(trim($postGen['genPathInfoLen'])) && trim($postGen['genPathInfoLen']) != "0") {
		$errArr['genPathInfoLen'] = "The path_length is empty";
	} else if ($postGen['genPathInfoLen'] < 1 || $postGen['genPathInfoLen'] > 100) {
		$errArr['genPathInfoLen'] = "The path_length must be between 1 and 100";
	} else if (!isset($postGen['genPathInfoDesc'])) {
		$errArr['genPathInfoDesc'] = "The description must exist";
	} else if (empty(trim($postGen['genPathInfoDesc'])) && trim($postGen['genPathInfoDesc']) != '0') {
		$errArr['genPathInfoDesc'] = "The description is empty";
	} else if (strlen($postGen['genPathInfoDesc']) > 255) {
		$errArr['genPathInfoDesc'] = "the length of description must be less than 255";
	} else if (strlen($postGen['genPathInfoNote']) > 65534) {
		$errArr['genPathInfoNote'] = "the length of note must be less 65534";
	}
	return $errArr;
}


//validate the midpoint data
function valid_edit_mid($postMid)
{
	$ter_allowedType_arrs = array("Grassland", "Rough Grassland", "Smooth rock", "Bare soil", "Paved Surface", "Lake", "Ocean", "Rough rock");
	$obstr_allowedType_arrs = array("None", "Trees", "Bush", "Building", "Webbed Towers", "Solid Towers", "Power Cables");

	$errArr = array();

	if (!isset($postMid['midgheight'])) {
		$errArr['midgheight'] = "The Ground height of the midPoint must exist";
	} else if (empty($postMid['midgheight']) && trim($postMid['midgheight']) != '0') {
		$errArr['midgheight'] = 'The Ground height of the midPoint cannot be empty';
	} else if ($postMid['midgheight'] < 0) {
		$errArr['midgheight'] = 'The Ground height of the midPoint must be greater than 0';
	} else if (!isset($postMid['midtrntype'])) {
		$errArr['midtrntype'] = "The terrain type must exist";
	} else if (empty($postMid['midtrntype']) && trim($postMid['midtrntype']) != '0') {
		$errArr['midtrntype'] = "The terrain type cannot be empty";
	} else if (!in_array($postMid['midtrntype'], $ter_allowedType_arrs, false)) {
		$errArr['midtrntype'] = "The terrain type is invalid";
	}
	if (!isset($postMid['midobheight'])) {
		$errArr['midobheight'] = "The obstruction height of midPoint must exist";
	} else if (empty($postMid['midobheight']) && trim($postMid['midobheight']) != '0') {
		$errArr['midobheight'] = 'The obstruction height of midPoint cannot be empty';
	} else if ($postMid['midobheight'] < 0) {
		$errArr['midobheight'] = 'The obstruction height of midPoint must be greater than 0';
	} else if (!isset($postMid['midobtype'])) {
		$errArr['midobtype'] = 'The obstruction type must exist';
	} else if (empty($postMid['midobtype']) && trim($postMid['midobtype']) != '0') {
		$errArr['midobtype'] = 'The obstruction type cannot be empty';
	} else if (!in_array($postMid['midobtype'], $obstr_allowedType_arrs, false)) {
		$errArr['midobtype'] = 'The obstruction type is invalid';
	}
	return $errArr;
}

?>