/** ACRIVAR EL PLUGIN DATAPICKER EN LOS CAMPOS FECHA DE LOS FORMULARIOS **/


function activarDataPickers(id_fechaFactura) {
    alert('aver');
    $(id_fechaFactura).fdatepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        leftArrow:'<<',
        rightArrow:'>>',
        closeButton: true
    });
    $(id_fechaFactura).val(ObtenerFechaActual());
}

function ObtenerFechaActual() {
    var mes = new Array();
    mes[0] = "01";
    mes[1] = "02";
    mes[2] = "03";
    mes[3] = "04";
    mes[4] = "05";
    mes[5] = "06";
    mes[6] = "07";
    mes[7] = "08";
    mes[8] = "09";
    mes[9] = "10";
    mes[10] = "11";
    mes[11] = "12";
    var fecha = new Date();
    var dd = fecha.getDate(); 
    var MM = mes[fecha.getMonth()];
    var aaaa = fecha.getFullYear();
    var fechaActual= dd + "/" +( MM) + "/" + aaaa;
    return fechaActual;
}