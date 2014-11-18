{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/patrimonio.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lspatrimonio"></table>
        <div id="pgpatrimonio"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_patrimonio">Nuevo</button>
            <button id="modificar_patrimonio">Modificar</button>
            <button id="anular_patrimonio">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Tipo de Averia...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/patrimonio/guardar" title="Administrar patrimonio" method="post" id="frm_patrimonio" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="codigo_patrimonial">Codigo Patrimonial</label>
                            <br/>
                            <input type="text" name="codigo_patrimonial" id="codigo_patrimonial" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>
<tr>
    <td>Estado:</td><td>
    <select name='estado' id='estado'>
        <option value='MALO'>Malo</option>
        <option value='REGULAR'>Regular</option>
           <option value='BUENO'>Bueno</option>
              <option value='MUY BUENO'>Muy Bueno</option>
    </select>
</td></tr>
                </table>

                <input type="hidden" name="id_patrimonio" id="id_patrimonio" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>