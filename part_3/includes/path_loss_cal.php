<?php
/*
*  Purpose: this file is used to handle the ajax request, calculate the path loss and response the result to browser
*  Authors: Hui, Debora, Jihye, Xiong, Jane
*  Date: March 21, 2019
* */

header("Content-Type: application/json");

require_once("../../common/utilities/dbHandler.php");
require_once("../../common/utilities/utilities.php");

$_POST['selectedPath'] = check_post_data($_POST['selectedPath']);
$_POST["selectedCurv"] = check_post_data($_POST["selectedCurv"]);

$db_conn = connect_db();

calData($db_conn,$_POST['selectedPath'],$_POST['selectedCurv']);

disconnect_db($db_conn);
?>