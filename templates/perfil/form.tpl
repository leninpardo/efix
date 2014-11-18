
 {include file=$links}

<script type="text/javascript" src="{$HOST}js/modulos/perfil.js"></script>

<script type="text/javascript">

{$grilla}

</script>


<div style="width: 100%">
    
    <div style="width: 410px;float: left">
        
        <table id="lsperfil"></table>
        <div id="pgperfil"></div>
        
        
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>
            
            <button id="nuevo_perfil">Nuevo</button>
            <button id="modificar_perfil">Modificar</button>
            <button id="anular_perfil">Anular</button>
        </fieldset>
        
    </div>
    
    <div style="width: 400px;float: left" >
        
    <fieldset class="ui-widget ui-widget-content"> 
      <legend class="ui-widget-header ui-corner-all">Datos</legend>
        
        <form action="/index.php/perfil/guardar" title="Administrar Perfiles" method="post" id="frm_perfil" class="formulario ">

            <table style="width: 100%">
                <tr>
                    <td>
                        <label class="required" for="descripcion">Descripcion</label>
                        <br/>
                        <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style=";width: 100%"/>
                    </td>
                </tr>
            </table>
            
            <input type="hidden" name="id_perfil" id="id_perfil" value ="-1"/>
            
            <span id="load"></span>
            
        </form>
      
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="guardar_perfil" value="Guardar" />
            <input type="button" id="cancelar_perfil" value="Cancelar" />
        </fieldset>
        
    </fieldset>
    
    </div>
    
</div>



