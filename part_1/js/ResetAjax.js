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
        $('#msg').html(response.data.msg);
    }

});