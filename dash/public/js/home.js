$(document).ready(function () {
    global.initialTooltip();
    cargarMenu();


    function cargarMenu() {
        var url = "Menu/menu";
        var cadena = localStorage.getItem('jwt');
        var parametros = {
            cadena
        };
        //json = JSON.parse(localStorage.getItem('jwt'));
        console.log(cadena);
        $.when(basicJs.enviarAjax(url, parametros)).then(function (response, textStatus, jqXHR) {
            if (jqXHR.status == '200') {
                console.log(response);
                if (response.codRetorno == '000') {
                    global.mensajeConfirm(response.titulo, 'success', response.mensaje, 'login');
                } else {
                    global.mensajeConfirm(response.titulo, 'warning', response.mensaje, 'login.html');
                }
            } else {
                global.mensaje('', 'error', 'Ha Ocurrido un Error, Intentelo más Tarde.', '');
            }
        });
    }
});