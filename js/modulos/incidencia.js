$(document).ready(function() {
    
    $('#posible_solucion').jqte();
    
    $('#cargar').button().click(function() {
        jQuery("#lsincidencia").jqGrid('setGridParam', {url: URLINDEX + "/incidencia/lista?id_tipoaveria=" + $('#id_tipoaveria').val(), page: 1});
        jQuery("#lsincidencia").trigger('reloadGrid');
    });

    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 800,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_incidencia").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_incidencia'), false);
        }
    });
    limpiaForm($('#frm_incidencia'), false);
    $("#frm_incidencia").validate({
        rules: {
            tipoaveria: {required: true},
            descripcion: {required: true},
            tiempo_estimado: {required: true}
        },
        messages: {
            tipoaveria: {required: "Especifique Tipo de Averia"},
            descripcion: {required: "Ingrese Descripcion"},
            tiempo_estimado: {required: "Ingrese Tiempo Estiamdo"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');

            $.post(
                    URLINDEX + '/incidencia/guardar',
                    {
                        ajax: 'ajax',
                        id_tipoaveria: $("#id_tipoaveria").val().trim(),
                        descripcion: $("#descripcion").val().trim().toUpperCase(),
                        tiempo_estimado: $("#tiempo_estimado").val().trim(),
                        posible_solucion: $("#posible_solucion").val().trim(),
                        id_incidencia: $("#id_incidencia").val().trim()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_incidencia'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsincidencia').trigger('reloadGrid');
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
    $("#nuevo_incidencia").button().click(function() {
        if ($("#id_tipoaveria").val().trim() != "0") {
            limpiaForm($('#frm_incidencia'), true);
            $("#id_incidencia").val(-1);
            $("#id_tipoaveria").val($("#id_tipoaveria").val().trim());
            var indexS = $('#id_tipoaveria').val().trim();
            if (indexS != null) {
                Loading('Cargando Datos...');
                $.get(
                        URLINDEX + '/tipo_averia/get',
                        {
                            ajax: 'ajax',
                            id_tipoaveria: indexS
                        },
                function(response) {
                    QuitarLoading();
                    $("#tipoaveria").val(response.response.descripcion);
                },
                        'json'
                        );
            }
            $("#modalRegistro").dialog("open");
        } else {
            Mensaje('Seleccione Tipo de Averia', 'Seleccione');
        }
    });
    $("#modificar_incidencia").button().click(function() {
        var indexR = jQuery('#lsincidencia').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/incidencia/get',
                    {
                        ajax: 'ajax',
                        id_incidencia: indexR
                    },
            function(response) {
                limpiaForm($('#frm_incidencia'), true);
                QuitarLoading();
                Loading('Cargando Datos...');
                $.get(
                        URLINDEX + '/tipo_averia/get',
                        {
                            ajax: 'ajax',
                            id_tipoaveria: response.response.id_tipoaveria
                        },
                function(response) {
                    QuitarLoading();
                    $("#tipoaveria").val(response.response.descripcion);
                },
                        'json'
                        );

                $("#descripcion").val(response.response.descripcion);
                $("#tiempo_estimado").val(response.response.tiempo_estimado);
                $('#posible_solucion').jqteVal(response.response.posible_solucion);
                $("#id_incidencia").val(response.response.id_incidencia);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });
    $("#anular_incidencia").button().click(function() {
        var indexR = jQuery('#lsincidencia').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/incidencia/anular',
                        {
                            ajax: 'ajax',
                            id_incidencia: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsincidencia').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });
});