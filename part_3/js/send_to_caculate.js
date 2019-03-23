/*
*  Purpose: this js script is used to launch ajax to pass the modified data to the server
*  Authors: Hui, Debora, Jihye, Xiong, Jane
*  Date: March 21, 2019
*
* */

$(document).ready(function(){
    $("#formSelPathAndCurv").submit(function(e){
        $.post("../includes/path_loss_cal.php",$(this).serialize(),onPathLossCal);
        e.preventDefault();
    })
})

const onPathLossCal = function(response){
    

}
