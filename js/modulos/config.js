$(document).ready(function() {
    limpiaForm($('#frm_perfil'), false);
    $("#frm_perfil").validate({
        rules: {
            descripcion: {required: true}
        },
        messages: {
            descripcion: {required: "Ingrese Descripcion"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/perfil/guardar',
                    {
                        ajax: 'ajax',
                        perf_descripcion: $("#descripcion").val().toUpperCase(),
                        perf_id: $("#id_perfil").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_perfil'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsperfil').trigger('reloadGrid');
                }
            },
                    'json'
                    );

        },
        success: function(label) {
            label.html("&nbsp;").addClass("ok");
        }
    });

    $("#guardar_perfil").button().click(function() {
        $("#frm_perfil").submit();
    });

    $("#cancelar_perfil").button().click(function() {
        limpiaForm($('#frm_perfil'));
    });

    $("#nuevo_perfil").button().click(function() {
        limpiaForm($('#frm_perfil'), true);
        $("#id_perfil").val(-1)
    });

    $("#modificar_config").button().click(function() {
        var indexR = jQuery('#lsperfil').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/perfil/get',
                    {
                        ajax: 'ajax',
                        perf_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_perfil'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.perf_descripcion),
                        $("#id_perfil").val(response.response.perf_id)

            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_perfil").button().click(function() {
        var indexR = jQuery('#lsperfil').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Dato...');

                $.get(
                        URLINDEX + '/perfil/anular',
                        {
                            ajax: 'ajax',
                            perf_id: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsperfil').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});