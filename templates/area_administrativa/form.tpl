{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/area_administrativa.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lsarea_administrativa"></table>
        <div id="pgarea_administrativa"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_area_administrativa">Nuevo</button>
            <button id="modificar_area_administrativa">Modificar</button>
            <button id="anular_area_administrativa">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Area Administrativa...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/area_administrativa/guardar" title="Administrar Areas Administrativas" method="post" id="frm_area_administrativa" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>                                             
                    <tr>
                        <td colspan="3">
                            <label class="required" for="tipo_averia">Tipo Averia</label>
                            <br/>
                            <select name="id_tipoaveria" id="id_tipoaveria" style="width: 100%" title="Seleccione tipo" >
                                {foreach from=$tipo_averia item="perf"}
                                    <option value="{$perf->id_tipoaveria}" >{$perf->descripcion}</option>
                                {/foreach}
                            </select> 
                        </td>
                    </tr>
                </table>

                <input type="hidden" name="id_area" id="id_area" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>