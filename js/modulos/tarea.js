function setSeguimiento() {
    $("#lstarea tbody tr").each(function(index, model) {
        var id = $(this).attr("id");
        var data = $('#lstarea').getRowData(id);
        if (data.seguimiento == "PENDIENTE") {
            $(this).css({"background-image": "none", "background-color": "#f2dede"});

            var chk = '<input type="checkbox" class="chk" name="chk" value="ON" id_averia="' + id + '"/>';
            $('#lstarea').jqGrid('setRowData', id, {asignar: chk});
        }
        else if (data.seguimiento == "PROCESO") {
            $(this).css({"background-image": "none", "background-color": "#fcf8e3"});
        }
        else if (data.seguimiento == "ATENDIDO") {
            $(this).css({"background-image": "none", "background-color": "#dff0d8"});
        }
        $(this).hover(function() {
            $(this).css("color", "#444444");
        });
    });
}

$(document).ready(function() {
    
    $("#codigo_referencia").autocomplete({
        source:buscarPatrimonio ,
        minLength: 2,
        select: function(event, ui) {
            $("#codigo_referencia").data('id_patrimonio',ui.item.id);
        }

    });
    
    $('#tipo_solucion').change(function(){
        
        $('#categoria_solucion option').remove();
        $('#mot').hide();
        $('#mot').val('');
        
        if ($('#tipo_solucion').val() == 'SI SE SOLUCIONO'){
            $('#categoria_solucion').append('<option value="FALLA POR USUARIO">FALLA POR USUARIO</option>');
            $('#categoria_solucion').append('<option value="FALLA DEL EQUIPO">FALLA DEL EQUIPO</option>');
        }else{
            $('#categoria_solucion').append('<option value="FALLA DE FABRICA">FALLA DE FABRICA</option>');
            $('#categoria_solucion').append('<option value="OBSOLECENCIA">OBSOLECENCIA</option>');            
            $('#categoria_solucion').append('<option value="IRREPARABLE">IRREPARABLE</option>');            
        }
    });
    
    $('#categoria_solucion').change(function(){
        $('#mot').hide();
        $('#mot').val('');
        if ($('#categoria_solucion').val() == 'IRREPARABLE'){
            $('#mot').show();
        }
    });
    
    $('#cargar').button().click(function() {
        jQuery("#lstarea").jqGrid('setGridParam', {url: URLINDEX + "/tarea/listaTarea?id_personal=" + $('#id_personal').val(), page: 1});
        jQuery("#lstarea").trigger('reloadGrid');
    });

    $("#modalRegistro").dialog({
        autoOpen: false,
        width: 800,
        modal: true,
        buttons: {
            Finalizar: function() {
                $("#frm_tarea").submit();
            },
            Cancelar: function() {
                $("#modalRegistro").dialog("close");
            }
        },
        close: function() {
            limpiaForm($('#frm_tarea'), false);
        }
    });
    limpiaForm($('#frm_tarea'), false);
    $("#frm_tarea").validate({
        rules: {
            indicencia: {required: true},
            codigo_referencia: {required: true},
            tipo_solucion: {required: true},
            categoria_solucion: {required: true},
            tiempo_estimado: {required: true},
            tipo_efectividad: {required: true}
        },
        messages: {
            indicencia: {required: "Especifique Incidencia"},
            codigo_referencia: {required: "Ingrese Codigo de Referencia"},
            tiempo_estimado: {required: "Ingrese Tiempo Estimado"}
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
            Loading('Guardando...');
            $.post(
                    URLINDEX + '/tarea/guardar',
                    {
                        ajax: 'ajax',
                        codigo_referencia: $("#codigo_referencia").val().trim().toUpperCase(),
						id_patrimonio: $("#codigo_referencia").data('id_patrimonio'),
                        motivo_irreparable: $("#motivo_irreparable").val().trim().toUpperCase(),
                        tiempo_estimado: $("#tiempo_estimado").val().trim(),
                        observacion: $("#observacion").val().trim(),
                        tipo_solucion: $("#tipo_solucion").val().trim(),
                        categoria_solucion: $("#categoria_solucion").val().trim(),
                        tipo_efectividad: $("#tipo_efectividad").val().trim(),
                        id_tarea: $("#id_tarea").val().trim()
                    },
            function(response) {
                QuitarLoading();
                limpiaForm($('#frm_tarea'), false);
                if (response.code && response.code == 'ERROR') {
                    Mensaje(response.message, 'Error');
                } else {
                    jQuery('#lstarea').trigger('reloadGrid');
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
    $("#nuevo_tarea").button().click(function() {
        if ($("#id_personal").val().trim() != "0") {
            limpiaForm($('#frm_tarea'), true);
            $("#id_tarea").val(-1);
            $("#id_personal").val($("#id_personal").val().trim());
            var indexS = $('#id_personal').val().trim();
            if (indexS != null) {
                Loading('Cargando Datos...');
                $.get(
                        URLINDEX + '/tipo_averia/get',
                        {
                            ajax: 'ajax',
                            id_personal: indexS
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
    $("#modificar_tarea").button().click(function() {
        var indexR = jQuery('#lstarea').getGridParam("selrow");
        if (indexR != null) {
            limpiaForm($('#frm_tarea'), true);
            var data = $('#lstarea').getRowData(indexR);
            if (data.seguimiento == "PROCESO") {
                
                $("#id_tarea").val(indexR);
                $("#indicencia").val(data.descripcion);
                $("#id_averia").val(data.id_averia);
                
                var fecha_grilla = (data.fecha_asignacion + '').split('/');
                var hora_grilla = (data.hora_asignacion + '').split(':');
                
                var fecha_tarea = new Date(fecha_grilla[2], fecha_grilla[1] -1, fecha_grilla[0],hora_grilla[0],hora_grilla[1],0,0);
                var fecha_hoy = new Date();
                fecha_hoy.setSeconds(0);
                fecha_hoy.setMilliseconds(0);
                
                var fin = fecha_hoy.getTime() - fecha_tarea.getTime();
                var dias = Math.floor(fin / (1000 * 60 * 60 * 24))                 
                
                $.get(
                        URLINDEX + '/tarea/getIncidencia',
                        {
                            ajax: 'ajax',
                            id_tarea: indexR
                        },
                function(response) {
                    QuitarLoading();
                    
                    $('#tiempo_estimado_insidencia').val(response.response);
                    $('#tiempo_estimado').val(dias);                    
                    $('#tiempo_estimado').attr('readonly','readonly');
                    $('#tipo_efectividad').attr('disabled','disabled');
                    
                    if (dias < response.response){
                        $('#tipo_efectividad').val('E');
                    }
                    if (dias == response.response){
                        $('#tipo_efectividad').val('B');
                    }
                    if (dias > response.response){
                        $('#tipo_efectividad').val('M');
                    }
                    $("#modalRegistro").dialog("open");
                    
                },
                        'json'
                        );
                
            } else {
                Mensaje('Tarea ya fue Finalizada', 'Seleccione');
            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
    });
    $("#anular_tarea").button().click(function() {
        var indexR = jQuery('#lstarea').getGridParam("selrow");
        if (indexR != null) {

            if (confirm('Desea anular el registro')) {

                Loading('Anulando Datos...');

                $.get(
                        URLINDEX + '/tarea/anular',
                        {
                            ajax: 'ajax',
                            id_tarea: indexR
                        },
                function(response) {

                    QuitarLoading();
                    jQuery('#lstarea').trigger("reloadGrid");

                },
                        'json'
                        );

            }
        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');

    });
    
    $("#dlgDetalle").dialog({
        autoOpen: false,
        width: 800,
        modal: true,
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
    
    $("#detalle_tarea").button().click(function() {
        
        var indexR = jQuery('#lstarea').getGridParam("selrow");
        if (indexR != null) {
            
            Loading('Cargando Datos...');
            
            $.get(
                    URLINDEX + '/tarea/get',
                    {
                        ajax: 'ajax',
                        id_tarea: indexR
                    },
                    function(response) {
                        QuitarLoading();
                        
                        var data = $('#lstarea').getRowData(indexR);
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
                        $('#det_fecha').val(data.fecha_asignacion);
                        $('#det_hora').val(data.hora_asignacion);
                        $('#det_facultad').val(data['f.facu_descripcion']);
                        $('#det_ambiente').val(data.ambi_descripcion);
                        $('#det_ubicacion').val(data.ubic_descripcion);
                        $('#det_insidencia').val(data['descripcion']);
                        $('#det_tiempo').val(response.response.tiempo_estimado);
//                        $('#det_asignado').val(data.personal_nombres);
//                        
                        $('#det_observaciones').val(response.response.averia.observacion);
                        $('#det_imagen').attr('src','../archivos/' + response.response.averia.imagen);
                        $("#div_mapa").empty();
                       // $("#div_mapa").append("hola");
                        $("#div_mapa").append("<img src='../images/unsm.jpg' width='300px' heigth='370px' ></img>");
                        $("#div_mapa").append("<img src='../images/efix.png' width='20px' heigth='20px' style='"+ response.response.averia.position +"' ></img>");

                        $("#dlgDetalle").dialog("open");
                    },
                    'json'
            );

        } else
            Mensaje('Seleccione un valor de la grilla', 'Seleccione');
        
    });
    
});

buscarPatrimonio = function (request, response){
    $.post(
        URLINDEX + "/tarea/getCodigoPatrimonial",
        {
            ajax:'ajax',
            term: request.term
        },
        function(r){
            if ( r.response.length == 0 ) 
                return false;

            $.each( r.response, function(i){
                    this.label = this.codigo_patrimonial + " - " + this.descripcion;
                    this.id = this.id_patrimonio;
                    this.value = this.codigo_patrimonial;
            });

            response(r.response);

            },'json'
        );
};