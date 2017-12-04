/** INSERTAR TABLAS DE FACTURAS RECIBIDAS **/


function insertarTablaFacturas(url, id_tabla) {
    $.ajax({
        type: 'get',
        url: url,
        datatype: "html",
        success: function(response) {
            $('#grid1').html(response);
            TablaDataTable(id_tabla)
        },
    });      
}