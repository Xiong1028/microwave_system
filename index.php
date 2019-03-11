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
and satellite communications. In this project, We provide three parts.</p>

<h3>Part 1</h3>
<hr>
<div class="row">
<div class="card bg-success col-md-3">
    <div class="card-body">
        <a class="text-white" href="/lamp2project_group2/part_1/includes/uploads.php" style="font-size:150%;text-decoration:underline">Upload File</a>
    </div>
  </div>
  <br>
  <div class="card bg-info col-md-3 offset-md-1">
    <div class="card-body">
        <a href="/lamp2project_group2/part_1/includes/display_data.php" class="text-white"  style="font-size:150%;text-decoration:underline">Display Data</a>
    </div>
  </div>
  <br>
  <div class="card bg-danger col-md-3 offset-md-1">
    <div class="card-body">
        <a href="/lamp2project_group2/part_1/includes/resetData.php" class="text-white"  style="font-size:150%;text-decoration:underline">Reset Data</a>
    </div>
  </div>
  </div>
  <br>
  <br>


<h3>Part 2</h3>
<hr>
<div class="row">
<div class="card bg-success col-md-3">
    <div class="card-body">
        <a class="text-white" href="/lamp2project_group2/part_2/includes/send_to_editing.php" style="font-size:150%;text-decoration:underline">Edit Data</a>
    </div>
</div>
</div>
  

<!--Part 3 will goes here-->


</div>
<?php
require_once("./common/templates/footer.php");
?>

