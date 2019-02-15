<?php
/*
 *  Purpose: this page is the entrance page for the whole project;
 *  Authors : Hui, Debora, Jihye, Xiong, Jane
 *  Date: Feb 8, 2019
 *
 */

require_once("./common/templates/header.php");
?>

<div class="container">
<h1>Microwave radio system</h1>
<p><mark>Microwave radio systems</mark> are widely used throughout the world for many applications
including WiFi, cell phones, point-to-point communications (voice, data, video, etc.)
and satellite communications. In this part1 of project, We provide three functionalities. </p>
<div class="card bg-success col-md-6">
    <div class="card-body">
        <a class="text-white" href="/lamp2project_group2/part_1/includes/uploads.php" style="font-size:150%;text-decoration:underline">Upload File</a>
        <span style="margin-left:30px;"> - Upload the csv file data into the system</span>
    </div>
  </div>
  <br>
  <div class="card bg-info col-md-6">
    <div class="card-body">
        <a href="/lamp2project_group2/part_1/includes/display_data.php" class="text-white"  style="font-size:150%;text-decoration:underline">Display Data</a>
        <span style="margin-left:30px;">- Display microwave data </span>
    </div>
  </div>
  <br>
  <div class="card bg-danger col-md-6 ">
    <div class="card-body">
        <a href="/lamp2project_group2/part_1/includes/resetData.php" class="text-white"  style="font-size:150%;text-decoration:underline">Reset Data</a>
        <span style="margin-left:30px;">- Reset microwave data to original status</span>
    </div>
  </div>

</div>
<?php
require_once("./common/templates/footer.php");
?>

