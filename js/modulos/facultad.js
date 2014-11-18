$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_facultad").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_facultad'), false);
        }
    });
    $("#modalCoordenada").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Cerrar: function() {
                $("#modalCoordenada").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_facultad'), false);
        }
    });

    limpiaForm($('#frm_facultad'), false);
    $("#frm_facultad").validate({
        rules: {
            descripcion: {required: true},
        },
        messages: {
            descripcion: {required: "Ingrese descripcion"},
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/facultad/guardar',
                    {
                        ajax: 'ajax',
                        facu_descripcion: $("#descripcion").val().toUpperCase(),
                        facu_id: $("#id_facultad").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_facultad'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsfacultad').trigger('reloadGrid');
                    $("#modalRegistro").dialog("close");
                }
            },
                    'json'
                    );

        },
        success: function(label) {
            label.html("&nbsp;").addClass("ok");
        }
    });

    $("#nuevo_facultad").button().click(function() {
        limpiaForm($('#frm_facultad'), true);
        $("#id_facultad").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_facultad").button().click(function() {
        var indexR = jQuery('#lsfacultad').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/facultad/get',
                    {
                        ajax: 'ajax',
                        facu_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_facultad'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.facu_descripcion);
                $("#id_facultad").val(response.response.facu_id);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#coordenada_facultad").button().click(function() {
        var indexR = jQuery('#lsfacultad').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            var data = $('#lsfacultad').getRowData(indexR);
            $("#facultad").val(data.facu_descripcion);
            $("#latitud").val("");
            $("#longitud").val("");
            $("#id_facultad").val(indexR);

            jQuery("#lscoordenada").jqGrid('setGridParam', {url: URLINDEX + "/facultad/listaCoordenada?facu_id=" + indexR, page: 1});
            jQuery("#lscoordenada").trigger('reloadGrid');

            $("#modalCoordenada").dialog("open");
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });
    $("#agregar_coordenada").button().click(function(ev) {
        ev.preventDefault();
        if ($("#latitud").val().trim() == "" || $("#longitud").val().trim() == "") {
            Mensaje('Complete los datos', 'Alerta');
        } else {
            $.post(
                    URLINDEX + '/facultad/guardarCoordenada',
                    {
                        ajax: 'ajax',
                        latitud: $("#latitud").val().toUpperCase(),
                        longitud: $("#longitud").val().toUpperCase(),
                        facu_id: $("#id_facultad").val(),
                        id_coordenada: -1
                    },
            function(response) {
                limpiaForm($('#frm_facultad_coordenada'), true);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lscoordenada').trigger('reloadGrid');
                }
            },
                    'json'
                    );
        }
    });
    $("#anular_facultad").button().click(function() {
        var indexR = jQuery('#lsfacultad').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/facultad/anular',
                        {
                            ajax: 'ajax',
                            facu_id: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsfacultad').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});