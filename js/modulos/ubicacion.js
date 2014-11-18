$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_ubicacion").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        open: function() {
            $("#id_ambiente").empty();
        },
        close: function() {
            limpiaForm($('#frm_ubicacion'), false);
        }
    });

    limpiaForm($('#frm_ubicacion'), false);
    $("#frm_ubicacion").validate({
        rules: {
            descripcion: {required: true},
            id_ambiente: {required: true}
        },
        messages: {
            descripcion: {required: "Ingrese descripcion"},
            id_ambiente: {required: "Seleccione un Ambiente"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/ubicacion/guardar',
                    {
                        ajax: 'ajax',
                        ubic_descripcion: $("#descripcion").val().toUpperCase(),
                        ambi_id: $("#id_ambiente").val(),
                        ubic_id: $("#id_ubicacion").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_ubicacion'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsubicacion').trigger('reloadGrid');
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

    $("#id_facultad").on("change", function() {
        actualizarCombo("id_ambiente", "ambiente/getAmbientesForFacultad", "ambi_id", "ambi_descripcion", null, null, null, [$("#id_facultad")])
    });

    $("#nuevo_ubicacion").button().click(function() {
        limpiaForm($('#frm_ubicacion'), true);
        $("#id_ubicacion").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_ubicacion").button().click(function() {
        var indexR = jQuery('#lsubicacion').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/ubicacion/get',
                    {
                        ajax: 'ajax',
                        ubic_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_ubicacion'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.ubic_descripcion);
                $("#id_facultad").val(response.response.facu_id);
                actualizarCombo("id_ambiente", "ambiente/getAmbientesForFacultad", "ambi_id", "ambi_descripcion", null, null, null, [$("#id_facultad")], null, null, function() {
                    $("#id_ambiente").val(response.response.ambi_id);
                })
                $("#id_ubicacion").val(response.response.ubic_id);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_ubicacion").button().click(function() {
        var indexR = jQuery('#lsubicacion').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/ubicacion/anular',
                        {
                            ajax: 'ajax',
                            ubic_id: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsubicacion').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});