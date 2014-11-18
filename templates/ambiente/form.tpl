{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/ambiente.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lsambiente"></table>
        <div id="pgambiente"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_ambiente">Nuevo</button>
            <button id="modificar_ambiente">Modificar</button>
            <button id="anular_ambiente">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Ambiente...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/ambiente/guardar" title="Administrar Ambientes" method="post" id="frm_ambiente" class="formulario ">
                <table style="width: 100%">
                     <tr>                    
                        <td><label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%" maxlength="300"/></td>
                    </tr>                   
                    <tr>
                        <td colspan="2">
                            <label  class="required" for="id_facultad">Facultad</label>
                            <br/>
                            <select name="id_facultad" id="id_facultad" style="width: 100%" title="Seleccione Facultad">
                                {foreach from=$facultad item="facu"}
                                    <option value="{$facu->facu_id}" >{$facu->facu_descripcion}</option>
                                {/foreach}
                            </select> 
                        </td>
                    </tr>                
                </table>

                <input type="hidden" name="id_ambiente" id="id_ambiente" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>