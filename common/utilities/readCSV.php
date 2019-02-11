<?php
/**
  *  Purpose: mutiple functions for Reading CSV file 
  *  Authors: Hui, Debora, Jihye, Xiong, Jane
  *  Data:    Feb 10, 2019
  *
*/

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
?>