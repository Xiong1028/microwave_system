/*
*  Purpose: this js script is used to launch ajax to pass the modified data to the server
*  Authors: Hui, Debora, Jihye, Xiong, Jane
*  Date: March 15, 2019
*
* */

$(document).ready(function () {
    $("#editGenPoint").submit(function (e) {
        $.post("../includes/ajax/genUpdateAjax.php", $(this).serialize(), onGenPost);
        e.preventDefault();
    });

    $("#editMidPoint").submit(function (e) {
        $.post("../includes/ajax/midpointupdateAjax.php", $(this).serialize(), onMidPost);
        e.preventDefault();
    });

    const onGenPost = function (response) {
        console.log(response);
        if (response.status === "success") {
            const genWithIDToUpdate = data.pathData;

            genWithIDToUpdate.length = $("#genPathInfoLen").val();
            genWithIDToUpdate.description = $("#genPathInfoDesc").val();
            genWithIDToUpdate.note = $("#genPathInfoNote").val();

            //display the form updated(behind)
            displaydata(data);

            $("#msg").html("Success to edit data");
            $('#myModal_GeneralPath').modal('toggle');

        } else if (response.status === "failOnGen") {
            $("#msg").html('');
            let errMsg = response.data;
            if (errMsg['genPathInfoLen']) {
                $('#genModMsg').html(errMsg['genPathInfoLen']);
            } else if (errMsg['genPathInfoDesc']) {
                $('#genModMsg').html(errMsg['genPathInfoDesc']);
            } else if (errMsg['genPathInfoNote']) {
                $('#genModMsg').html(errMsg['genPathInfoNote']);
            }
        }
    }

    const onMidPost = function (response) {
        if (response.status === "success") {
            console.log($('#midpointid').val());
            var midWithIDToUpdate = data.midpoints.find(function (el) {
                return el.midpointID == $('#midpointid').val();
            })

            midWithIDToUpdate.groundHeight = $("#midgheight").val();
            midWithIDToUpdate.trnType = $("#midtrntype").val();
            midWithIDToUpdate.obstrHeight = $("#midobheight").val();
            midWithIDToUpdate.obstrType = $("#midobtype").val();

            //display the form updated(behind)
            displaydata(data);

            $("#msg").html("Success to edit data");
            $('#myModal_MidPoint').modal('toggle');

        } else if (response.status === "failOnMid") {
            $("#msg").html('');
            let errMsg = response.data;
            if (errMsg['midgheight']) {
                $('#midModMsg').html(errMsg['midgheight']);
            } else if (errMsg['midtrntype']) {
                $('#midModMsg').html(errMsg['midtrntype']);
            } else if (errMsg['midobheight']) {
                $('#midModMsg').html(errMsg['midobheight']);
            } else if (errMsg['midobtype']) {
                $('#midModMsg').html(errMsg['midobtype']);
            }
        }
    }
});