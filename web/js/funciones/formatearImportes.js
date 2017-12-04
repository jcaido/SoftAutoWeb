/** FORMATEAR LOS CAMPOS IMPORTES ANTES DE ENVIAR EL FORMULARIO **/


function formatearImportes(id_form) {
    $(id_form).submit(function(){
        $('input[id$="importe"]').each(function(){
            a = $(this).val();
            b = a.replace(/\./g,'').replace(/\,/g,'.');
            $(this).val(b);
        });  
    });    
}