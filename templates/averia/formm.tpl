{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/averia.js"></script>
<script type="text/javascript">
    {$grilla}
</script>
<div style="width: 100%">    
    <div>        
        <table id="lsaveria"></table>
        <div id="pgaveria"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <!--<button id="nuevo_averia">Nuevo</button>
            <button id="modificar_averia">Modificar</button>-->
            <button id="anular_averia">Anular</button>
            <button id="asignar_averia">Asignar</button>
            <button id="detalle_averia">Detalle</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Averia...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/averia/guardar" title="Administrar Averias" method="post" id="frm_averia" class="formulario ">
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

                <input type="hidden" name="id_averia" id="id_averia" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>
                            
<div id="dlgAsignar" title="Asignar Averias" style="display: none;">
    <table>
        <tr>
            <td>
                <label>Tecnico</label>
            </td>
            <td>
                <select name="id_personal" id="id_personal" style="width: 300px;" title="Seleccione personal">
                    {foreach from=$personal item="facu"}
                        <option value="{$facu->id_personal}" >{$facu->nombres} {$facu->apellido_paterno} {$facu->apellido_materno}</option>
                    {/foreach}
                </select> 
            </td>
        </tr>
    </table>
</div>
                
<div id="dlgDetalle" title="Detalle Averia">

    <div style="background-color: #00FF00;padding: 5px;font-size: 16px;font-weight: bold;text-align: center;" id="txt_estado">
        
    </div>
    
    <table style="width:900px">
		<tr>
			<td>
			
				<table style="width: 450px">
					<tr>
						<td>
							<label>Fecha</label>
						</td>
						<td>
							<input type="text" name="det_fecha" id="det_fecha" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
						<td>
							<label>Hora</label>
						</td>
						<td>
							<input type="text" name="det_hora" id="det_hora" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Facultad</label>
						</td>
						<td>
							<input type="text" name="det_facultad" id="det_facultad" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
						<td>
							<label>Ambiente</label>
						</td>
						<td>
							<input type="text" name="det_ambiente" id="det_ambiente" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Ubicacion</label>
						</td>
						<td>
							<input type="text" name="det_ubicacion" id="det_ubicacion" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
						<td>
							<label>Insidencia</label>
						</td>
						<td>
							<input type="text" name="det_insidencia" id="det_insidencia" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Tiempo (DIAS)</label>
						</td>
						<td>
							<input type="text" name="det_tiempo" id="det_tiempo" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>
						</td>
						<td>
			<!--                <label>Asignado A</label>-->
						</td>
						<td>
			<!--                <input type="text" name="det_asignado" id="det_asignado" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="readonly"/></td>-->
						</td>
					</tr>
					<tr>
						<td>
							<label>Observaciones</label>
						</td>            
						<td colspan="3">
							<textarea name="det_observaciones" id="det_observaciones" rows="4" cols="20" style="width: 100%;" readonly="readonly"></textarea>
						</td>
						
					</tr>
				</table>
				
			</td>
		
				<td>		
					<img src="#"  alt="Imagen de la averia" style="width: 80%;height: 190px;" id="det_imagen" class="img-responsive">		
				</td>
		</tr>	
	</table>
	<div id="div_mapa"></div>
</div>
