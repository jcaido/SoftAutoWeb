/** TOTAL AUTOFACTURAS DE COMPRA DE VEHICULOS EN REBU **/


function totalRebuAutoFacturas() {
    $('input[id$="importe"]').on('keyup', function(e){
        e.preventDefault();
        importe = parseFloat($(this).val().replace(/\./g,'').replace(/\,/g,'.'));
        if (isNaN(importe)) {
            $('#total_Factura').val("");
        }else{
            $('#total_Factura').val(importe.toFixed(2));
            formato_numero_coma = $('#total_Factura').val().replace(/\./g,',');
            formato_numero_miles = numberFormat(formato_numero_coma);
            $('#total_Factura').val(formato_numero_miles);
        }
    });    
}

