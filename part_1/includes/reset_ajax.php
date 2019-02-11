<?php
/*
 *  Purpose: handle the reset ajax request and give a succ/fail reponse after resetting data to original status in the databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:    Feb 9, 2019
**/
header("Content-Type: application/json");

require_once('../../common/utilities/dbhandler.php');
require_once('../../common/utilities/readCSV.php');
require_once ('../../common/utilities/ValidateCSV.class.php');

$db_conn = connect_db();



//read the data from csv files;
$path_data_arr = read_CSV("../../common/uploads/".$_POST['pathSel'].".csv");

//create a validation object to validate the data from csv file
$validationObj = new ValidateCSV($path_data_arr);


//declare arrays to save data of csv file
$path_wide_data=array();
$path_endPoints_data=array();
$path_midPoints_data = array();

//validate the data and reset the data into database
if(!$validationObj->get_errors_arr()){
    $path_wide_data = $validationObj->get_path_wide();
    $path_endPoints_data = $validationObj->get_path_endPoints();
    $path_midPoints_data = $validationObj->get_path_midPoints();


    //delete the path end point and mid point data for the path from the database;








}else{
    echo json_encode($validationObj->get_errors_arr());
}

$path_data_arr['code'] = 'ok';




disconnect_db($db_conn);

?>