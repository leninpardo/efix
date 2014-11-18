/* 
 * @description Clase de Creacion de Login Externo 
 * @class loginOther
 * @type JS
 * @autor Ericson Valles Barrera
 * @access Private
 */
var FN = {
  isfunction:false,
  dataArray:null
};
(function($) {
  loginOther={
      init:function(){
          this.fnAceptar=null;
          var cadLogin="<div id='loginOther' title='Ingreso de Credenciales Privadas'>";
          cadLogin+="<div class='ui-widget-content-ui-corner-all'>";
          cadLogin+="<h2 class='ui-widget-header ui-corner-all' style='font-size:12px;color:red;'>Ingreso de Credenciales</h2>";
          cadLogin+="<label  for='clave231290'>Clave</label>";
          cadLogin+="<input type='password' name='clave231290' id='clave231290' class='ui-widget-content ui-widget-text ui-corner-all'/>";
          cadLogin+="<div style='clear: both'>";
          cadLogin+="<p class='load231290'><img alt='' src='/images/ajax-loader.gif'>Verificando Credenciales...</p>";
          $('body').append(cadLogin);
          this.frmLogin = $('#loginOther');
          this.cargando = $('.load231290');
          this.cargando.css('display','none');
          this.frmLogin.dialog({
              title:'Ingreso de Credenciales',
              width:'250px',
              autoOpen:false,
              modal:true,
              resizable: false,
              buttons:{
                  "Aceptar":function(){
                     loginVerify($("#clave231290").attr("value"));
                  },
                  "Cancelar":function(){
                      $(this).dialog("close");
                  }
              },
            close: function() {
                $('#clave231290').val('');
            }
          });
          $("#clave231290").keyup(function(e){
              tecla = (document.all) ? e.keyCode : e.which; // 2
              if(tecla==13)loginVerify($("#clave231290").attr("value"));
          });
          
    },
    mostrarLogin:function(){
        $("#loginOther").dialog("open");
    },
    setData:function(dataArray){
        FN.isfunction = true;
        FN.dataArray=dataArray;
    }
  }
})(jQuery);
loginVerify=function(password){
 $.post("/index.php/lockPassword",{clave231290:password},function(response){
       if(response.code==true){
              if(FN.isfunction){
                    var fn = FN.dataArray;
                    eval(fn);
                    $("#loginOther").dialog("close");
              }
       }else Mensaje(response.message,"<span style='color:red;'>ERROR</span>",function(){$("#clave231290").focus();})
                          
                      },'json');
}

