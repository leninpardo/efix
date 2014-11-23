function setSeguimiento() {
    $("#lsaveria tbody tr").each(function(index, model) {
        var id = $(this).attr("id");
        var data = $('#lsaveria').getRowData(id);
        if (data.seguimiento == "PENDIENTE") {
            $(this).css({"background-image": "none", "background-color": "#f2dede"});
            
            var chk = '<input type="checkbox" class="chk" name="chk" value="ON" id_averia="' + id + '"/>';
            $('#lsaveria').jqGrid('setRowData',id,{asignar:chk});
        }
        else if (data.seguimiento == "PROCESO") {
            $(this).css({"background-image": "none", "background-color": "#fcf8e3"});
        }
        else if (data.seguimiento == "ATENDIDO") {
            $(this).css({"background-image": "none", "background-color": "#dff0d8"});
        }
        $(this).hover(function(){
            $(this).css("color","#444444");
        });
    });
}
$(document).ready(function() {
    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            Guardar: function() {
                $("#frm_averia").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_averia'), false);
        }
    });

    limpiaForm($('#frm_averia'), false);
    $("#frm_averia").validate({
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
                    URLINDEX + '/averia/guardar',
                    {
                        ajax: 'ajax',
                        ambi_descripcion: $("#descripcion").val().toUpperCase(),
                        facu_id: $("#id_facultad").val(),
                        id_averia: $("#id_averia").val()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_averia'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lsaveria').trigger('reloadGrid');
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

    $("#nuevo_averia").button().click(function() {
        limpiaForm($('#frm_averia'), true);
        $("#id_averia").val(-1);
        $("#modalRegistro").dialog("open");
    });

    $("#modificar_averia").button().click(function() {
        var indexR = jQuery('#lsaveria').getGridParam("selrow");
        if (indexR != null) {
            Loading('Cargando Datos...');
            $.get(
                    URLINDEX + '/averia/get',
                    {
                        ajax: 'ajax',
                        id_averia: indexR
                    },
            function(response) {
                limpiaForm($('#frm_averia'), true);
                QuitarLoading();
                $("#descripcion").val(response.response.ambi_descripcion);
                $("#id_facultad").val(response.response.facu_id);
                $("#id_averia").val(response.response.id_averia);
                $("#modalRegistro").dialog("open");
            },
                    'json'
                    );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });

    $("#anular_averia").button().click(function() {
        var indexR = jQuery('#lsaveria').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/averia/anular',
                        {
                            ajax: 'ajax',
                            id_averia: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lsaveria').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });

    $("#asignar_averia").button().click(function() {
        
        var averias = [];
        $('.chk').each(function(idx,obj){
            if ($(obj).is(':checked')){
                averias.push($(obj).attr('id_averia'));
            }
        });
        
        if (averias.length > 0){
            
            $("#dlgAsignar").dialog({
                width: 400,
                modal: true,
                buttons: {
                    Asignar: function() {
                        
                        $.get(
                                URLINDEX + '/averia/asignar',
                                {
                                    ajax: 'ajax',
                                    averias: averias,
                                    id_personal : $('#id_personal').val()
                                },
                        function(response) {
                            $("#dlgAsignar").dialog("close");
                            jQuery('#lsaveria').trigger("reloadGrid");

                        },
                        'json');
                        
                    },
                    Cancelar: function() {
                        $("#dlgAsignar").dialog("close");
                    }
                },
                close: function() {
                    
                }
            });
            
        }else{
            alert('Seleccione una averia para asignar');
        }
        
    });
    
    $("#dlgDetalle").dialog({
        autoOpen: false,
        width: 1055,
        modal: true,
        heigth:510,
        position:'top',
        buttons: {
            Cerrar: function() {
                $("#dlgDetalle").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_averia'), false);
        }
    });
    
    $("#detalle_averia").button().click(function() {
        
        var indexR = jQuery('#lsaveria').getGridParam("selrow");
        if (indexR != null) {
            
            Loading('Cargando Datos...');
            
            $.get(
                    URLINDEX + '/averia/get',
                    {
                        ajax: 'ajax',
                        id_averia: indexR
                    },
                    function(response) {
                        QuitarLoading();
                        
                        var data = $('#lsaveria').getRowData(indexR);
                        var color = '';
                        if (data.seguimiento == 'PENDIENTE'){
                            color = 'rgb(242, 222, 222)';
                        }
                        if (data.seguimiento == 'ATENDIDO'){
                            color = 'rgb(223, 240, 216)';
                        }
                        if (data.seguimiento == 'PROCESO'){
                            color = 'rgb(252, 248, 227)';
                        }
                        
                        $('#txt_estado').text(data.seguimiento).css('background-color',color);
                        $('#det_fecha').val(data.fecha_reporte);
                        $('#det_hora').val(data.hora_reporte);
                        $('#det_facultad').val(data.facu_descripcion);
                        $('#det_ambiente').val(data.ambi_descripcion);
                        $('#det_ubicacion').val(data.ubic_descripcion);
                        $('#det_insidencia').val(data['i.descripcion']);
                        $('#det_reportado').val(data.usua_nombres);
                        $('#det_asignado').val(data.personal_nombres);
                        $('#det_observaciones').val(response.response.observacion);

                        $('#det_imagen').attr('src','../archivos/' + response.response.imagen);
                        // $('#det_mapa').attr('src','..//' + response.response.imagen);
                        $("#div_mapa").empty();
                        $("#div_mapa").append("<img src='../images/unsm.jpg' width='500px' heigth='450px' ></img>");
                        $("#div_mapa").append("<img src='../images/efix.png' width='20px' heigth='20px' style='"+response.response.position+"' ></img>");
                         //$("#det_mapa").attr('src','../images/unsm.jpg');
                        $("#dlgDetalle").dialog("open");
                    },
                    'json'
            );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
        
    });
    
});