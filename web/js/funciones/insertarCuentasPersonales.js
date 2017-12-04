/** FUNCIONES DEL FORMULARIO PARA INSERTAR CUENTAS PERSONALES **/


function checkboxLOPD_LSI(checkbox1, checkbox2, checkbox3, fecha1, fecha2, fecha3) {
    inicializarCheckboxLOPD_LSI(checkbox1, fecha1, fecha2, fecha3);
    inicializarCheckboxLOPD_LSI(checkbox2, fecha1, fecha2, fecha3);
    inicializarCheckboxLOPD_LSI(checkbox3, fecha1, fecha2, fecha3);
    clickCheckboxLOPD_LSI(checkbox1, fecha1);
    clickCheckboxLOPD_LSI(checkbox2, fecha2);
    clickCheckboxLOPD_LSI(checkbox3, fecha3);
}

function inicializarCheckboxLOPD_LSI(checkbox, fecha1, fecha2, fecha3) {
    $(checkbox).prop('checked', false);
    $(fecha1).val('');
    $(fecha2).val('');
    $(fecha3).val('');
    $(fecha1).attr('disabled', true);
    $(fecha2).attr('disabled', true);
    $(fecha3).attr('disabled', true);
}

function clickCheckboxLOPD_LSI(checkbox, fecha) {
    $(checkbox).click(function(){
        if ( $(checkbox + ':checked').val() == 1) {
            $(fecha).attr('disabled', false);
            $(fecha).val(ObtenerFechaActual());
        } else{
            $(fecha).val('');
            $(fecha).attr('disabled', true);
        }    
    });
}

function insertarTablaCodigosPostales(url, id_tabla) {
    $.ajax({
        type: 'get',
        url: url,
        datatype: "html",
        success: function(response) {
            $('#codigosPostales').html(response);
            TablaDataTable(id_tabla);
        }
    });
}

function dialogosLOPD_LSI(id_informacion, texto) {
    $(id_informacion).click(function(e){
        e.preventDefault();
        CWdialog(texto);
    });
}

function tabulacionConIntro(id_input) {
    $(id_input).keydown(function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            if ($('#cuentasPersonales_personaFisica').prop('checked')) {
                //borramos atributos tabindex de todos los inputs
                $('#cuentasPersonales_nombre').removeAttr('tabindex');
                $('#cuentasPersonales_primerApellido').removeAttr('tabindex');
                $('#cuentasPersonales_segundoApellido').removeAttr('tabindex');
                $('#cuentasPersonales_direccion').removeAttr('tabindex');
                $('#cuentasPersonales_cp').removeAttr('tabindex');
                $('#cuentasPersonales_nifCif').removeAttr('tabindex');
                $('#cuentasPersonales_email').removeAttr('tabindex');
                $('#cuentasPersonales_denominacionSocial').removeAttr('tabindex');
                //Asignamos los atributos tabindex correspondientes
                $('#cuentasPersonales_nombre').attr('tabindex', 1);
                $('#cuentasPersonales_primerApellido').attr('tabindex', 2);
                $('#cuentasPersonales_segundoApellido').attr('tabindex', 3);
                $('#cuentasPersonales_direccion').attr('tabindex', 6);
                $('#cuentasPersonales_cp').attr('tabindex', 7);
                $('#cuentasPersonales_nifCif').attr('tabindex', 4);
                $('#cuentasPersonales_email').attr('tabindex', 5);
                cb = parseInt($(this).attr('tabindex'));
                tabular('#cuentasPersonales_nombre', cb);
            }else{
                //borramos atributos tabindex de todos los inputs
                $('#cuentasPersonales_nombre').removeAttr('tabindex');
                $('#cuentasPersonales_primerApellido').removeAttr('tabindex');
                $('#cuentasPersonales_segundoApellido').removeAttr('tabindex');
                $('#cuentasPersonales_direccion').removeAttr('tabindex');
                $('#cuentasPersonales_cp').removeAttr('tabindex');
                $('#cuentasPersonales_nifCif').removeAttr('tabindex');
                $('#cuentasPersonales_email').removeAttr('tabindex');
                $('#cuentasPersonales_denominacionSocial').removeAttr('tabindex');
                //Asignamos los atributos tabindex correspondientes
                $('#cuentasPersonales_denominacionSocial').attr('tabindex', 1);
                $('#cuentasPersonales_direccion').attr('tabindex', 4);
                $('#cuentasPersonales_cp').attr('tabindex', 5);
                $('#cuentasPersonales_nifCif').attr('tabindex', 2);
                $('#cuentasPersonales_email').attr('tabindex', 3);
                cb = parseInt($(this).attr('tabindex'));
                tabular('#cuentasPersonales_denominacionSocial', cb);
            }
        }    
    });
}

function tabular(id_foco, index) {
    if ($(':input[tabindex=\'' + (index + 1) + '\']').length) {
        $(':input[tabindex=\'' + (index + 1) + '\']').focus();
        $(':input[tabindex=\'' + (index + 1) + '\']').select();
    }else{
        $(id_foco).focus();    
    }
}

function campoCodigoPostal(url1, url2, url3) {
    $('#cuentasPersonales_cp').focusout(function(e) {
        e.preventDefault();
        if (!$('#cuentasPersonales_cp').is('[readonly]')) {
            cpostal = $(this).val();
            if ($(this).val().length >= 1) {
                $.ajax({
                    data: {'cpost': cpostal},
                    url: url1,
                    type:'post',
                    success: function(response) {
                        if (response != 0) {
                            $('#cp').html('<div class="imagen_ajax1"><img src="/images/loading.gif"/></div>');
                            $.ajax({
                                data: {'cpost': cpostal},
                                url: url2,
                                type: 'post',
                                dataType: 'html',
                                success: function(response) {
                                    $('#cp').fadeIn(1000).html(response);
                                }
                            });
                        }else{
                            $('#cuentasPersonales_cp').attr('readonly', true);
                            $('#cp').html('<div class="imagen_ajax1"><img src="/images/loading.gif"/></div>');
                            $.ajax({
                                data: {'cpost': cpostal},
                                url: url2,
                                type: 'post',
                                dataType: 'html',
                                success: function(response) {
                                    $('#cp').fadeIn(1000).html(response);
                                    $('#codigosPostales').empty();
                                    //Insertar formulario para alta de códigos postales
                                    $('#codigosPostales').html('<div class="imagen_ajax2"><img src="/images/loading.gif"/></div>');
                                    $.ajax({
                                        type:'get',
                                        url: url3,
                                        datatype: "html",
                                        success: function(response) {
                                            $('#codigosPostales').fadeIn(1000).html(response);
                                            var codigoPost = $('#cuentasPersonales_cp').val();
                                            $('#codigosPostales_cp').val(codigoPost);
                                            $('#codigosPostales_cp').attr('readonly', true);
                                            $('#codigosPostales_localidad').focus();
                                            $('#cuentasPersonales_nombre').attr('readonly', true);
                                            $('#cuentasPersonales_primerApellido').attr('readonly', true);
                                            $('#cuentasPersonales_segundoApellido').attr('readonly', true);
                                            $('#cuentasPersonales_denominacionSocial').attr('readonly', true);
                                            $('#cuentasPersonales_nifCif').attr('readonly', true);
                                            $('#cuentasPersonales_email').attr('readonly', true);
                                            $('#cuentasPersonales_direccion').attr('readonly', true);
                                            $('#cuentasPersonales_cliente').attr('disabled', true);
                                            $('#cuentasPersonales_proveedor').attr('disabled', true);
                                            $('#cuentasPersonales_rcdp').attr('disabled', true);
                                            $('#cuentasPersonales_personaFisica').attr('disabled', true);
                                            $('#cuentasPersonales_revccd').attr('disabled', true);
                                            $('#cuentasPersonales_atdp').attr('disabled', true);
                                            $('#cuentasPersonales_aecc').attr('disabled', true);
                                            $('#cuentasPersonales_acdp').attr('disabled', true);
                                            $('#cuentasPersonales_ccpLlt').attr('disabled', true);
                                            $('#cuentasPersonales_rdp').attr('disabled', true);
                                            $('#cuentasPersonales_ccpMm').attr('disabled', true);
                                            $('#cuentasPersonales_rectccd').attr('disabled', true);
                                            $('#cuentasPersonales_ccpRs').attr('disabled', true);
                                            $('#cuentasPersonales_ccpVa').attr('disabled', true);
                                            $('#cuentasPersonales_racc').attr('disabled', true);
                                            $('#cuentasPersonales_racd').attr('disabled', true);
                                            $('#cuentasPersonales_ccpCp').attr('disabled', true);
                                            $('#cuentasPersonales_ccpEmail').attr('disabled', true);
                                            $('#cuentasPersonales_ccpFax').attr('disabled', true);
                                            $('#cuentasPersonales_fechaRdp').attr('disabled', true);
                                            $('#cuentasPersonales_fechaRcdp').attr('disabled', true);
                                            $('#cuentasPersonales_fechaRacc').attr('disabled', true);
                                            $('#cuentasPersonales_aceptar').attr('disabled', true);
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            }else{
                $('#cp').empty();    
            }
        }
    });
}

function checkboxPersonaFisica() {
    $('#cuentasPersonales_personaFisica').prop('checked', true);
    if ($('#cuentasPersonales_personaFisica:checked').val() == 1) {
        $('#cuentasPersonales_denominacionSocial').attr('disabled', true);
        $('#cuentasPersonales_nombre').attr('disabled', false);
        $('#cuentasPersonales_primerApellido').attr('disabled', false);
        $('#cuentasPersonales_segundoApellido').attr('disabled', false);
        $('#cp').empty();
    }else{
        $('#cuentasPersonales_denominacionSocial').attr('disabled', false);
        $('#cuentasPersonales_nombre').attr('disabled', true);
        $('#cuentasPersonales_primerApellido').attr('disabled', true);
        $('#cuentasPersonales_segundoApellido').attr('disabled', true);
        $('#cp').empty();
    }
    $('#cuentasPersonales_personaFisica').change(function() {
        if ($('#cuentasPersonales_personaFisica:checked').val() == 1) {
            $('#cp').empty();
            $('#cuentasPersonales_denominacionSocial').attr('disabled', true);
            $('#cuentasPersonales_nombre').attr('disabled', false);
            $('#cuentasPersonales_primerApellido').attr('disabled', false);
            $('#cuentasPersonales_segundoApellido').attr('disabled', false);
            $('#cuentasPersonales_denominacionSocial').val('');
            $('#cuentasPersonales_nifCif').val('');
            $('#cuentasPersonales_email').val('');
            $('#cuentasPersonales_direccion').val('');
            $('#cuentasPersonales_cp').val('');
            $('#cuentasPersonales_nombre').focus();    
        }else{
            $('#cp').empty();
            $('#cuentasPersonales_denominacionSocial').attr('disabled', false);
            $('#cuentasPersonales_nombre').attr('disabled', true);
            $('#cuentasPersonales_primerApellido').attr('disabled', true);
            $('#cuentasPersonales_segundoApellido').attr('disabled', true);
            $('#cuentasPersonales_nombre').val('');
            $('#cuentasPersonales_primerApellido').val('');
            $('#cuentasPersonales_segundoApellido').val('');
            $('#cuentasPersonales_nifCif').val('');
            $('#cuentasPersonales_email').val('');
            $('#cuentasPersonales_direccion').val('');
            $('#cuentasPersonales_cp').val('');
            $('#cuentasPersonales_denominacionSocial').focus();
        }    
    });
}

function SubFormDatosTelefonicos() {
    collection = $('div.datosTelefonicos_min');
    collection.data('index1', collection.find(':input').length);
    agregarSubFormDatosTelefonicos(collection);
    
}

function agregarSubFormDatosTelefonicos(collection) {
    $('#add_datosTelefonicos').on('click', function(e) {
        e.preventDefault();
        $('#cuentasPersonales_aceptar').attr('disabled', 'disabled');
        if (!$('div.datosTelefonicos_min div').length) {
            $('div.datosTelefonicos_min').empty();
            var icono = '<a id="remove_datosTelefonicos" href="#"><img src="/images/delete.png" height="16" width="16"/></a>';
            $('legend.scheduler-border.Dt').css('width', '50%');
            $('.Dt').append(icono);
            $('#remove_datosTelefonicos').on('click', function(e) {
                e.preventDefault();
                if ($('div.datosTelefonicos_min > div').length) {
                    $('div.datosTelefonicos_min > div:last-child').remove();
                    $('div.datosTelefonicos_min > div:last-child input[id$="telefono"]').focus();
                    if ($('div.datosTelefonicos_min > div').length == 0) {
                        $('legend.scheduler-border.Dt > a:last-child').remove();
                        $('legend.scheduler-border.Dt').css('width', '43%');
                        $('div.datosTelefonicos_min').append('<img src="/images/Telefono.png" height="100" width="100"/>');
                    }
                    $('input[id$="telefono"]').each(function(){
                        if ($(this).val() == "") {
                            camposRellenados = false;
                            return false;
                        }else{
                            camposRellenados = true;
                        }
                    });
                    if (camposRellenados == false) {
                        $('#cuentasPersonales_aceptar').prop('disabled', true);
                    }else{
                        $('#cuentasPersonales_aceptar').prop('disabled', false);
                    }
                }
            });
            $('#no_agregar_tfo').remove();
            addTelefonoForm1(collection);
            $('div.datosTelefonicos_min label').empty();
            $('div[id^="cuentasPersonales_datosTelefonicos"] div').attr('style', 'display:inline-block');
            $('div.datosTelefonicos_min > div:last-child input[id$="telefono"]').focus();
        }else{
            if ($('div.datosTelefonicos_min > div:last-child input[id$="telefono"]').val() != "") {
                $('#no_agregar_tfo').remove();
                addTelefonoForm1(collection);
                $('div.datosTelefonicos_min label').empty();
                $('div[id^="cuentasPersonales_datosTelefonicos"] div').attr('style', 'display:inline-block');
                $('div.datosTelefonicos_min > div:last-child input[id$="telefono"]').focus();    
            }else{
                $('#no_agregar_tfo').remove();
                $('div.datosTelefonicos_min > div:last-child').append('<div id="no_agregar_tfo"><strong>Introduzca un nº de teléfno antes de agregar una nueva línea</strong></div>');
                $('div.datosTelefonicos_min').animate({ scrollTop: $('div.datosTelefonicos_min')[0].scrollHeight}, 1000);
                $('div.datosTelefonicos_min > div:last-child input[id$="telefono"]').focus();
            }    
        }
    });
}

function addTelefonoForm1(collection) {
    var prototype = collection.data('prototype');
    var index1 = collection.data('index1');
    var newForm = prototype.replace(/__name__/g, index1);
    collection.data('index1', index1 + 1);
    var $newForm1 = $('<div clas="row"></div>').append(newForm);
    collection.append($newForm1);
    $('input[id$="telefono"]').on('keyup', function(){
        camposRellenados = true;
        $('input[id$="telefono"]').each(function(){
            if ($(this).val() == "") {
                camposRellenados = false;
                return false;
            }
        });
        if (camposRellenados == false) {
            $('#cuentasPersonales_aceptar').prop('disabled', true);
        }else{
            $('#cuentasPersonales_aceptar').prop('disabled', false);
        }
    });
}
