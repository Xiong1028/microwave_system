<?php
/*
 *  Purpose: a select form for users to reset the data in the database
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 9, 2019
**/

require_once("../../common/templates/header.php");
?>

<?php
$isValid = true;
$upload_msg = array();

function dbFile($dt, $fn){
	$err_msg = array();
	$dataGen = array();
	$dataEnd = array();
	$dataMid = array();

	// validate line 1 
	for ($i=0; $i<4; $i++){
		if(!isset($dt[0][$i])){
			$err_msg[] = "Data must exsit!";
		}else {
			$dataGen[0][$i] = trim($dt[0][$i]);
			if(strlen($dataGen[0][$i]) == 0){
				$err_msg[] = "Data is empty!";
			}else{
				if($i == 0 && strlen($dataGen[0][$i]) > 100){
					$err_msg[] = "Path name is too long.";
				}
				if($i == 1 && (floatval($dataGen[0][$i])<1.0 || floatval($dataGen[0][$i]))>100.0){
					$err_msg[] = "Path length value is invalid.";
				}
				if($i == 2 && strlen($dataGen[0][$i]) > 255){
					$err_msg[] = "Description is too long.";
				}
			}
		}
	}

	// save line 1 into path_general table
	// Database connection
	$db_conn = new mysqli('localhost', 'lamp2user', 'Test123!', 'microwave_path_data');
	if ($db_conn->connect_errno){
		die("Could not connect to database server \n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
	}

	// disable autocommit
	$db_conn->autocommit(false);

	if(count($err_msg) == 0){
		
		if(isset($dt[0][3])){
			$dataGen[0][3] = trim($dt[0][3]);
			
			if(strlen($dataGen[0][3]) <= 65534){

				$qry = "INSERT INTO path_general(path_name, path_length, description, note) VALUES('".$dataGen[0][0]."', '".$dataGen[0][1]."', '".$dataGen[0][2]."', '".$dataGen[0][3]."');";
				$db_conn->query($qry);
				
				if(!$db_conn){			
					$db_conn->rollback();
				}
			}else{
				$err_msg[] = "Note is too long.";
				$db_conn->rollback();
			}
		}else{
			$qry = "INSERT INTO path_general(path_name, path_length, description) VALUES('".$dataGen[0][0]."', '".$dataGen[0][1]."', '".$dataGen[0][2]."');";
			$db_conn->query($qry);
			if(!$db_conn){
				$db_conn->rollback();
			}
		}	
	}else{
		$db_conn->rollback();
	}


	// validate line 2 & 3
	for($i=1; $i<3; $i++){ 
		for ($j=0; $j<3; $j++){
			if(!isset($dt[$i][$j])){
				$err_msg[] = "Data must exsit!";
			}else {
				$dataEnd[$i][$j] = trim($dt[$i][$j]);
				if(strlen($dataEnd[$i][$j]) == 0){
					$err_msg[] = "Data is empty!";
				}else{
					if($i == 1 && $j == 0 && floatval($dataEnd[$i][$j]) != 0.0){
						$err_msg[] = "Distance from start should be 0.";
					}
				}
			}
		}
	}

	// save line 2 & 3 into path_endPoints table
	if(count($err_msg) == 0){
		for($i=1; $i<3; $i++){
			if(strpos($fn, 'path01')){
				$qry = "INSERT INTO path_endPoints(path_ID, dist_from_start, grd_height, atn_height) VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 01'), '".$dataEnd[$i][0]."', '".$dataEnd[$i][1]."', '".$dataEnd[$i][2]."');";
			}
			if(strpos($fn, 'path02')){
				$qry = "INSERT INTO path_endPoints(path_ID, dist_from_start, grd_height, atn_height) VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 02'), '".$dataEnd[$i][0]."', '".$dataEnd[$i][1]."', '".$dataEnd[$i][2]."');";
			}
			if(strpos($fn, 'path03')){
				$qry = "INSERT INTO path_endPoints(path_ID, dist_from_start, grd_height, atn_height) VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 03'), '".$dataEnd[$i][0]."', '".$dataEnd[$i][1]."', '".$dataEnd[$i][2]."');";
			}
			$db_conn->query($qry);
			if(!$db_conn){
				$db_conn->rollback();
			}
		}		
	}else{
		$db_conn->rollback();
	}


	// validate line 4 and the following
	for($i=3; $i<17; $i++){ 
		$trnType = array('Grassland', 'Rough Grassland', 'Smooth rock', 'Bare Rock', 'Bare earth', 'Paved Surface', 'Lake', 'Ocean', 'Rough rock', 'Bare soil');
		$obstrType = array('None', 'Trees', 'Brush', 'Building', 'Webbed Towers', 'Solid Towers', 'Power Cables');
		
		for ($j=0; $j<5; $j++){
			if(!isset($dt[$i][$j])){
				$err_msg[] = "Data must exsit!";
			}else {
				$dataMid[$i][$j] = trim($dt[$i][$j]);
				if(strlen($dataMid[$i][$j]) == 0){
					$err_msg[] = "Data is empty!";
				}else{
					if($j == 2 && strlen($dataMid[$i][$j]) > 50){
						$err_msg[] = "Terrain Type is too long";
					}else if($j == 2 && strlen($dataMid[$i][$j]) <= 50){
						if(!in_array($dataMid[$i][$j], $trnType)){
							$err_msg[] = "Terrain Type value is not allowed.";
						}
					}
					if($j == 4 && strlen($dataMid[$i][$j]) > 50){
						$err_msg[] = "Obstruction Type is too long";
					}else if($j == 4 && strlen($dataMid[$i][$j]) <= 50){
						if(!in_array($dataMid[$i][$j], $obstrType)){
							$err_msg[] = "Obstruction Type value is not allowed.";
						}
					}
				}
			}
		}
	}

	// save line 4 and the following into path_midPoints table
	if(count($err_msg) == 0){
		for($i=3; $i<17; $i++){
			if(strpos($fn, 'path01')){
				$qry = "INSERT INTO path_midPoints(path_ID, dist_from_start, grd_height, trn_type, obstr_height, obstr_type) 
					VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 01'), '".$dataMid[$i][0]."', '".$dataMid[$i][1]."', 
					'".$dataMid[$i][2]."', '".$dataMid[$i][3]."', '".$dataMid[$i][4]."');";
			}
			if(strpos($fn, 'path02')){
				$qry = "INSERT INTO path_midPoints(path_ID, dist_from_start, grd_height, trn_type, obstr_height, obstr_type) 
					VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 02'), '".$dataMid[$i][0]."', '".$dataMid[$i][1]."', 
					'".$dataMid[$i][2]."', '".$dataMid[$i][3]."', '".$dataMid[$i][4]."');";
			}
			if(strpos($fn, 'path03')){
				$qry = "INSERT INTO path_midPoints(path_ID, dist_from_start, grd_height, trn_type, obstr_height, obstr_type) 
				VALUES((SELECT path_ID FROM path_general WHERE path_name = 'Pah 03'), '".$dataMid[$i][0]."', '".$dataMid[$i][1]."', 
				'".$dataMid[$i][2]."', '".$dataMid[$i][3]."', '".$dataMid[$i][4]."');";
			}
			$db_conn->query($qry);
			if(!$db_conn){
				$db_conn->rollback();
			}else{
				$db_conn->commit();
			}
		}		
	}else{
		$db_conn->rollback();
	}

	$db_conn->close();
}

function loadFile($fname){
	// Open file from permanent location
	$fp = fopen($fname, "r");
	if(!$fp){
		die("Could not open file\n");
	}

	// Read lines from csv, save into a 2D array.
	$data = array();
	$row = 0;
	while(($line = fgetcsv($fp)) != false){
		$data[$row] = $line;
		$row++;
	}

	dbFile($data, $fname);	
}

// Handling file uploading and saving
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // validate meta data for uploaded file
	if ($_FILES['path']['error'] == 0 && $_FILES['path']['size'] > 0){

		$ext = strtolower(pathinfo($_FILES['path']['name'], PATHINFO_EXTENSION));

		if (!file_exists($_FILES['path']['tmp_name'])){ 
			$upload_msg[] = "The file doesn't exist! ";
			$isValid = false; 
		}else if ($ext !== 'csv'){
			$upload_msg[] = "That file type isn't accepted!";
			$isValid = false;
		}
			
	}else{
		$upload_msg[] = "Your text file failed.";
		$isValid = false;
	}
		
	// validate file uploading
	if($isValid){

		// move file to permament location.
		chmod($_FILES['path']['tmp_name'], 0777);
		if(!is_dir('uploads')){ mkdir("uploads", 0777); }
		$fn = $_FILES['path']['name'];
		$fileName = "uploads/$fn" . rand(10000, 99999) . "." . $ext;
		$success = move_uploaded_file($_FILES['path']['tmp_name'], $fileName);
		if ($success){
//			$qry = "insert into path_general(note) values('".$fileName."');";
//			$db_conn->query($qry);
			$upload_msg[] = "Success! Your file was saved as ". $fileName."<br>";

			loadFile($fileName);
			
		}else{
			$upload_msg[] = "Fail to save file.";
		}
	}
}
?>

    <h2>Part C Web Form</h2>
    <label>Upload a path file</label>
    <form method="post" enctype="multipart/form-data"> 
		<input type="file" name="path" accept="text/*"/>
        <br/><br/>
		<input class="btn btn-outline-secondary" type="submit" value="Submit" />
		<div><?php foreach($upload_msg as $m){echo $m;} ?></div>
	</form>
	

<?php
require_once("../../common/templates/footer.php");
?>