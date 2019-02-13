$(document).ready(function () {
    $('#resetForm').submit(function (event) {

        var selVal = $('#pathSel').val();
        if (selVal) {
            $.post("../includes/reset_ajax.php", $(this).serialize(), onNewPost);
        } else {
            window.alert("Please select the Path Name firstly");
            $('#msg').html('');
        }
        event.preventDefault();
    })

    var onNewPost = function (response) {
        if (response.code == 200) {
            $('#msg').html(response.data.msg);
        } else if (response.code == 400) {
            $('#msg').html(response.data.msg);
        } else if (response.code = 404) {
            $('#msg').html(response.data.msg);
        }
    }

});