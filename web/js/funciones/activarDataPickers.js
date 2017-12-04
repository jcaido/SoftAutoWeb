/** ACTIVAR EL PLUGIN DATAPICKER EN LOS CAMPOS FECHA DE LOS FORMULARIOS **/


function activarDataPickers(id_Fecha) {
    $(id_Fecha).fdatepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        leftArrow:'<<',
        rightArrow:'>>',
        closeButton: true
    });
}

function asignarFechaActual(id_Fecha) {
    $(id_Fecha).val(ObtenerFechaActual());
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

    var dd = fecha.getDate(); //yields day
    if(dd<10){
        dd='0'+dd;
    }

    var MM = mes[fecha.getMonth()]; //yields month
    if(MM<10){
        MM='0'+MM;
    } 

    var aaaa = fecha.getFullYear(); //yields year
    var fechaActual = dd + "/" +( MM) + "/" + aaaa;

    return fechaActual;
}