$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_area_administrativa").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_area_administrativa'), false);
        }
    });

    limpiaForm($('#frm_area_administrativa'), false);
    $("#frm_area_administrativa").validate({
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
                    URLINDEX + '/area_administrativa/guardar',
                    {
                        ajax: 'ajax',
                        descripcion: $("#descripcion").val().toUpperCase(),
                        id_tipoaveria: $("#id_tipoaveria").val().toUpperCase(),
                        id_area: $("#id_area").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_area_administrativa'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsarea_administrativa').trigger('reloadGrid');
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

    $("#nuevo_area_administrativa").button().click(function() {
        limpiaForm($('#frm_area_administrativa'), true);
        $("#id_area").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_area_administrativa").button().click(function() {
        var indexR = jQuery('#lsarea_administrativa').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/area_administrativa/get',
                    {
                        ajax: 'ajax',
                        id_area: indexR
                    },
            function(response) {
                limpiaForm($('#frm_area_administrativa'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.descripcion);
                $("#id_area").val(response.response.id_area);
                $("#id_tipoaveria").val(response.response.id_tipoaveria);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_area_administrativa").button().click(function() {
        var indexR = jQuery('#lsarea_administrativa').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/area_administrativa/anular',
                        {
                            ajax: 'ajax',
                            id_area: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsarea_administrativa').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});