//midpointID
/*
*  Purpose: this js script is used to launch ajax to pass the modified data to the server
*  Authors: Hui, Debora, Jihye, Xiong, Jane
*  Date: March 10, 2019
*
* */


$(document).ready(function () {
    $("#editGenPoint").submit(function(e){
        $.post("../includes/ajax/updateEditData.php", $(this).serialize(), onNewPost);
        e.preventDefault();
    });

    $("#editMidPoint").submit(function(e){
        $.post("../includes/ajax/updateEditData.php", $(this).serialize(), onNewPost);
        e.preventDefault();
    });

    const onNewPost = function(response){
        //display the response msg
        console.log(response);
    }

});