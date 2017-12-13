/** FUNCIONALIDADES PARA LOS SUBFORMULARIOS GASTOS CON FACTURA **/


function subFormGastosFacturas(id_input, id_aceptar, id_divSubform, enlace, marcador, id_cuentaContable, url1, url2) {
    collection = $('div.Gastos_min');
    collection.data('index1', collection.find(':input').length);
    addForm1(id_input, id_aceptar, id_cuentaContable, url1, url2 );
    $('div.Gastos_min label').empty();
    $('div[id^="GastosFacturas_gastoGastosFacturas"] > div:first-child > label').each(function(){
        $(this).html('IRPF');
    })
    $('label[for="GastosFacturas_tipoIRPF"]').hide();
    $(id_divSubform).attr('style', 'display:inline-block');
    $(id_aceptar).attr('disabled', 'disabled');
    $('#calcular').hide();
    pulsarTeclaInputSubformularioGastos(id_input, id_aceptar);
    agregarSubFormGastosFacturas(id_aceptar, id_input, id_divSubform, id_cuentaContable, url1, url2);
    importe = 0;
    $('#base_Retencion').val(importe.toFixed(2).replace(/\./g,','));
    $('#tipo_Retencion').val(0+"%");
    $('#Retencion_IRPF').val(importe.toFixed(2).replace(/\./g,','));
    $('#total_Factura').val(importe.toFixed(2).replace(/\./g,','));
    $(enlace).click(function(e) {
        e.preventDefault();
        tablaIVA(marcador);
        RetencionIRPF(marcador);
        $('#total_Factura').val(numberFormat(calcularTotalFactura(marcador).toFixed(2).replace(/\./g,',')));
    });
    campoCuentaContable(id_cuentaContable, url1, url2);
}

function addForm1(id_input, id_aceptar, id_cuentaContable, url1, url2) {
    prototype = collection.data('prototype');
    index1 = collection.data('index1');
    newForm = prototype.replace(/__name__/g, index1);
    collection.data('index1', index1 + 1);
    $newForm1 = $('<div clas="row"></div>').append(newForm);
    collection.append($newForm1);
    $('input[id$="importe"]').mask("#.##0,00", {reverse: true});
    pulsarTeclaInputSubformularioGastos(id_input, id_aceptar);
    campoCuentaContable(id_cuentaContable, url1, url2);
}

function pulsarTeclaInputSubformularioGastos(id_input, id_aceptar) {
    $(id_input).on('keyup', function(){
        camposRellenados = true;
        $(id_input).each(function(){
            if ($(this).is("[type=text")) {
                if ($(this).val() == "") {
                    camposRellenados = false;
                    return false;
                }
            }    
        });
        if (camposRellenados == false) {
            $(id_aceptar).prop('disabled', true);
            $('#calcular').hide();
        }else{
            $(id_aceptar).prop('disabled', false);
            $('#calcular').show();
        };
    });
}

function agregarSubFormGastosFacturas(id_aceptar, id_input, id_divSubForm, id_cuentaContable, url1, url2) {
    $('#add').on('click', function() {
        $(id_aceptar).attr('disabled', 'disabled');
        $('#calcular').hide();
        if ($('div.Gastos_min > div').length == 1) {
            $('#no_agregar_gasto').remove();
            $ctaContable = $('div.Gastos_min > div:last-child input[id$="ctaContable"]');
            $concepto = $('div.Gastos_min > div:last-child input[id$="concepto"]');
            $importe = $('div.Gastos_min > div:last-child input[id$="importe"]');
            if ($ctaContable.val() == "" || $concepto.val() == "" || $importe.val() == "") {
                $('#no_agregar_gasto').remove();
                $('div.Gastos_min > div:last-child').append('<div id="no_agregar_gasto"><strong>Debe introducir todos los datos requeridos</strong></div>');
                $('div.Gastos_min').animate({ scrollTop: $('div.Gastos_min')[0].scrollHeight}, 1000);
                $('div.Gastos_min > div:last-child input[id$="ctaContable"]').focus();
            }else{
                icono = '<a id="remove_gasto" href="#"><img src="/images/delete.png" height="16" width="16"/></a>';
                $('legend.scheduler-border.Gastos').css('width', '20%');
                $('.Gastos').append(icono);
                $('#remove_gasto').on('click', function() { // click en el icono -
                    $('div.Gastos_min > div:last-child').remove();
                    $('div.Gastos_min > div:last-child input[id$="ctaContable"]').focus();
                    if ($('div.Gastos_min > div').length == 1) {
                        $('legend.scheduler-border.Gastos > a:last-child').remove();
                        $('legend.scheduler-border.Gastos').css('width', '18%');
                    }
                    camposRellenados = true;
                    $(id_input).each(function(){
                        if ($(this).val() == "") {
                            camposRellenados = false;
                            return false;
                        }
                    });
                    if (camposRellenados == false) {
                        $(id_aceptar).prop('disabled', true);
                        $('#calcular').show();
                    }else{
                        $(id_aceptar).prop('disabled', false);
                        $('#calcular').hide();
                    }
                    importe_total= 0
                    $('input[id$="importe"]').each(
                        function(index, value){
                            importe_total = importe_total + parseFloat($(this).val().replace(/\./g,'').replace(/\,/g,'.'));
                    });
                    if (isNaN(importe_total)) {
                        $('#total_Factura').val("");
                    }else{
                        $('#total_Factura').val(importe_total.toFixed(2));
                        formato_numero_coma = $('#total_Factura').val().replace(/\./g,',');
                        formato_numero_miles = numberFormat(formato_numero_coma);
                        $('#total_Factura').val(formato_numero_miles);
                    }
                });
                $('#no_agregar_gasto').remove();
                addForm1(id_input, id_aceptar, id_cuentaContable, url1, url2);
                $('div.Gastos_min label').empty();
                $('div[id^="GastosFacturas_gastoGastosFacturas"] > div:first-child > label').each(function(){
                    $(this).html('IRPF');
                });
                $(id_divSubForm).attr('style', 'display:inline-block');
                $('div.Gastos_min > div:last-child input[id$="ctaContable"]').focus(); 
            }
        }else{
            $('#no_agregar_gasto').remove();
            camposRellenados = true;
            $(id_input).each(function(){
                if ($(this).val() == "") {
                    camposRellenados = false;
                    return false;
                }
            });
            if (camposRellenados == false) {
                $('#no_agregar_gasto').remove();
                $('div.Gastos_min > div:last-child').append('<div id="no_agregar_gasto"><strong>Debe introducir todos los datos requeridos</strong></div>');
                $('div.Gastos_min').animate({ scrollTop: $('div.Gastos_min')[0].scrollHeight}, 1000);
                $('div.Gastos_min > div:last-child input[id$="ctaContable"]').focus();
            }else{
                $('#no_agregar_gasto').remove();
                addForm1(id_input, id_aceptar, id_cuentaContable, url1, url2);
                $('div.Gastos_min label').empty();
                $('div[id^="GastosFacturas_gastoGastosFacturas"] > div:first-child > label').each(function(){
                    $(this).html('IRPF');
                });
                $(id_divSubForm).attr('style', 'display:inline-block');
                $('div.Gastos_min > div:last-child input[id$="ctaContable"]').focus();
            } 
        }
    });
}

function numberFormat(numero){
    /**
    * Funcion que devuelve un numero separando los separadores de miles
    * Puede recibir valores negativos y con decimales
    */
    
    // Variable que contendra el resultado final
    var resultado = "";
    // Si el numero empieza por el valor "-" (numero negativo)
    if(numero[0]=="-"){
        // Cogemos el numero eliminando los posibles puntos que tenga, y sin
        // el signo negativo
        nuevoNumero=numero.replace(/\./g,'').substring(1);
    }else{
        // Cogemos el numero eliminando los posibles puntos que tenga
        nuevoNumero=numero.replace(/\./g,'');
    }
    // Si tiene decimales, se los quitamos al numero
    if(numero.indexOf(",")>=0)
        nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf(","));
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;
            // Si tiene decimales, se lo añadimos al numero una vez forateado con 
            // los separadores de miles
            if(numero.indexOf(",")>=0)
                resultado+=numero.substring(numero.indexOf(","));
            if(numero[0]=="-") {
                // Devolvemos el valor añadiendo al inicio el signo negativo
                return "-"+resultado;
            }else{
                return resultado;
            }
}

function crearArrayPorcentajesIVA(marcador) {

    var PorcentajesIVA = [];

    $(marcador).each(function() {

        var porcentaje = $(this).find('select[id^="GastosFacturas"]').val();
        
        if (!PorcentajesIVA.includes(porcentaje)) {
            PorcentajesIVA.push(porcentaje);
        }

    });

    return(PorcentajesIVA);

}

function tablaIVA(marcador) {

    $('table#resumen_iva tbody').empty();

    PorcentajesIVA = crearArrayPorcentajesIVA(marcador);
    
    PorcentajesIVA.forEach(function(porcentaje, indice, array) {

        base = 0;
        $(marcador).each(function() {

            porc = $(this).find('select[id^="GastosFacturas"]').val();
            importe = parseFloat($(this).find('input[id$="importe"]').val().replace(/\./g,'').replace(/\,/g,'.'));
            
            if (porc == porcentaje) {
                base = base + importe;
                cuota = (base*porcentaje)/100;
            }

        });

        baseFormato = numberFormat(base.toFixed(2).replace(/\./g,','));
        cuotaFormato = numberFormat(cuota.toFixed(2).replace(/\./g,','));
        
        $fila = "<tr><td class='imp'>"+baseFormato+"</td><td>"+porcentaje+"%</td><td class='imp'>"+cuotaFormato+"</td></tr>",
        $('table#resumen_iva tbody').append($fila);

    })

}

function RetencionIRPF(marcador) {

    BaseRetencion = 0;

    $(marcador).each(function() {

        importe = parseFloat($(this).find('input[id$="importe"]').val().replace(/\./g,'').replace(/\,/g,'.'));

        if ($(this).find('input[id$="retencion"]:checked').val() == 1) {
            BaseRetencion = BaseRetencion + importe;
        }

    });

    BaseRetencionFormato = numberFormat(BaseRetencion.toFixed(2).replace(/\./g,','));
    $('#base_Retencion').val(BaseRetencionFormato);
    $('#tipo_Retencion').val($('select[id="GastosFacturas_tipoIRPF"]').val() + "%");
    tipo = parseInt($('select[id="GastosFacturas_tipoIRPF"]').val());
    RetencionIRPFFormato = numberFormat(((BaseRetencion*tipo)/100).toFixed(2).replace(/\./g,','));
    $('#Retencion_IRPF').val(RetencionIRPFFormato);

}

function calcularIVA(marcador) {

    CuotaIVA = 0;

    $(marcador).each(function() {

        porc = $(this).find('select[id^="GastosFacturas"]').val();
        importe = parseFloat($(this).find('input[id$="importe"]').val().replace(/\./g,'').replace(/\,/g,'.'));

        CuotaIVA = CuotaIVA + ((importe*porc)/100);

    });

    return CuotaIVA;

}

function calcularRetencionIRPF(marcador) {

    BaseRetencion = 0;

    $(marcador).each(function() {

        importe = parseFloat($(this).find('input[id$="importe"]').val().replace(/\./g,'').replace(/\,/g,'.'));

        if ($(this).find('input[id$="retencion"]:checked').val() == 1) {
            BaseRetencion = BaseRetencion + importe;
        }   

    })

    tipo = parseInt($('#tipo_Retencion').val());
    RetIRPF = (BaseRetencion * tipo)/100;

    return RetIRPF;

}

function calcularTotalFactura(marcador) {

    importeGasto = 0;

    $(marcador).each(function() {

        importeGasto = importeGasto + parseFloat($(this).find('input[id$="importe"]').val().replace(/\./g,'').replace(/\,/g,'.'));

    })

    cuotaIVA = calcularIVA(marcador);
    RIRPF = calcularRetencionIRPF(marcador);

    totalFactura = importeGasto + cuotaIVA - RIRPF;
    

    return totalFactura;

}

function campoCuentaContable(id_cuentaContable, url1, url2) {

    perderFocoCtaContable(id_cuentaContable, url1, url2);

}

function perderFocoCtaContable(id_cuentaContable, url1, url2) {

    $(id_cuentaContable).on('focusout', function(e){
        e.preventDefault();
        ccontable = $(this).val();
        if ($(this).val().length >= 1) {
            $.ajax({
                data: {'ccontable': ccontable},
                url:url1,
                type:'post',
                success: function(response) {
                    buscarCCont(url2);       
                },
            });  
        }else{
            $('#ccont').empty();    
        }
    });

}

function buscarCCont(url2) {

    $.ajax({
        data: {'ccontable': ccontable},
        url: url2,
        type: 'post',
        dataType: 'html',
        success: function(response){
            $('#ccont').html(response);
        },    
    });

}

