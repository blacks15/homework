$(document).ready(function () {
    var RUTA_CONTENEDOR = 'contenedor';

    $("input[name=options]").change(function () {
        var opc = $(this).val();

        global.cargarContenido(RUTA_CONTENEDOR, opc);
    });
});