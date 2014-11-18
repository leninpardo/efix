 {include file=$links}
 
<script type="text/javascript" src="{$HOST}js/modulos/modulo.js"></script>
<script type="text/javascript">{$grilla}</script>


<div style="width: 100%">    
    <div style="width: 410px;float: left">        
        <table id="lsmodulo"></table>
        <div id="pgmodulo"></div>       
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>
            <button id="nuevo_modulo">Nuevo</button>
            <button id="modificar_modulo">Modificar</button>
            <button id="anular_modulo">Anular</button>
        </fieldset>
    </div>
    
    <div style="width: 400px;float: left" >        
    <fieldset class="ui-widget ui-widget-content"> 
      <legend class="ui-widget-header ui-corner-all">Datos</legend>        
        <form action="/index.php/Modulo/guardar" title="Administrar Modulo" method="post" id="frm_Modulo" class="formulario ">

            <table style="width: 100%">
                <tr>
                    <td>
                        <label class="required" for="descripcion">Descripcion</label>
                        <br/>
                        <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required"  for="url">Url</label>
                        <br/>
                        <input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" style="text-transform: none;width: 100%" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required" for="descripcion">Dependencia</label>
                        <br/>
                        <select name="id_padre" id="id_padre" style="width: 100%" title="Seleccione dependencia">
                            <option value="0" >-Ninguno-</option>
                            {foreach from=$dependencias item="d"}
                                <option value="{$d->modu_id}" >{$d->modu_descripcion}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required"  for="url">Orden</label>
                        <br/>
                        <input type="text" name="peso" id="peso" class="text ui-widget-content ui-corner-all" style="text-transform: none;width: 20%" onkeypress="return validarNumeros(event)" />
                    </td>
                </tr>
            </table>
            
            <input type="hidden" name="id_modulo" id="id_modulo" value ="-1"/>
            
            <span id="load"></span>
            
        </form>
      
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="guardar_modulo" value="Guardar" />
            <input type="button" id="cancelar_modulo" value="Cancelar" />
        </fieldset>
        
    </fieldset>
    
    </div>
    
</div>



