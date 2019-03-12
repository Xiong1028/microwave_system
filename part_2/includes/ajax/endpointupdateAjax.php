<?php 
$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
if ($db_conn->connect_errno) {
    die("Could not connect to database server \n Error: " . $db_conn->connect_errno . "\n Report: " . $db_conn->connect_error . "\n");
}

$WhatWasReturned = "";
$gheight= ""; 
$aheight ="";
$gheight_error_message = "";
$aheight_error_message = "";
$endpointid = "";
$endpointid_error_message = "";
$AllErrorMessages = "";

if(isset($_POST["gheight"])) $gheight = $_POST["gheight"];
if(isset($_POST["aheight"])) $aheight = $_POST["aheight"];
if(isset($_POST["id_hidden"])) $endpointid= $_POST["id_hidden"];


function isValid($messages_for_validation){

	foreach($messages_for_validation as $current_message){
		if(!empty($current_message)) return false;
	}
	return true;
}


//WHEN THE BUTTON change IS HIT
//if (isset($_POST["change"])) {

	$valid = true;
	if (empty($gheight)) {
        $gheight_error_message = "A ground height must be provided. ";	
        $AllErrorMessages =  $gheight_error_message;
	}

	if (empty($aheight)){
        $aheight_error_message = "A aheight must be provided. ";
        $AllErrorMessages = $AllErrorMessages.$aheight_error_message;
	
    }

    if (empty($endpointid)){
        $endpointid_error_message = "No ID found. ";
        $AllErrorMessages = $AllErrorMessages.$endpointid_error_message;
	
    }
    
    if(isValid(array($gheight_error_message,$aheight_error_message, $endpointid_error_message))) {

		$WhatWasReturned = changeEndPoint($db_conn,$gheight,$aheight, $endpointid);
		if($WhatWasReturned =="success"){
            http_response_code (200);
            echo "the data was updated with success";
		}else{
            http_response_code (503);
            echo "something happened on database. Error: ".$WhatWasReturned;
        }
    }else{
        http_response_code (400);
        echo $AllErrorMessages;
    }


// Update to the database
function changeEndPoint($db_conn, $gheight,$aheight, $endpointid){

    $qry = "UPDATE path_endPoints SET grd_height=".$gheight.", atn_height=".$aheight." WHERE path_endpt_ID=".$endpointid.";";
	$db_conn->query($qry);
	if($db_conn->errno != 0){
		return $db_conn->error." query ".$qry;
	}else{
		return "success";
	}
}
$db_conn->close();


?>
