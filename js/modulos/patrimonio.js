$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_patrimonio").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_patrimonio'), false);
        }
    });

    limpiaForm($('#frm_patrimonio'), false);
    $("#frm_patrimonio").validate({
        rules: {
            codigo_patrimonial: {required: true},
            descripcion: {required: true}
        },
        messages: {
            codigo_patrimonial: {required: "Ingrese codigo patrimonial"},
            descripcion: {required: "Ingrese descripcion"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/patrimonio/guardar',
                    {
                        ajax: 'ajax',
                        descripcion: $("#descripcion").val().toUpperCase(),
                        codigo_patrimonial: $("#codigo_patrimonial").val().toUpperCase(),
                          estado: $("#estado").val().toUpperCase(),
                        id_patrimonio: $("#id_patrimonio").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_patrimonio'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lspatrimonio').trigger('reloadGrid');
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

    $("#nuevo_patrimonio").button().click(function() {
        limpiaForm($('#frm_patrimonio'), true);
        $("#id_patrimonio").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_patrimonio").button().click(function() {
        var indexR = jQuery('#lspatrimonio').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/patrimonio/get',
                    {
                        ajax: 'ajax',
                        id_patrimonio: indexR
                    },
            function(response) {
                limpiaForm($('#frm_patrimonio'), true);
                QuitarLoading();
                $("#codigo_patrimonial").val(response.response.codigo_patrimonial);
                $("#descripcion").val(response.response.descripcion);
                $("#id_patrimonio").val(response.response.id_patrimonio);
                estado=response.response.estado;
                 //$('#estado option[@value='+estado+']').attr('selected', 'selected');
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_patrimonio").button().click(function() {
        var indexR = jQuery('#lspatrimonio').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/patrimonio/anular',
                        {
                            ajax: 'ajax',
                            id_patrimonio: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lspatrimonio').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});