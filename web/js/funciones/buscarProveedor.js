/**FUNCIONALIDADES CLICK EN BUSCAR PROVEEDOR
 
-La función grids() nos muestra la tabla -Proveedores- con la función gridProveedores(), y la tabla -Cuentas Personales- con la
función gridCuentasPersonales().

-Para mostrar la tabla -Proveedores- hacemos una llamada Ajax y necesitamos dos parámetros; url1 (apunta al controlador symfony para
mostrar la tabla), e id_cuentaPersonal. Se nos muestra la tabla haciendo uso del plugin jquery DataTable que ejecutamos en la función
TablaDataTable(). Posteriormente cambiamos el tipo de cursor al hacer hover sobre una fila de la tabla. Y por último obtenemos el
Proveedor haciendo doble click sobre una fila con la función ObtenerProveedor().

-Para mostar la tabla -Cuentas Personales- hacemos una llamada Ajax como en el caso anterior. Pero esta vez al hacer doble click sobre
una fila, si la cuenta personal no es proveedor damos la opción a cambiarla utilizando para ello la función ConvertirCuentaEnProveedor()
la cual hace uso del plugin jquery alertify**/


function buscarProveedor(url1, url2, url3, url4, url5, id_cuentaPersonal) {
    $('#Buscar_proveedor').click(function(e){
        e.preventDefault();
        $('#mensaje').empty();
        gridProveedores(url1, id_cuentaPersonal);
        gridCuentasPersonales(url2, url3, url4, url5, id_cuentaPersonal);
    });
}


//Muestra la tabla Proveedores
function gridProveedores(url1, id_cuentaPersonal) {
    $.ajax({
        type: 'get',
        url: url1,
        datatype: "html",
        success: function(response){
            $('#grid1').html(response);
            TablaDataTable('#tabla_proveedores');
            $('#grid1').css('background-color', '#dbddd4');
            CambiarCursorTabla('#tabla_proveedores tr');
            ObtenerProveedor('#tabla_proveedores tbody', $('#tabla_proveedores'), id_cuentaPersonal, 'div#cpers');
        },
    });    
}

//Muesta la tabla Cuentas Personales
function gridCuentasPersonales(url2, url3, url4, url5, id_cuentaPersonal) {
    $.ajax({
        type: 'get',
        url: url2,
        datatype: "html",
        success: function(response){
            $('#grid2').html(response);
            TablaDataTable('#tabla_ctasPersonales');
            $('#grid2').css('background-color', '#dbddd4');
            CambiarCursorTabla('#tabla_ctasPersonales tr');
            ConvertirCuentaEnProveedor('#tabla_ctasPersonales tbody', url3, url4, url5, id_cuentaPersonal);
        },
    });
}

//Aplica el plugin jquery DaataTable a una tabla concretada por el parámetro id_tabla
function TablaDataTable(id_tabla) {
    var table = $(id_tabla).DataTable({
        paging: false,
        scrollY: 178,
        language: {
            processing:     "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",            
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
            aria: {
                sortAscending: "Activar para ordenar la columna de manera ascendente",
                sortDescending: "Activar para ordenar la columna de manera descendente"
            },
        }
    });    
}

//Cambia el tipo de cursor al seleccionar fila en una tabla
function  CambiarCursorTabla(id_trTabla) {
    $(id_trTabla).mouseover(function(){
        $(this).css('cursor', 'pointer');   
    });
}

//Obtiene los datos del proveedor al hacer doble click en una fila de la tabla y los muestra donde indica el parámetro contenedor
function ObtenerProveedor(id_tabla, table, id_cuentaPersonal, contenedor) {
    $(id_tabla).on('dblclick', 'tr', function() {
        var data = table.DataTable().row( this ).data();
        $(id_cuentaPersonal).val(data[0]);
        if ($(contenedor).children().length == 0) {
            var nombre = '<div class="row"><div class="col-xs-12" id="nombre"><strong>'+data[1]+" "+data[2]+" "+data[3]+'</strong></div></div>';
            var dSocial = '<div class="row"><div class="col-xs-12" id="denominacionSocial"><strong>'+data[4]+'</strong></div></div>';
            var nifCif = '<div class="row"><div class="col-xs-12" id="nifCif"><strong>'+data[5]+'</strong></div></div>';
            $(contenedor).append(nombre).append(dSocial).append(nifCif);
        }else{
            $('#nombre > strong').empty();
            $('#denominacionSocial > strong').empty();
            $('#nifCif > strong').empty();
            $('#nombre > strong').html(data[1] + " "+ data[2] + " " + data[3]);
            $('#denominacionSocial > strong').html(data[4]);
            $('#nifCif > strong').html(data[5]);
        }
    });    
}

//Convertir la Cuenta Personal en Proveedor
function ConvertirCuentaEnProveedor(id_tabla, url3, url4, url5, id_cuentaPersonal) {
    $(id_tabla).on('dblclick', 'tr', function() {
        nCuenta = $(this).find('td').eq(0).html();
        nombre = $(this).find('td').eq(1).html();
        ape1 = $(this).find('td').eq(2).html();
        ape2 = $(this).find('td').eq(3).html();
        dsocial = $(this).find('td').eq(4).html();
        nifCif = $(this).find('td').eq(5).html();
        alertas(url3, url4, url5, id_cuentaPersonal);
    });
}

//Hace uso del plugin jquery alertify para convertir la cuenta personal en Proveedor
function alertas(url3, url4, url5, id_cuentaPersonal) {
    $.ajax({
        data: {'cpersonal': nCuenta},
        url: url3,
        type:'post',
        success: function(response) {
            if (response == true) {
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.defaults.theme.input = "form-control";
                alertify.alert('¡¡ATENCIÓN!!', nCuenta+ " - "+nombre+ " "+ape1+ " "+ape2+ " "+dsocial+ " - "+nifCif+ "  "+'ya es Proveedor');        
            }else{
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.defaults.theme.input = "form-control";
                alertify.confirm('¡¡ATENCIÓN!!', nCuenta+ " - "+nombre+ " "+ape1+ " "+ape2+ " "+dsocial+ " - "+nifCif+ "  "+'pasará a ser también Proveedor', function(){
                    $.ajax({
                        data: {'cpersonal': nCuenta},
                        url: url4,
                        type: 'post',
                        success: function(){
                            $.ajax({
                                type: 'get',
                                url: url5,
                                datatype: "html",
                                success: function(response){
                                    $('#grid1').html(response);
                                    TablaDataTable('#tabla_proveedores');
                                    $('#grid1').css('background-color', '#dbddd4');
                                    CambiarCursorTabla('#tabla_proveedores tr');
                                    ObtenerProveedor('#tabla_proveedores tbody', $('#tabla_proveedores'), id_cuentaPersonal, 'div#cpers');
                                },
                            });   
                        },
                    });  
                }, function(){});
            };
        },
    });    
}