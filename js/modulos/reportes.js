/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(inicio);

/*function inicio(){
    $("#contentLoading").fadeOut("fast");
    
    $("#desde").datepicker();
    $("#hasta").datepicker();
    
    $('#cargar').button().click(function(){
        if ($('#desde').val() == ''){
            Mensaje('Seleccione fecha desde');
            return;
        }
        if ($('#hasta').val() == ''){
            Mensaje('Seleccione fecha hasta');
            return;
        }
        
        var src = URLINDEX + '/reportes/showAverias?desde=' + $('#desde').val() + '&hasta=' + $('#hasta').val()
        + '&id_tipoaveria=' + $('#id_tipoaveria').val() + '&facu_id=' + $('#facu_id').val() + '&estado=' + $('#estado').val();
        
        $('#reporte').attr('src',src);
    });
    
    $('#cargarGrafico').button().click(function(){
        if ($('#desde').val() == ''){
            Mensaje('Seleccione fecha desde');
            return;
        }
        if ($('#hasta').val() == ''){
            Mensaje('Seleccione fecha hasta');
            return;
        }
        
        var src = URLINDEX + '/reportes/showAveriasGrafico?desde=' + $('#desde').val() + '&hasta=' + $('#hasta').val()
        + '&id_tipoaveria=' + $('#id_tipoaveria').val() + '&facu_id=' + $('#facu_id').val() + '&estado=' + $('#estado').val();
        
        $('#reporte').attr('src',src);
    });
    
    $('#cargar2').button().click(function(){
        if ($('#desde').val() == ''){
            Mensaje('Seleccione fecha desde');
            return;
        }
        if ($('#hasta').val() == ''){
            Mensaje('Seleccione fecha hasta');
            return;
        }
        
        var src = URLINDEX + '/reportes/showAveriasTecnico?desde=' + $('#desde').val() + '&hasta=' + $('#hasta').val()
        + '&id_tipoaveria=' + $('#id_tipoaveria').val() + '&id_personal=' + $('#id_personal').val() + '&estado=' + $('#estado').val();
        
        $('#reporte').attr('src',src);
    });


    $("#imprime").button(function (){
        alert("hola");
    $("div#reporte").printArea();
    });

}*/