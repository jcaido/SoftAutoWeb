/** FUNCIONALIDAD PARA EL CAMPO CUENTA PERSONAL DE LOS FORMULARIOS PARA INTRODUCIR FACTURAS **/


function campoCuentaPersonal(id_cuentaPersonal, url1, url2, id_input, id_compras) {
    perderFocoCtaPersonal(id_cuentaPersonal, url1, url2);
    deshabilitarSubmit(id_cuentaPersonal, url1, id_input, id_compras);
}

function perderFocoCtaPersonal(id_cuentaPersonal, url1, url2) {
    $(id_cuentaPersonal).on('focusout', function(e){
        e.preventDefault();
        cpersonal = $(this).val();
        if ($(this).val().length >= 1) {
            $.ajax({
                data: {'cpersonal': cpersonal},
                url:url1,
                type:'post',
                success: function(response) {
                    buscarCPers(url2);       
                },
            });  
        }else{
            $('#cpers').empty();    
        }
    });
}

function buscarCPers(url2) {
    $.ajax({
        data: {'cpersonal': cpersonal},
        url: url2,
        type: 'post',
        dataType: 'html',
        success: function(response){
            $('#cpers').html(response);
        },    
    });
}

function deshabilitarSubmit(id_cuentaPersonal, url1, id_input, id_compras) {
    $(id_cuentaPersonal).on('keyup', function(e){
        e.preventDefault();
        cpersonal = $(this).val();
        $.ajax({
            data: {'cpersonal': cpersonal},
            url: url1,
            type:'post',
            success: function(response) {
                if (response != 0) {
                    if ($(id_input).val() == "") {
                        $(id_compras).prop('disabled', true);     
                    }else{
                        $(id_compras).prop('disabled', false);
                    }   
                }else{
                    $(id_compras).prop('disabled', true);    
                }    
            },
        });
    });
}