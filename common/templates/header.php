<?php
/**
 * Purpose: create a header templates for all pages.
 * Authors : Hui, Debora, Jihye, Xiong, Jane
 * Date: Feb 8, 2019
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
       integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

   <!-- <link rel="stylesheet" href="/lamp2project_group2/common/css/all.css" rel="stylesheet" > -->
   <!-- <link rel="stylesheet" href="/lamp2project_group2/common/css/font-awesome.min.css" rel="stylesheet" > -->
    <link rel="stylesheet" href="/lamp2project_group2/common/css/main.css" rel="stylesheet" >
    <link rel="stylesheet" href="/lamp2project_group2/common/css/bootstrap.css" rel="stylesheet">

    <script src="/lamp2project_group2/common/js/jquery-3.3.1.min.js"></script>

    <title>LAMP2_Project2_Group2</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom:30px;">
    <a class="navbar-brand" href="/lamp2project_group2/">Microwave Radio Data System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/lamp2project_group2/"><i class="fa fa-home" style="margin-right: 5px"></i>Home</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/lamp2project_group2/part_1/includes/uploads.php"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 5px"></i>Upload
                    File</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/lamp2project_group2/part_1/includes/display_data.php"> <i class="fa fa-table" aria-hidden="true" style="margin-right: 5px"></i>Display
                    Data</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/lamp2project_group2/part_2/includes/send_to_editing.php"> <i class="fa fa-edit" aria-hidden="true" style="margin-right: 5px"></i>Edit
                    Data</a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   href="/lamp2project_group2/part_1/includes/resetData.php"><i
                            class="fa fa-cog" aria-hidden="true" style="margin-right: 5px"></i>Reset Data</a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   href="/lamp2project_group2/part_3/includes/path_loss_statics.php"><i
                            class="fas fa-chart-area" aria-hidden="true" style="margin-right: 5px"></i>Data Statics</a>
            </li>

        </ul>
    </div>
</nav>


