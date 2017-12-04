/** INSERTAR LOS DIEZ ULTIMOS ASIENTOS DEL LIBRO DIARIO GENERAL **/


function insertarDiarioGeneral(url) {
    $.ajax({
        type: 'get',
        url: url,
        datatype: "html",
        success: function(response) {
            $('#grid2').html(response);    
        },
    });        
}