$(document).ready(function () {
   
    //lanch ajax request
    $('#resetForm').submit(function (event) {
        var selVal = $('#pathSel').val();
        if (!selVal) {
            window.alert("Path name must be Selected");
            return;
        }
        $.post("../includes/reset_ajax.php", $(this).serialize(), onNewPost);
        event.preventDefault();
    })

    
    const onNewPost = function(response){
        console.log(response);
       if(response.status=="None"){
            $('#msg').html(`Failed to reset data of ${$('#pathSel').val()}`);
       }else if(response.status=="ok"){
            // $('#msg').html(response);
       }
    }

});