$(document).ready(function () {

    global.initialTooltip();
    $("#fecha").val(global.obtenerFechaActual());

    $("#btnIniciarApertura").click(cargarTabla);

    function cargarTabla() {
        var url = "Venta/iniciarVenta";
        var parametros = { "usuario": "jelipack", "numEmp": 1122334455 };

        $.when(basicJs.enviarAjax(url, parametros)).then(function (response, textStatus, jqXHR) {
            if (jqXHR.status == '200') {
                //BasicJs.descargarImagen(response.Imagen);
                //BasicJs.descargarArchivo(response.Archivo);
                //BasicJs.mostrarPDF(response.Archivo);
            } else {
                console.log(jqXHR);
                alert("Error en el servidor");
            }
        });
    }
});