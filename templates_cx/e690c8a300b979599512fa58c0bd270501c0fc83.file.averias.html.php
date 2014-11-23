<?php /* Smarty version 3.0rc1, created on 2014-07-01 00:29:12
         compiled from "./templates/reportes/averias.html" */ ?>
<?php /*%%SmartyHeaderCode:44771726053b24728abaa11-21583709%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e690c8a300b979599512fa58c0bd270501c0fc83' => 
    array (
      0 => './templates/reportes/averias.html',
      1 => 1404192539,
    ),
  ),
  'nocache_hash' => '44771726053b24728abaa11-21583709',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/reportes.js"></script>

<fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
    <legend class="ui-widget-header ui-corner-all">Filtro</legend>            
    <table>
        <tr>
            <td>
                <label>Desde</label>
            </td>
            <td>
                <input type="text" id="desde" name="desde" value="" style="width: 100px;"/>
            </td>                    
            <td>
                <label>Hasta</label>
            </td>
            <td>
                <input type="text" id="hasta" name="hasta" value="" style="width: 100px;"/>
            </td>
            <td>
                <label>Tipo Averia</label>
            </td>
            <td>
                <select name="id_tipoaveria" id="id_tipoaveria" style="width: 200px;" title="Seleccione Tipo Averia">
                    <option value="0">TODOS</option>
                    <?php  $_smarty_tpl->tpl_vars["tiav"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tipo_averia')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["tiav"]->key => $_smarty_tpl->tpl_vars["tiav"]->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('tiav')->value->id_tipoaveria;?>
" ><?php echo $_smarty_tpl->getVariable('tiav')->value->descripcion;?>
</option>
                    <?php }} ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Facultad</label>
            </td>
            <td>
                <select name="facu_id" id="facu_id" style="width: 200px;" title="Seleccione facultad">
                    <option value="0">TODOS</option>
                    <?php  $_smarty_tpl->tpl_vars["tiav"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('facultad')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["tiav"]->key => $_smarty_tpl->tpl_vars["tiav"]->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('tiav')->value->facu_id;?>
" ><?php echo $_smarty_tpl->getVariable('tiav')->value->facu_descripcion;?>
</option>
                    <?php }} ?>
                </select>
            </td>       
            <td>
                <label>Estado</label>
            </td>
            <td>
                <select name="estado" id="estado" style="width: 200px;" title="Seleccione estado">
                    <option value="-">TODOS</option>
                    <option value="P">PENDIENTE</option>
                    <option value="O">EN PROCESO</option>
                    <option value="A">ATENDIDO</option>
                </select>
            </td>  
            <td>
                <button id="cargar">Mostrar PDF</button>
            </td>
            <td>
                
            </td>
        </tr>
    </table>
</fieldset> 
<br/>
<iframe src="javascript:;" id="reporte" style="width: 99%;height: 350px;border: #000000 solid 1px;" ></iframe>