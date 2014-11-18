$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_personal").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_personal'), false);
        }
    });

    limpiaForm($('#frm_personal'), false);
    $("#frm_personal").validate({
        rules: {
            dni: {required: true, minlength: 8, maxlength: 8},
            nombres: {required: true},
            apellido_paterno: {required: true},
            apellido_materno: {required: true},
            direccion: {required: true},
            cargo: {required: true},
            id_area: {required: true}
        },
        messages: {
            dni: {required: "Ingrese DNI", minlength: "DNI debe tener 8 digitos", maxlength: "DNI debe tener 8 digitos"},
            nombres: {required: "Ingrese Nombres"},
            apellido_paterno: {required: "Ingrese Apellido Paterno"},
            apellido_materno: {required: "Ingrese Apellido Materno"},
            direccion: {required: "Ingrese Direccion"},
            carg: {required: "Ingrese Cargo"},
            id_area: {required: "Seleccione un Perfil"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            
            var con_usuario = 'N';
            if ($('#es_usuario').is(':checked')){
                
                if ($('#usuario').val() == ''){
                    Mensaje('Ingrese usuario');
                    return;
                }
                if ($('#password').val() == ''){
                    Mensaje('Ingrese password');
                    return;
                }
                if ($('#id_perfil').val() == null){
                    Mensaje('Seleccione perfil');
                    return;
                }
                con_usuario = 'S';
            }
            
            $.post(
                    URLINDEX + '/personal/guardar',
                    {
                        ajax: 'ajax',
                        dni: $("#dni").val(),
                        nombres: $("#nombres").val().toUpperCase(),
                        apellido_paterno: $("#apellido_paterno").val().toUpperCase(),
                        apellido_materno: $("#apellido_materno").val().toUpperCase(),
                        direccion: $("#direccion").val().toUpperCase(),
                        telefono: $("#telefono").val().toUpperCase(),
                        cargo: $("#cargo").val().toUpperCase(),
                        id_area: $("#id_area").val(),
                        id_personal: $("#id_personal").val(),
                        usuario: $("#usuario").val().toUpperCase(),
                        password: $("#password").val().toUpperCase(),
                        id_perfil: $("#id_perfil").val(),
                        con_usuario : con_usuario
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_personal'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lspersonal').trigger('reloadGrid');
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

    $("#nuevo_personal").button().click(function() {
        limpiaForm($('#frm_personal'), true);
        $("#id_personal").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_personal").button().click(function() {
        var indexR = jQuery('#lspersonal').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/personal/get',
                    {
                        ajax: 'ajax',
                        id_personal: indexR
                    },
            function(response) {
                limpiaForm($('#frm_personal'), true);
                QuitarLoading();
                $("#dni").val(response.response.dni);
                $("#nombres").val(response.response.nombres);
                $("#apellido_paterno").val(response.response.apellido_paterno);
                $("#apellido_materno").val(response.response.apellido_materno);
                $("#direccion").val(response.response.direccion);
                $("#telefono").val(response.response.telefono);
                $("#cargo").val(response.response.cargo);
                $("#id_area").val(response.response.id_area);
                $("#id_personal").val(response.response.id_personal);
                
                if (response.response.con_usuario == 'S'){
                    $('#es_usuario').attr('checked','checked');
                    $('.usuario').show();
                    $('#usuario').val(response.response.usuario);
                    $('#password').val(response.response.password);
                    $('#id_perfil').val(response.response.id_perfil);
                    
                }else{
                    $('#es_usuario').removeAttr('checked');
                    $('.usuario').hide();
                    $('#usuario').val('');
                    $('#password').val('');
                    $('#id_perfil').val(null);
                }
                
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_personal").button().click(function() {
        var indexR = jQuery('#lspersonal').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/personal/anular',
                        {
                            ajax: 'ajax',
                            id_personal: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lspersonal').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

    $('#es_usuario').click(function(){
        
        $('#usuario').val('');
        $('#password').val('');
        $('#id_perfil').val(null);
        
        if ($('#es_usuario').is(':checked')){
            $('.usuario').show();
        }else{
            $('.usuario').hide();
        }
        
    });

    $('#es_usuario').removeAttr('checked');
    $('.usuario').hide();
});