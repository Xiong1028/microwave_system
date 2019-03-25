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
    console.log(response);

    // Generate tables
    var pd = response.pathData;
    // First table
    var table = "<h4>Path_General</h4><table class='table table-striped table-hover'><tr><th>Path Name</th><th>Path length</th><th>Description</th><th>Note</th></tr>";

    table+="<tr><td>"+pd.name + "</td><td>" + pd.length + "</td><td>" + pd.description + "</td><td>" + pd.note +"</td></tr>";
    table+="</table><br><br>";

    //Second Table
    var td = response.endpoints;
    table += "<h4>Path_EndPoints</h4><table class='table table-striped table-hover'><tr><th>Distance from start</th><th>Ground Height</th><th>Atn Height</th></tr>";
    for (var j = 0; j < response.endpoints.length; j++) {

        table+="<tr><td>"+td[j].distance+"</td><td>"+td[j].groundHeight+"</td><td>"+td[j].atnHeight+"</td></tr>";
    }
    table+="</table><br><br>";

    //Third Table
    var sd = response.midpoints;

    table += "<h4>Path_MidPoints</h4><table class='table table-striped table-hover'><tr><th>Distance from start</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th></th><th>Curvature Height</th><th>Apparent Ground and Obstruction Height</th><th>1st Freznel Zone</th><th>Toatl Clearance Height</th></tr>";

    for (var i = 0; i < sd.length; i++) {
        table+="<tr><td>"+sd[i].distance + "</td><td>" + sd[i].groundHeight + "</td><td>" + sd[i].trnType
            + "</td><td>" + sd[i].obstrHeight +"</td><td>"+sd[i].obstrType+"</td><td>"+sd[i].curHeight+"</td><td>"+sd[i].AptGrdHeight+"</td><td>"+sd[i].FistFreZone + "</td><td>" + sd[i].totClrHeight + "</td></tr>";
    }

    table+="</table>";
    $("#pa_output").html(table);


    // Generate graph
    var graph = "<h4>Calculaton Results</h4><p>Path Attenuation (dB): " + response.PAData['1.5000'] + "</p><br/><br/>";
    $('#pa_text').html(graph);

    var max = 0;
    for (var i = 0; i < sd.length-1; i++) {
        if (sd[i].totClrHeight >= sd[i+1].totClrHeight){
            var ceilValue = Math.ceil(sd[i].totClrHeight / 10) * 10; 
            max = ceilValue;
        }
    }
    if ((parseInt(td[1].groundHeight) + parseInt(td[1].atnHeight)) >= max) {
        max = Math.ceil((parseInt(td[1].groundHeight) + parseInt(td[1].atnHeight)) / 10) * 10;
    }

    var chart = new CanvasJS.Chart("pa_graph", {
        theme: "light2",
        title:{
            text: response.pathData.name + " with curvature 4/3"
        },
        axisX:{
            interval: parseInt(sd[0].distance),
            minimum: td[0].distance,
            maximum: td[1].distance            
        },
        axisY: {
            interval: 10,
            minimum: 0,
            maximum: max    
        },      
        legend:{
            verticalAlign: "top",
            horizontalAlign: "right",
        },
        data: [{
            type: "line",
            showInLegend: true,
            name: "Path",
            color: "blue",
            dataPoints: [
                { x: td[0].distance, y: parseInt(td[0].groundHeight) + parseInt(td[0].atnHeight) },
                { x: td[1].distance, y: parseInt(td[1].groundHeight) + parseInt(td[1].atnHeight) }
            ]
        },
        {
            type: "line",
            showInLegend: true,
            name: "Gnd + Obs",
            color: "green",
            dataPoints: 
            [
                { x: td[0].distance, y: td[0].groundHeight },
                { x: sd[0].distance, y: sd[0].AptGrdHeight },
                { x: sd[1].distance, y: sd[1].AptGrdHeight },
                { x: sd[2].distance, y: sd[2].AptGrdHeight },
                { x: sd[3].distance, y: sd[3].AptGrdHeight },
                { x: sd[4].distance, y: sd[4].AptGrdHeight },
                { x: sd[5].distance, y: sd[5].AptGrdHeight },
                { x: sd[6].distance, y: sd[6].AptGrdHeight },
                { x: sd[7].distance, y: sd[7].AptGrdHeight },
                { x: sd[8].distance, y: sd[8].AptGrdHeight },
                { x: sd[9].distance, y: sd[9].AptGrdHeight },
                { x: sd[10].distance, y: sd[10].AptGrdHeight },
                { x: sd[11].distance, y: sd[11].AptGrdHeight },
                { x: sd[12].distance, y: sd[12].AptGrdHeight },
                { x: sd[13].distance, y: sd[13].AptGrdHeight },
                { x: td[1].distance, y: td[1].groundHeight }                
            ]    
        },
        {
            type: "line",
            showInLegend: true,
            name: "1st Freznel",
            color: "red",
            dataPoints: [
                { x: td[0].distance, y: td[0].groundHeight },
                { x: sd[0].distance, y: sd[0].totClrHeight },
                { x: sd[1].distance, y: sd[1].totClrHeight },
                { x: sd[2].distance, y: sd[2].totClrHeight },
                { x: sd[3].distance, y: sd[3].totClrHeight },
                { x: sd[4].distance, y: sd[4].totClrHeight },
                { x: sd[5].distance, y: sd[5].totClrHeight },
                { x: sd[6].distance, y: sd[6].totClrHeight },
                { x: sd[7].distance, y: sd[7].totClrHeight },
                { x: sd[8].distance, y: sd[8].totClrHeight },
                { x: sd[9].distance, y: sd[9].totClrHeight },
                { x: sd[10].distance, y: sd[10].totClrHeight },
                { x: sd[11].distance, y: sd[11].totClrHeight },
                { x: sd[12].distance, y: sd[12].totClrHeight },
                { x: sd[13].distance, y: sd[13].totClrHeight },
                { x: td[1].distance, y: td[1].groundHeight }               
            ]
        }
    ]   
    });
    chart.render();
}
