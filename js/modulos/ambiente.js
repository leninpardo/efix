$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_ambiente").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_ambiente'), false);
        }
    });

    limpiaForm($('#frm_ambiente'), false);
    $("#frm_ambiente").validate({
        rules: {
            descripcion: {required: true},
            id_facultad: {required: true}
        },
        messages: {
            descripcion: {required: "Ingrese descripcion"},
            id_facultad: {required: "Seleccione una Facultad"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/ambiente/guardar',
                    {
                        ajax: 'ajax',
                        ambi_descripcion: $("#descripcion").val().toUpperCase(),
                        facu_id: $("#id_facultad").val(),
                        ambi_id: $("#id_ambiente").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_ambiente'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsambiente').trigger('reloadGrid');
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

    $("#nuevo_ambiente").button().click(function() {
        limpiaForm($('#frm_ambiente'), true);
        $("#id_ambiente").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_ambiente").button().click(function() {
        var indexR = jQuery('#lsambiente').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/ambiente/get',
                    {
                        ajax: 'ajax',
                        ambi_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_ambiente'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.ambi_descripcion);
                $("#id_facultad").val(response.response.facu_id);
                $("#id_ambiente").val(response.response.ambi_id);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_ambiente").button().click(function() {
        var indexR = jQuery('#lsambiente').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/ambiente/anular',
                        {
                            ajax: 'ajax',
                            ambi_id: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsambiente').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});