<?php /* Smarty version 3.0rc1, created on 2014-10-20 10:13:39
         compiled from "./templates/averia/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148051886544526a39c7602-95234922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '834967937e57722dc3c7d4c58b455cd99cbfc6ec' => 
    array (
      0 => './templates/averia/form.tpl',
      1 => 1413670641,
    ),
  ),
  'nocache_hash' => '148051886544526a39c7602-95234922',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/averia.js"></script>
<script type="text/javascript">
    <?php echo $_smarty_tpl->getVariable('grilla')->value;?>

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
                                <?php  $_smarty_tpl->tpl_vars["facu"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('facultad')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["facu"]->key => $_smarty_tpl->tpl_vars["facu"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('facu')->value->facu_id;?>
" ><?php echo $_smarty_tpl->getVariable('facu')->value->facu_descripcion;?>
</option>
                                <?php }} ?>
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
                    <?php  $_smarty_tpl->tpl_vars["facu"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('personal')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["facu"]->key => $_smarty_tpl->tpl_vars["facu"]->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('facu')->value->id_personal;?>
" ><?php echo $_smarty_tpl->getVariable('facu')->value->nombres;?>
 <?php echo $_smarty_tpl->getVariable('facu')->value->apellido_paterno;?>
 <?php echo $_smarty_tpl->getVariable('facu')->value->apellido_materno;?>
</option>
                    <?php }} ?>
                </select> 
            </td>
        </tr>
    </table>
</div>
                
<div id="dlgDetalle" title="Detalle Averia">

    <div style="background-color: #00FF00;padding: 5px;font-size: 16px;font-weight: bold;text-align: center;" id="txt_estado">
        
    </div>
    
    <table>
		<tr>
			<td>
			
				<table style="width: 450px">
					<tr>
						<td>
							<label></label>
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
						
					</div>
			</td>
		</tr>
	</table>
</div>