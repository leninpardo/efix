{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/tipo_averia.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lstipo_averia"></table>
        <div id="pgtipo_averia"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_tipo_averia">Nuevo</button>
            <button id="modificar_tipo_averia">Modificar</button>
            <button id="anular_tipo_averia">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Tipo de Averia...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/tipo_averia/guardar" title="Administrar Tipos de Averia" method="post" id="frm_tipo_averia" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>                                             
                </table>

                <input type="hidden" name="id_tipoaveria" id="id_tipoaveria" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>