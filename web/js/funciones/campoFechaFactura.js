//COMPROBAR EJERCICIO CONTABLE AL INTRODUCIR FECHA FACTURA

function campoFechaFactura(id_FechaFactura, url, id_aceptar) {
    $(id_FechaFactura).on('focusout', function(){
        fechaFactura = $(this).val();
        año = fechaFactura.substr(fechaFactura.length-4, fechaFactura.length);
        $.ajax({
            data: {'ejerc': año},
            type: 'get',
            url: url,
            success: function(response){
                switch (response) {
                    case "1": //El ejercicio contable existe y está cerrado
                        $(id_aceptar).prop('disabled', true);
                        alertify.defaults.transition = "slide";
                        alertify.defaults.theme.ok = "btn btn-primary";
                        alertify.defaults.theme.cancel = "btn btn-danger";
                        alertify.defaults.theme.input = "form-control";
                        alertify.alert('¡¡ATENCIÓN!!', 'EL EJERCICIO DE LA FECHA ELEGIDA ESTÁ CERRADO');
                        break;
                    case "2": //El ejercicio contable existe y no está cerrado
                        $(id_aceptar).prop('disabled', false);  
                        break;
                    default: //El ejercicio contable no existe
                        $(id_aceptar).prop('disabled', false);  
                };
            },
        });   
    });

}