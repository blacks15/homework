var global = {
    cargarContenido: function (contenedor, pagina) {
        $("#" + contenedor).html("");
        $.ajax({
            cache: false,
            type: "GET",
            url: RUTA_VIEWS + pagina,
            dataType: 'html',
            beforeSend: function () {
                basicJs.loading()
            },
            complete: function () {
                basicJs.ocultarEspere();
            },
            success: function (response) {
                $("#" + contenedor).html(response);
            },
            error: function (xhr, ajaxOptions, throwError) {
                console.log(xhr);
            }
        });
    },
    cambiarTab: function (prevTab, nextTab, progress, tab) {
        $("#" + prevTab).addClass('disabled');
        $("#" + prevTab).removeClass('active');
        $("#" + nextTab).removeClass('disabled');
        $(".progress-bar").css('width', progress + "%");
        $("#pills-tab a[href='#" + tab + "']").tab('show');
    },
    initialSelect: function (selector) {
        $('.' + selector).selectpicker({
            style: 'btn-default',
        });
    },
    initialTooltip: function (data) {
        $('[' + data + '="tooltip"]').tooltip();
    },
    initialCalendar: function (selector) {
        $('#' + selector).datepicker({
            language: 'es',
            todayHighlight: true,
            autoclose: true,
            endDate: 'today',
            startDate: '-100y'
        });
    },
    initialFileInput: function (selector) {
        $("#" + selector).fileinput({
            language: "es",
            theme: "fas",
            showCaption: false,
            showRemove: false,
            showUpload: false,
            dropZoneEnabled: true,
            allowedFileExtensions: ["jpg", "png"],
            elErrorContainer: '#errorBlock',
            browseClass: "btn btn-success btn-block",
            browseLabel: "",
            browseIcon: "<i class=\"fa fa-fw fa-file-image\"></i> ",
        });
    },
    obtenerFechaActual: function () {
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        f = new Date();
        fecha = f.getDate() + " de " + (meses[f.getMonth()]) + " de " + f.getFullYear();

        return fecha;
    },
    obtenerPaginacion: function (numFilas, paginaActual) {
        var lista = "";
        paginaActual = parseInt(paginaActual);
        totalPaginas = Math.ceil(numFilas / 5);

        if (paginaActual > 1) {
            lista = lista + "<li class='page-item'><a class='page-link' href='#' data=" + (paginaActual - 1) + " aria-label='Previous'>\
                <span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        for (i = 1; i <= totalPaginas; i++) {
            if (i == paginaActual) {
                console.log("p " + i);
                lista = lista + "<li class='page-item active'><a class='page-link' href='#' data=" + i + ">" + i + "</a></li>";
            } else {
                lista = lista + "<li class='page-item'><a class='page-link' href='#' data=" + i + ">" + i + "</a></li>";
            }
        }

        if (paginaActual < totalPaginas) {
            lista = lista + "<li class='page-item'><a class='page-link' href='#' data=" + (paginaActual + 1) + " aria-label='Siguiente'>\
                <span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
        }

        return lista;
    },
    validarCampos: function (campos) {
        var resp = false;
        for (var i = 0; i < campos.length; i++) {
            if (campos[i] == "" || campos[i].length == 0) {
                resp = true;
                break;
            }
        }
        return resp;
    },
    mensaje: function (titulo, tipo, texto) {
        swal({
            title: titulo,
            type: tipo,
            text: texto,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            allowEscapeKey: false,
            allowOutsideClick: false,
        });
    },
    mensajeConfirm: function (titulo, tipo, texto, pagina) {
        swal({
            title: titulo,
            type: tipo,
            text: texto,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then(function () {
            global.redirectPage(pagina);
        });
    },
    toJSON: function (selector) {
        var array = $(selector).serializeArray();
        var obj = {};
        for (var a = 0; a < array.length; a++) {
            obj[array[a].name] = array[a].value;
        }
        return obj;
    },
    redirectPage: function (page) {
        window.location.href = page;
    },
    saveJWT: function (jwt) {
        localStorage.jwt = JSON.stringify(jwt);
    },
};
var RUTA_VIEWS = 'http://localhost:8888/dash/pages/';

$(document).ready(global);