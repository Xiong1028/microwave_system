<?php
/*
*  Purpose: this file is used to handle the ajax request, calculate the path loss and response the result to browser
*  Authors: Hui, Debora, Jihye, Xiong, Jane
*  Date: March 21, 2019
* */
//header("Content-Type: application/json");

require_once("../../common/utilities/dbHandler.php");
require_once("../../common/utilities/utilities.php");

//
//$_POST['selectedPath'] = check_post_data($_POST['selectedPath']);
//$_POST["selectedCurv"] = check_post_data($_POST["selectedCurv"]);


$db_conn = connect_db();

//get_all_the_data from database when passing the selected Id
$allPathData = db_get_all_data($db_conn,  1);
$curPathData = json_decode($allPathData);

$pathData = $curPathData->pathData;
$midPointData = $curPathData->midpoints;
$endPointData = $curPathData->endpoints;

var_dump($pathData);
//var_dump($midPointData);
//var_dump($endPointData);

$Fghz = (float)$pathData->length;
var_dump($Fghz);

$totalDistance = 0;
foreach ($endPointData as $v){
	if((float)$v->distance != 0.0){
		$totalDistance =(float)$v->distance;
	}
}
//var_dump($totalDistance);

foreach ($midPointData as $k => $v){
	$curHeight = ((float)$midPointData[$k]->distance *($totalDistance-(float)$midPointData[$k]->distance))/17;
	$midPointData[$k]->curHeight = round($curHeight,4);

	$midPointData[$k]->AptGrdHeight = $midPointData[$k]->groundHeight + $midPointData[$k]->obstrHeight + $midPointData[$k]->curHeight;

	$FistFreZone = 17.3 * sqrt(((float)$midPointData[$k]->distance *($totalDistance-(float)$midPointData[$k]->distance))/($Fghz * $totalDistance));
	$midPointData[$k]->FistFreZone = round($FistFreZone,4);

	$midPointData[$k]->totClrHeight = $midPointData[$k]->AptGrdHeight + $midPointData[$k]->FistFreZone;

	var_dump(92.4 + 20 * log($Fghz,10) + 20 * log((float)$midPointData[$k]->distance,10));
}

//var_dump($midPointData);

function CalData($db_conn,$selectedPathId, $selectedCurv){
	$allPathData = db_get_all_data($db_conn,$selectedPathId);
	$curPathData = json_decode($allPathData);

	$pathData = $curPathData->pathData;
	$midPointData = $curPathData->midpoints;
	$endPointData = $curPathData->endpoints;

	$Fghz = (float)$pathData->length;

	$totalDistance = 0;
	foreach ($endPointData as $v){
		if((float)$v->distance != 0.0){
			$totalDistance =(float)$v->distance;
		}
	}

	switch($selectedCurv){
		case 4/3:
			foreach ($midPointData as $k => $v){
				//caculate curvature height
				$curHeight = ((float)$midPointData[$k]->distance *($totalDistance-(float)$midPointData[$k]->distance))/17;
				$midPointData[$k]->curHeight = round($curHeight,4);

				//caculate Apparent Ground and Obstructuion Height
				$midPointData[$k]->AptGrdHeight = $midPointData[$k]->groundHeight + $midPointData[$k]->obstrHeight + $midPointData[$k]->curHeight;

				//caculate 1st Freznel Zone
				$FistFreZone = 17.3 * sqrt(((float)$midPointData[$k]->distance *($totalDistance-(float)$midPointData[$k]->distance))/($Fghz * $totalDistance));
				$midPointData[$k]->FistFreZone = round($FistFreZone,4);

				//caculate Total Clearance Height
				$midPointData[$k]->totClrHeight = $midPointData[$k]->AptGrdHeight + $midPointData[$k]->FistFreZone;
			}

	}



}

?>