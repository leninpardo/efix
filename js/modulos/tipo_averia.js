$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_tipo_averia").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_tipo_averia'), false);
        }
    });

    limpiaForm($('#frm_tipo_averia'), false);
    $("#frm_tipo_averia").validate({
        rules: {
            descripcion: {required: true}
        },
        messages: {
            descripcion: {required: "Ingrese descripcion"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/tipo_averia/guardar',
                    {
                        ajax: 'ajax',
                        descripcion: $("#descripcion").val().toUpperCase(),
                        id_tipoaveria: $("#id_tipoaveria").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_tipo_averia'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lstipo_averia').trigger('reloadGrid');
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

    $("#nuevo_tipo_averia").button().click(function() {
        limpiaForm($('#frm_tipo_averia'), true);
        $("#id_tipoaveria").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_tipo_averia").button().click(function() {
        var indexR = jQuery('#lstipo_averia').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/tipo_averia/get',
                    {
                        ajax: 'ajax',
                        id_tipoaveria: indexR
                    },
            function(response) {
                limpiaForm($('#frm_tipo_averia'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.descripcion);
                $("#id_tipoaveria").val(response.response.id_tipoaveria);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_tipo_averia").button().click(function() {
        var indexR = jQuery('#lstipo_averia').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/tipo_averia/anular',
                        {
                            ajax: 'ajax',
                            id_tipoaveria: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lstipo_averia').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});