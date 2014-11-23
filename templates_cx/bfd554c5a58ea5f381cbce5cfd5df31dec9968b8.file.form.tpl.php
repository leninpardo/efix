<?php /* Smarty version 3.0rc1, created on 2014-07-07 01:51:20
         compiled from ".\templates\tarea/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1869153ba4368901799-56164256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfd554c5a58ea5f381cbce5cfd5df31dec9968b8' => 
    array (
      0 => '.\\templates\\tarea/form.tpl',
      1 => 1404715876,
    ),
  ),
  'nocache_hash' => '1869153ba4368901799-56164256',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/tarea.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>   
        <?php if ($_smarty_tpl->getVariable('usuario')->value['id_personal']==0){?>
            <fieldset class="ui-widget ui-widget-content" style="margin-top: 2px;margin-bottom: 3px;">
                <legend class="ui-widget-header ui-corner-all">Filtro</legend>            
                <table>
                    <tr>
                        <td>
                            <label>Tipo Averia</label>
                        </td>
                        <td>
                            <select name="id_personal" id="id_personal" style="width: 600px;" title="Seleccione Tipo Averia">
                                <option value="0">-Seleccione-</option>
                                <?php  $_smarty_tpl->tpl_vars["pers"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('personal')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["pers"]->key => $_smarty_tpl->tpl_vars["pers"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('pers')->value->id_personal;?>
" ><?php echo $_smarty_tpl->getVariable('pers')->value->nombres;?>
 <?php echo $_smarty_tpl->getVariable('pers')->value->apellido_paterno;?>
 <?php echo $_smarty_tpl->getVariable('pers')->value->apellido_materno;?>
</option>
                                <?php }} ?>
                            </select>
                        </td>                    
                        <td>
                            <button id="cargar">Cargar</button>
                        </td>
                    </tr>
                </table>
            </fieldset>           
        <?php }?>
                        
        <table id="lstarea"></table>
        <div id="pgtarea"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="modificar_tarea">Finalizar</button>
            <button id="detalle_tarea">Detalle</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Tarea...">
            <form action="/index.php/tarea/guardar" title="Administrar Tareas" method="post" id="frm_tarea" class="formulario ">
                <fieldset class="ui-widget ui-widget-content"> 
                <table style="width: 100%">
                     <tr>                    
                         <td colspan="2"><label class="required" for="indicencia">INCIDENCIA</label>
                            <br/>
                            <input type="text" name="indicencia" id="indicencia" class="text ui-widget-content ui-corner-all" style="width: 100%; background: #F5F5F5 none;" readonly=""/>
                        </td>                       
                     </tr>                     
                </table>
                <table style="width: 100%">
                     <tr>                    
                        <td>
                            <label class="required" for="indicencia">RESULTADO ATENCION</label>
                            <br/>
                            <select name="tipo_solucion" id="tipo_solucion" style="width: 100%" title="Seleccione Resultado Atencion">
                                <option value="SI SE SOLUCIONO">SI SE SOLUCIONO</option>
                                <option value="NO SE SOLUCIONO">NO SE SOLUCIONO</option>
                            </select>
                        </td>
                        <td>
                            <label class="required" for="indicencia">CATEGORIA FALLA</label>
                            <br/>
                            <select name="categoria_solucion" id="categoria_solucion" style="width: 100%" title="Seleccione categoria falla">
                            </select>                            
                        </td>
                     </tr>                     
                </table>
                <table style="width: 100%">
                    <tr id="mot" style="display: none;">
                        <td>
                            <label class="required" for="motivo_irreparable">MOTIVO IRREPARABLE</label>
                            <br/>
                            <input type="text" name="motivo_irreparable" id="motivo_irreparable" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label class="required" for="codigo_referencia">CODIGO REFERENCIA (PATRIMONIAL)</label>
                            <br/>
                            <input type="text" name="codigo_referencia" id="codigo_referencia" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>                           
                    <tr>
                        <td>
                            <label  class="required"  for="tiempo_estimado">TIEMPO SOLUCION (dias)</label>
                            <br/>
                            <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="text ui-widget-content ui-corner-all" style="width: 100%;background: #F5F5F5 none;" readonly=""/>                    
                        </td>                        
                    </tr>  
                    <tr>
                        <td>
                            <label  class="required"  for="tipo_efectividad">TIPO CALIFICACION</label>
                            <br/>
                            <select name="tipo_efectividad" id="tipo_efectividad" style="width: 100%;background: #F5F5F5 none;" disabled="true">
                                <option value="E">EXCELENTE</option>
                                <option value="B">BUENO</option>
                                <option value="M">MALO</option>
                            </select>
                        </td>                        
                    </tr> 
                    <tr>
                        <td>
                            <label for="observacion">OBSERVACIONES</label>
                            <br/>
                            <textarea  name="observacion" id="observacion" rows="5" class="text ui-widget-content ui-corner-all" style="width: 100%;resize: none;"></textarea>                    
                        </td>
                    </tr> 
                    <input type="hidden" name="id_tarea" id="id_tarea" value ="-1"/>
                    <input type="hidden" name="id_averia" id="id_averia" value ="-1"/>
                    <input type="hidden" name="tiempo_estimado_insidencia" id="tiempo_estimado_insidencia" value ="-1"/>
                </table>
                </fieldset>
                <span id="load"></span>
            </form>    
    </div>
</div>
        
<div id="dlgDetalle" title="Detalle Averia">

    <div style="background-color: #00FF00;padding: 5px;font-size: 16px;font-weight: bold;text-align: center;" id="txt_estado">
        aasass
    </div>
    <table>
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
					<tr>
						<td>
							<label>Imagen</label>
						</td>            
						<td colspan="3">
							<img src="#"  alt="Imagen de la averia" style="width: 100%;height: 200px;" id="det_imagen"> 
						</td>
					</tr>
				</table>
			
			</td>
			<td>
          
            <div id="div_mapa">
                        <img src="../images/unsm.jpg" style="width: 300px;height: 370px;"/>
                    </div>
				
			</td>
		</tr>
	</table>
    
</div>