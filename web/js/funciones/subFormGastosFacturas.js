/** FUNCIONALIDADES PARA LOS SUBFORMULARIOS GASTOS CON FACTURA **/


function subFormVehiculos(id_input, id_aceptar, id_divSubform) {
    collection = $('div.Vehiculos_min');
    collection.data('index1', collection.find(':input').length);
    addForm1(id_input, id_aceptar);
    $('div.Vehiculos_min label').empty();
    $(id_divSubform).attr('style', 'display:inline-block');
    $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus();
    $(id_aceptar).attr('disabled', 'disabled');
    pulsarTeclaInputSubformularioVehiculos(id_input, id_aceptar);
    agregarSubFormVehiculos(id_aceptar, id_input, id_divSubform);
}

function addForm1(id_input, id_aceptar) {
    prototype = collection.data('prototype');
    index1 = collection.data('index1');
    newForm = prototype.replace(/__name__/g, index1);
    collection.data('index1', index1 + 1);
    $newForm1 = $('<div clas="row"></div>').append(newForm);
    collection.append($newForm1);
    $('div.Vehiculos_min > div:last-child > div input[id$="importe"]').on('keyup', function(e){
        e.preventDefault();
        importe_total = 0
        $('input[id$="importe"]').each(
            function(index, value){
                if ($(this).val().length != 0) {
                    importe_total = importe_total + parseFloat($(this).val().replace(/\./g,'').replace(/\,/g,'.'));
                }    
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
    $('input[id$="importe"]').mask("#.##0,00", {reverse: true});
    pulsarTeclaInputSubformularioVehiculos(id_input, id_aceptar);
}

function pulsarTeclaInputSubformularioVehiculos(id_input, id_aceptar) {
    $(id_input).on('keyup', function(){
        camposRellenados = true;
        $(id_input).each(function(){
            if ($(this).val() == "") {
                camposRellenados = false;
                return false;
            }
        });
        if (camposRellenados == false) {
            $(id_aceptar).prop('disabled', true);
        }else{
            $(id_aceptar).prop('disabled', false);
        };
    });
}

function agregarSubFormVehiculos(id_aceptar, id_input, id_divSubForm) {
    $('#add').on('click', function() {
        $(id_aceptar).attr('disabled', 'disabled');
        if ($('div.Vehiculos_min > div').length == 1) {
            $('#no_agregar_vehiculo').remove();
            $marca = $('div.Vehiculos_min > div:last-child input[id$="marca"]');
            $modelo = $('div.Vehiculos_min > div:last-child input[id$="modelo"]');
            $matricula = $('div.Vehiculos_min > div:last-child input[id$="matricula"]');
            $importe = $('div.Vehiculos_min > div:last-child input[id$="importe"]');
            if ($marca.val() == "" || $modelo.val() == "" || $matricula.val() == "" || $importe.val() == "") {
                $('#no_agregar_vehiculo').remove();
                $('div.Vehiculos_min > div:last-child').append('<div id="no_agregar_vehiculo"><strong>Debe introducir todos los datos requeridos</strong></div>');
                $('div.Vehiculos_min').animate({ scrollTop: $('div.Vehiculos_min')[0].scrollHeight}, 1000);
                $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus();
            }else{
                icono = '<a id="remove_vehiculos" href="#"><img src="/images/delete.png" height="16" width="16"/></a>';
                $('legend.scheduler-border.Vehiculos').css('width', '20%');
                $('.Vehiculos').append(icono);
                $('#remove_vehiculos').on('click', function() { // click en el icono -
                    $('div.Vehiculos_min > div:last-child').remove();
                    $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus();
                    if ($('div.Vehiculos_min > div').length == 1) {
                        $('legend.scheduler-border.Vehiculos > a:last-child').remove();
                        $('legend.scheduler-border.Vehiculos').css('width', '18%');
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
                    }else{
                        $(id_aceptar).prop('disabled', false);
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
                $('#no_agregar_vehiculo').remove();
                addForm1(id_input, id_aceptar);
                $('div.Vehiculos_min label').empty();
                $(id_divSubForm).attr('style', 'display:inline-block');
                $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus(); 
            }
        }else{
            $('#no_agregar_vehiculo').remove();
            camposRellenados = true;
            $(id_input).each(function(){
                if ($(this).val() == "") {
                    camposRellenados = false;
                    return false;
                }
            });
            if (camposRellenados == false) {
                $('#no_agregar_vehiculo').remove();
                $('div.Vehiculos_min > div:last-child').append('<div id="no_agregar_vehiculo"><strong>Debe introducir todos los datos requeridos</strong></div>');
                $('div.Vehiculos_min').animate({ scrollTop: $('div.Vehiculos_min')[0].scrollHeight}, 1000);
                $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus();
            }else{
                $('#no_agregar_vehiculo').remove();
                addForm1(id_input, id_aceptar);
                $('div.Vehiculos_min label').empty();
                $(id_divSubForm).attr('style', 'display:inline-block');
                $('div.Vehiculos_min > div:last-child input[id$="marca"]').focus();
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

