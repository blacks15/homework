$(document).ready(function () {
    initialComponent();

    $("#btnLogin").on('click', function () {
        var cadena = JSON.stringify(global.toJSON("#frmLogin"));
        var parametros = {
            cadena
        };
        var url = "Login/login";
        login(url, parametros);
    });

    $("#usuario").on('keypress', function (evt) {
        var charCode = evt.which || evt.keyCode;

        if (charCode == 13 && $("#usuario").val() != '') {
            $("#password").focus();
        } else {
            return basicJs.numerosLetrasSig(evt);
        }
    });

    $("#usuario").on('keyup', function (evt) {
        habilitarBoton();
    });

    $("#password").on('keypress', function (evt) {
        var charCode = evt.which || evt.keyCode;

        if (charCode == 13 && $("#usuario").val() != '') {
            $("#btnLogin").focus();
        } else {
            return basicJs.numerosLetrasSig(evt);
        }
    });

    $("#password").on('keyup', function () {
        habilitarBoton();
    });

    function initialComponent() {
        $("#usuario").focus();
        $(".copyright").append('© ' + new Date().getFullYear() + ', Web Developer');
    }

    function habilitarBoton() {
        var campos = new Array();

        campos.push($("#usuario").val());
        campos.push($("#password").val());

        var resp = global.validarCampos(campos);

        if (resp == true) {
            $("#btnLogin").prop('disabled', true);
        } else {
            $("#btnLogin").prop('disabled', false);
        }
    }

    function login(url, parametros) {
        $.when(basicJs.enviarAjax(url, parametros)).then(function (response, textStatus, jqXHR) {
            if (jqXHR.status == '200') {
                console.log(response);
                if (response.codRetorno == '000') {
                    global.saveJWT(response.jwt);
                    global.mensajeConfirm(response.titulo, 'success', response.mensaje, 'home');
                } else {
                    global.mensaje(response.titulo, 'warning', response.mensaje);
                }
            } else {
                global.mensaje('', 'error', 'Ha Ocurrido un Error, Intentelo más Tarde.');
            }
        });
    }
});