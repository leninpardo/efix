$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_usuario").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_usuario'), false);
        }
    });

    limpiaForm($('#frm_usuario'), false);
    $("#frm_usuario").validate({
        rules: {
            dni: {required: true, minlength: 8, maxlength: 8},
            nombres: {required: true},
            apellido_paterno: {required: true},
            apellido_materno: {required: true},
            direccion: {required: true},
            usuario: {required: true},
            password: {required: true, maxlength: 50},
            id_perfil: {required: true}
        },
        messages: {
            dni: {required: "Ingrese DNI", minlength: "DNI debe tener 8 digitos", maxlength: "DNI debe tener 8 digitos"},
            nombres: {required: "Ingrese Nombres"},
            apellido_paterno: {required: "Ingrese Apellido Paterno"},
            apellido_materno: {required: "Ingrese Apellido Materno"},
            direccion: {required: "Ingrese Direccion"},
            usuario: {required: "Ingrese LOGIN"},
            password: {required: "Ingrese CLAVE", maxlength: "Clave debe tener menos de 50 digitos"},
            id_perfil: {required: "Seleccione un Perfil"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/usuario/guardar',
                    {
                        ajax: 'ajax',
                        usua_documeto_identidad: $("#dni").val(),
                        usua_nombres: $("#nombres").val().toUpperCase(),
                        usua_apellido_paterno: $("#apellido_paterno").val().toUpperCase(),
                        usua_apellido_materno: $("#apellido_materno").val().toUpperCase(),
                        usua_direccion: $("#direccion").val().toUpperCase(),
                        usua_telefono: $("#telefono").val().toUpperCase(),
                        usua_login: $("#usuario").val().toUpperCase(),
                        usua_clave: $("#password").val().toUpperCase(),
                        perf_id: $("#id_perfil").val(),
                        usua_id: $("#id_usuario").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_usuario'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsusuario').trigger('reloadGrid');
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

    $("#nuevo_usuario").button().click(function() {
        limpiaForm($('#frm_usuario'), true);
        $("#id_usuario").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_usuario").button().click(function() {
        var indexR = jQuery('#lsusuario').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/usuario/get',
                    {
                        ajax: 'ajax',
                        usua_id: indexR
                    },
            function(response) {
                limpiaForm($('#frm_usuario'), true);
                QuitarLoading();
                $("#dni").val(response.response.usua_documeto_identidad);
                $("#nombres").val(response.response.usua_nombres);
                $("#apellido_paterno").val(response.response.usua_apellido_paterno);
                $("#apellido_materno").val(response.response.usua_apellido_materno);
                $("#direccion").val(response.response.usua_direccion);
                $("#telefono").val(response.response.usua_telefono);
                $("#usuario").val(response.response.usua_login);
                $("#password").val(response.response.usua_clave);
                $("#id_perfil").val(response.response.perf_id);
                $("#id_usuario").val(response.response.usua_id);
                
                if (response.response.id_personal == '0'){
                    $("#dni").removeAttr('readonly');
                    $("#nombres").removeAttr('readonly');
                    $("#apellido_paterno").removeAttr('readonly');
                    $("#apellido_materno").removeAttr('readonly');
                    $("#direccion").removeAttr('readonly');
                    $("#telefono").removeAttr('readonly');
                    $("#usuario").removeAttr('readonly');
                    $("#password").removeAttr('readonly');
                    $("#id_perfil").removeAttr('disabled');
                }else{
                    $("#dni").attr('readonly','readonly');
                    $("#nombres").attr('readonly','readonly');
                    $("#apellido_paterno").attr('readonly','readonly');
                    $("#apellido_materno").attr('readonly','readonly');
                    $("#direccion").attr('readonly','readonly');
                    $("#telefono").attr('readonly','readonly');
                    $("#usuario").attr('readonly','readonly');
                    $("#password").attr('readonly','readonly');
                    $("#id_perfil").attr('disabled','disabled');
                }
                
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_usuario").button().click(function() {
        var indexR = jQuery('#lsusuario').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/usuario/anular',
                        {
                            ajax: 'ajax',
                            usua_id: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsusuario').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

});