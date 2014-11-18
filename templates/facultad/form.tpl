{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/facultad.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lsfacultad"></table>
        <div id="pgfacultad"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_facultad">Nuevo</button>
            <button id="modificar_facultad">Modificar</button>
            <button id="coordenada_facultad">Coordenadas</button>
            <button id="anular_facultad">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Facultad...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/facultad/guardar" title="Administrar Lugares" method="post" id="frm_facultad" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr> 
                    <tr>
                           <td colspan="2">
                            <label  class="required" for="tipo_id">Tipo</label>
                            <br/>
                            <select name="tipo_id" id="tipo_id" style="width: 100%" title="Seleccione " >
                                {foreach from=$tipo item="tip"}
                                    <option value="{$tip->tipo_id}" >{$tip->descripcion}</option>
                                {/foreach}
                            </select> 
                        </td>
                    </tr>
                </table>

                <input type="hidden" name="id_facultad" id="id_facultad" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>    
    <div id="modalCoordenada" title="Coordenadas...">        
            <form action="/index.php/facultad/guardarCoordenada" title="Administrar Coordenadas" method="post" id="frm_facultad_coordenada" class="formulario ">
                    <label class="required" for="facultad">Facultad</label>
                    <input type="text" name="facultad" id="facultad" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="" />                   
                    <table style="width: 100%">    
                        <tr>
                            <td >
                                Latitud: <input type="text" name="latitud" id="latitud" class="text ui-widget-content ui-corner-all" style="width: 60%"/>                   
                            </td>                   
                            <td >
                                Longitud: <input type="text" name="longitud" id="longitud"  class="text ui-widget-content ui-corner-all" style="width: 50%"/>                   
                                <button id="agregar_coordenada">Agregar</button>
                            </td>
                        </tr>
                    </table>
                    <script type="text/javascript">{$grillaCoordenada}</script>
                    <table id="lscoordenada"></table>
                    <div id="pgcoordenada"></div> 
                    <input type="hidden" name="id_facultad" id="id_facultad" value ="-1"/>
                    <span id="load"></span>
            </form>
    </div>
</div>