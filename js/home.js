$(document).ready(function() {
     $("#codigo_referencia").change(function(){
        /* str="&ajax=ajax&term="+$(this).val();
        $.post("index.php","/tarea/getCodigoPatrimonial"+str,function(data){
          alert(data.descripcion)  
        },'json');*/
              $.post(
                      'index.php/tarea/getCodigoPatrimonial',
                    {
                        
                        ajax:'ajax',
                       term: $(this).val()
                    },
            function(response) {
               
          
                  $.each( response.response, function(i){
                    $("#descripcion").val(this.descripcion);
            });
                
                
            },
                    'json'
                    );
     });
    
    $('#inicio_sesion').on('submit',function(){
        
        if ( $('#login').val() == '' ) {
            $('#mensaje_session').find('span').text('Ingrese su usuario');
            $('#mensaje_session').show();
            $('#login').focus();
            return false;
        }
        if ( $('#clave').val() == '' ) {
            $('#mensaje_session').find('span').text('Ingrese su clave');
            $('#mensaje_session').show();
            $('#clave').focus();
            return false;
        }
        
    });
   
    $('#frm_registrese').on('submit',function(){
        
        if ( $('#dni').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su dni');
            $('#mensaje_registro').show();
            $('#dni').focus();
            return false;
        }
        if ( isNaN($('#dni').val()) ) {
            $('#mensaje_registro').find('span').text('Ingrese solo numeros');
            $('#mensaje_registro').show();
            $('#dni').focus();
            return false;
        }
        if ( $('#nombres').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su nombre');
            $('#mensaje_registro').show();
            $('#nombres').focus();
            return false;
        }
        if ( $('#apellido_paterno').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su apellido paterno');
            $('#mensaje_registro').show();
            $('#apellido_paterno').focus();
            return false;
        }
        if ( $('#apellido_materno').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su apellido materno');
            $('#mensaje_registro').show();
            $('#apellido_materno').focus();
            return false;
        }
        if ( $('#correo').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su correo');
            $('#mensaje_registro').show();
            $('#correo').focus();
            return false;
        }
        if ( $('#correo').val().indexOf('@') >= 1 ) {
            $('#mensaje_registro').find('span').text('Ingrese solo el usuario de correo');
            $('#mensaje_registro').show();
            $('#correo').focus();
            return false;
        }
        if ( $('#clave_re').val() == '' ) {
            $('#mensaje_registro').find('span').text('Ingrese su clave');
            $('#mensaje_registro').show();
            $('#clave_re').focus();
            return false;
        }
        if ( $('#clave_re2').val() != $('#clave_re').val() ) {
            $('#mensaje_registro').find('span').text('Las claves deben ser iguales');
            $('#mensaje_registro').show();
            $('#clave_re2').focus();
            return false;
        }
        
        
    });
    
    $('#facu_id').change(function(){
        
        $('#ubic_id').empty();
        $('#ubic_id').append('<option value="0">.: SELECCIONE UBICACION :.</option>');
            
        if ($(this).val() != '0'){
            
            $('#ambi_id').empty();
            $('#ambi_id').append('<option value="0">CARGANDO...</option>');
            
            $.post(
                    'index.php/ambiente/getAmbientesForFacultad',
                    {
                        ajax: 'ajax',
                        id_facultad: $("#facu_id").val().toUpperCase()
                    },
            function(response) {
                $('#ambi_id').empty();
                $('#ambi_id').append('<option value="0">.: SELECCIONE AMBIENTE :.</option>');
                $(response.response).each(function(idx,obj){
                    $('#ambi_id').append('<option value="' + obj.ambi_id + '">' + obj.ambi_descripcion + '</option>');
                });
                
            },
            'json'
            );
            
        }else{
            $('#ambi_id').empty();
            $('#ambi_id').append('<option value="0">.: SELECCIONE AMBIENTE :.</option>');
        }
        
    });
    
    $('#ambi_id').change(function(){
        
        $('#ubic_id').empty();
        $('#ubic_id').append('<option value="0">.: SELECCIONE UBICACION :.</option>');
            
        if ($(this).val() != '0'){
            
            $('#ubic_id').empty();
            $('#ubic_id').append('<option value="0">CARGANDO...</option>');
            
            $.post(
                    'index.php/ubicacion/getUbicacion',
                    {
                        ajax: 'ajax',
                        ambi_id: $("#ambi_id").val().toUpperCase()
                    },
            function(response) {
                $('#ubic_id').empty();
                $('#ubic_id').append('<option value="0">.: SELECCIONE UBICACION :.</option>');
                $(response.response).each(function(idx,obj){
                    $('#ubic_id').append('<option value="' + obj.ubic_id + '">' + obj.ubic_descripcion + '</option>');
                });
                
            },
            'json'
            );
            
        }
        
    });
    
    $('#id_tipoaveria').change(function(){
        
        $('#id_incidencia').empty();
        $('#id_incidencia').append('<option value="0">.: SELECCIONE INCIDENCIA :.</option>');
            
        if ($(this).val() != '0'){
            
            $('#id_incidencia').empty();
            $('#id_incidencia').append('<option value="0">CARGANDO...</option>');
            
            $.post(
                    'index.php/incidencia/getInsidencia',
                    {
                        ajax: 'ajax',
                        id_tipoaveria: $("#id_tipoaveria").val().toUpperCase()
                    },
            function(response) {
                $('#id_incidencia').empty();
                $('#id_incidencia').append('<option value="0">.: SELECCIONE INCIDENCIA :.</option>');
                $(response.response).each(function(idx,obj){
                    $('#id_incidencia').append('<option value="' + obj.id_incidencia + '">' + obj.descripcion + '</option>');
                });
                
            },
            'json'
            );
            
        }
        
    });
    
    $('#registro_averia').on('submit',function(){
        
        if ( $('#facu_id').val() == '0' ) {
            $('#mensaje_averia').find('span').text('Seleccione facultad');
            $('#mensaje_averia').show();
            $('#facu_id').focus();
            return false;
        }
        if ( $('#ambi_id').val() == '0' ) {
            $('#mensaje_averia').find('span').text('Seleccione ambiente');
            $('#mensaje_averia').show();
            $('#ambi_id').focus();
            return false;
        }
        if ( $('#ubic_id').val() == '0' ) {
            $('#mensaje_averia').find('span').text('Seleccione ubicacion');
            $('#mensaje_averia').show();
            $('#ubic_id').focus();
            return false;
        }
        if ( $('#id_tipoaveria').val() == '0' ) {
            $('#mensaje_averia').find('span').text('Seleccione tipo de averia');
            $('#mensaje_averia').show();
            $('#id_tipoaveria').focus();
            return false;
        }
        if ( $('#id_incidencia').val() == '0' ) {
            $('#mensaje_averia').find('span').text('Seleccione insidencia');
            $('#mensaje_averia').show();
            $('#id_incidencia').focus();
            return false;
        }
        if ( $('#observaiones').val() == '' ) {
            $('#mensaje_averia').find('span').text('Ingrese observaciones');
            $('#mensaje_averia').show();
            $('#observaiones').focus();
            return false;
        }
        
    });
    
    $('#solucion').click(function(){
        $('#dlgSolucion').modal('show');
    });
    $('#env_ave').click(function(){
        $('#dlgExiste').modal('hide');
        alert('La incidencia fue envia correctamente');
        window.location.reload();
    });
    $('#id_incidencia').change(function(){
            $('#solucion').hide();
            $.post(
                    'index.php/incidencia/getExiste',
                    {
                        ajax: 'ajax',
                        id_incidencia: $("#id_incidencia").val().toUpperCase(),
                        ubic_id: $("#ubic_id").val().toUpperCase()
                    },
            function(response) {
                
                if (response.response.con_solucion == 'SI'){
                    $('#solucion').show();
                    $('#texto').html(response.response.solucion);
                }else{
                    $('#solucion').hide();
                }
                
                if (response.response.respuesta == 'SI'){
                    
                    $('#comen').html(response.response.obs_averia);
                    $('#imginci').attr('src','archivos/' + response.response.img_averia);
                    $('#dlgExiste').modal('show');
//                    if(confirm("Se encontro una incidencia\n¿Desea volver a reportarla?")){
//                        
//                                alert('La incidencia fue envia correctamente');
//                                window.location.reload();
//                        
//                    }
                }
                
            },
            'json'
            );
    });
    
    $('.rating').each(function(idx,obj){
        
        var id_averia = $(obj).attr('id_averia');
        var valor = $(obj).attr('valor');
        
        $('#rat_' + id_averia ).rating('index.php/incidencia/calificar', {maxvalue: 5, curvalue:valor, id:id_averia});
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