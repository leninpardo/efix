$(document).ready(function() {
    limpiaForm($('#frm_Modulo'), false);
    $("#frm_Modulo").validate({
        rules: {
            descripcion: {required: true},
            url: {required: true},
            id_padre: {required: true},
            peso: {required: true}
        },
        messages: {
            descripcion: {required: "Ingrese Descripcion"},
            url: {required: "Ingrese Url"},
            peso: {required: "Ingrese Orden"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            $.post(
                    URLINDEX + '/modulo/guardar',
                    {
                        ajax: 'ajax',
                        modu_descripcion: $("#descripcion").val().toUpperCase(),
                        modu_url: $("#url").val(),
                        modu_padre: $("#id_padre").val(),
                        modu_peso: $("#peso").val(),
                        modu_id: $("#id_modulo").val()
                    },
            function(response) {
                limpiaForm($('#frm_Modulo'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsmodulo').trigger('reloadGrid');
                    actualizarCombo('id_padre', 'modulo/getModulo', 'modu_id', 'modu_descripcion', null, '0', 'Ninguno', []);
                }
            },
                    'json'
                    );

        },
        success: function(label) {
            label.html("&nbsp;").addClass("ok");
        }
    });

    $("#guardar_modulo").button().click(function() {
        $("#frm_Modulo").submit();
    });

    $("#cancelar_modulo").button().click(function() {
        limpiaForm($('#frm_Modulo'));
    });


    $("#nuevo_modulo").button().click(function() {
        limpiaForm($('#frm_Modulo'), true);
        $("#id_modulo").val(-1)
    });

    $("#modificar_modulo").button().click(function() {

        var indexR = jQuery('#lsmodulo').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/modulo/get',
                    {
                        ajax: 'ajax',
                        modu_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_Modulo'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.modu_descripcion);
                $("#url").val(response.response.modu_url);
                $("#id_padre").val(response.response.modu_padre);
                $("#peso").val(response.response.modu_peso);
                $("#id_modulo").val(response.response.modu_id);
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_modulo").button().click(function() {
        var indexR = jQuery('#lsmodulo').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {
                Loading('Anulando Dato...');
                $.get(
                        URLINDEX + '/modulo/anular',
                        {
                            ajax: 'ajax',
                            modu_id: indexR
                        },
                function(response) {
                    QuitarLoading();
                    actualizarCombo('id_padre', 'modulo/getModulo', 'modu_id', 'modu_descripcion', null, '0', 'Ninguno', []);
                    jQuery('#lsmodulo').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });
});