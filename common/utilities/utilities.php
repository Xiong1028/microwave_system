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
function read_CSV($path){
    $data_array=[];
    $file = fopen($path,'r') or die('Can not open ' .$path);

    while($data = fgetcsv($file)){
        //return an array for each line
        if(count($data)>1){
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

function check_file_existed($path,$pathName){

    $handler = opendir($path);
    while( ($filename = readdir($handler)) !== false ) {
        if($filename != "." && $filename != ".."){
           if(strpos($filename,$pathName)!==false){
               return true;
           }
        }
    }
    return false;
}

?>