{include file=$links}

<link type="text/css" rel="stylesheet" media="screen" href="{$HOST}css/jquery-te-1.4.0.css"/>

<script type="text/javascript" src="{$HOST}js/jquery-te-1.4.0.min.js"></script>
<script type="text/javascript" src="{$HOST}js/modulos/incidencia.js"></script>

<script type="text/javascript">{$grilla}</script>

<div style="width: 100%">    
    <div>    
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Filtro</legend>            
            <table>
                <tr>
                    <td>
                        <label>Tipo Averia</label>
                    </td>
                    <td>
                        <select name="id_tipoaveria" id="id_tipoaveria" style="width: 200px;" title="Seleccione Tipo Averia">
                            <option value="0">-Seleccione-</option>
                            {foreach from=$tipo_averia item="tiav"}
                                <option value="{$tiav->id_tipoaveria}" >{$tiav->descripcion}</option>
                            {/foreach}
                        </select>
                    </td>                    
                    <td>
                        <button id="cargar">Cargar</button>
                    </td>
                </tr>
            </table>
        </fieldset>   
        <br/>
        <table id="lsincidencia"></table>
        <div id="pgincidencia"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_incidencia">Nuevo</button>
            <button id="modificar_incidencia">Modificar</button>
            <button id="anular_incidencia">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Incidencia...">
            <form action="/index.php/incidencia/guardar" title="Administrar Incidencias" method="post" id="frm_incidencia" class="formulario ">
                <fieldset class="ui-widget ui-widget-content"> 
                <table style="width: 100%">
                     <tr>                    
                         <td colspan="2"><label class="required" for="tipoaveria">TIPO AVERIA</label>
                            <br/>
                            <input type="text" name="tipoaveria" id="tipoaveria" class="text ui-widget-content ui-corner-all" style="width: 100%; background: #F5F5F5 none;" disabled=""/>
                        </td>                       
                     </tr>                     
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label class="required" for="descripcion">DESCRIPCION</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>                           
                    <tr>
                        <td>
                            <label  class="required"  for="tiempo_estimado">TIEMPO SOLUCION (dias)</label>
                            <br/>
                            <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>                        
                    </tr>  
                    <tr>
                        <td>
                            <label for="posible_solucion">POSIBLE SOLUCION</label>
                            <br/>
                            <textarea  name="posible_solucion" id="posible_solucion" rows="8" class="text ui-widget-content ui-corner-all" style="width: 100%;resize: none;"></textarea>                    
                        </td>
                    </tr> 
                    <input type="hidden" name="id_incidencia" id="id_incidencia" value ="-1"/>
                    <input type="hidden" name="id_tipoaveria" id="id_tipoaveria" value ="-1"/>
                </table>
                </fieldset>
                <span id="load"></span>
            </form>    
    </div>
</div>