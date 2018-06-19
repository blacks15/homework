var basicJs = {
    descargarImagen: function (imagen) {
        if ($('#descargarImg') != null || $('#descargarImg') != undefined) {
            $("descargarImg").remove();
        }
        var image = new Image();
        image.src = imagen.file;
        $('body').append('<a href="' + image.src + '" id="descargarImg" style="color:red; font-size:22px; display:none;" download="' + imagen.fullName + '">' + image + '</a>');
        document.getElementById("descargarImg").click();
    },
    descargarArchivo: function (archivo) {
        if ($('#descargarArchivo') != null || $('#descargarArchivo') != undefined) {
            $("descargarArchivo").remove();
        }
        $('body').append('<a href="' + archivo.file + '" id="descargarArchivo" style="color:red; font-size:22px; display:none;" download="' + archivo.fullName + '">' + archivo.fullName + '</a>');
        document.getElementById("descargarArchivo").click();
    },
    mostrarPDF: function (archivo) {
        if ($('#descargarArchivo') != null || $('#descargarArchivo') != undefined) {
            $("descargarArchivo").remove();
        }
        $('body').append('<a href="' + archivo.file + '" id="descargarArchivo" style="color:red; target="_blank" font-size:22px; display:none;">' + archivo.fullName + '</a>');
        document.getElementById("descargarArchivo").click();
    },
    enviarAjax: function (url, params) {
        return $.ajax({
            cache: false,
            type: "POST",
            crossDomain: true,
            url: RUTA_SERVICO + url,
            data: params,
            dataType: 'json',
            beforeSend: function () {
                basicJs.loading()
            },
            success: function (res) {
                //El resultado se trabaja en los metodos individuales
            },
            error: function (xhr, ajaxOptions, throwError) {
                //El resultado se trabaja en los metodos individuales
            }
        });
    },
    soloLetras: function (e) {
        var key = window.event ? e.keyCode : e.which;
        var resp = false;

        var str = String.fromCharCode(key);
        var expreg = /^[a-zA-ZñÑ\t\b\s]*$/;

        if (str.match(expreg)) {
            resp = true;
        }

        return resp;
    },
    soloNumeros: function (e) {
        var key = window.event ? e.keyCode : e.which;
        var expreg = /^[0-9]*$/;
        var resp = false;

        var str = String.fromCharCode(key);

        if (str.match(expreg)) {
            resp = true;
        }

        return resp;
    },
    numerosLetrasEsp: function (e) {
        var charCode = window.event ? e.keyCode : e.which;
        var str = String.fromCharCode(charCode);
        var expreg = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\t\b\s]*$/;
        var resp = true;

        if (!str.match(expreg) && charCode != 13) {
            resp = false;
        }
        return resp;
    },
    numerosLetrasSig: function (e) {
        var charCode = window.event ? e.keyCode : e.which;
        var str = String.fromCharCode(charCode);
        var expreg = /^[a-zA-Z0-9\-\_\.\t\b\s]*$/;
        var resp = true;

        if (!str.match(expreg) && charCode != 13) {
            resp = false;
        }
        return resp;
    },
    numerosLetras: function (e) {
        var charCode = window.event ? e.keyCode : e.which;
        var str = String.fromCharCode(charCode);
        var expreg = /^[a-zA-Z0-9\t\b\s]*$/;
        var resp = true;

        if (!str.match(expreg) && charCode != 13) {
            resp = false;
        }
        return resp;
    },
    validarCorreo: function (email) {
        var resp = false;

        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (expr.test(email)) {
            resp = true;
        }
        return resp;
    },
    loading: function () {
        var modalExiste = $("#modalEspere");

        if (modalExiste != null) {
            modalExiste.remove();
        }
        var modal = "<div class='modal fade' id='modalEspere' role='dialog'>\
                        <div class='modal-loading'>\
                            <div class='loader'></div>\
                            <h2>Cargando</h2> \
                        </div>\
                    </div>";

        $(".wrapper").append(modal);
        $("#modalEspere").modal({
            backdrop: 'static',
            keyboard: false
        });
        setInterval(function () {
            basicJs.espere();
        }, 900);
        $('.modal').on('shown.bs.modal', function () {
            $("body").removeAttr("style");
        });
    },
    espere: function () {
        if ($(".modal-loading h2").text().length == 11) {
            $(".modal-loading h2").text('Cargando');
        } else {
            $(".modal-loading h2").append('.');
        }
    },
    ocultarEspere: function () {
        var modalEspere = $(".modal-backdrop");

        if (modalEspere != null) {
            $(".modal-backdrop").remove();
            $(".modal").remove();
            $("body").removeClass('modal-open');
            $("body").removeAttr('style');
            $("nav").removeAttr('style');
            $("nav button").removeAttr('style');
        }
    },
};
var RUTA_SERVICO = 'http://localhost:8888/dash/services/';
var RUTA_PAGINAS = 'http://localhost:8888/dash/pages/';
$(document).ready(basicJs)