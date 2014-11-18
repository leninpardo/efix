<?php /* Smarty version 3.0rc1, created on 2014-07-01 04:50:40
         compiled from ".\templates\reportes/tecnico.html" */ ?>
<?php /*%%SmartyHeaderCode:2654253b28470001a86-40436252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2c8f17f30b5de812b58d858c00466698bdad80e' => 
    array (
      0 => '.\\templates\\reportes/tecnico.html',
      1 => 1402896340,
    ),
  ),
  'nocache_hash' => '2654253b28470001a86-40436252',
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
                <label>Personal</label>
            </td>
            <td>
                <select name="id_personal" id="id_personal" style="width: 200px;" title="Seleccione Personal">
                    <option value="0">TODOS</option>
                    <?php  $_smarty_tpl->tpl_vars["tiav"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('personal')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["tiav"]->key => $_smarty_tpl->tpl_vars["tiav"]->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('tiav')->value->id_personal;?>
" ><?php echo $_smarty_tpl->getVariable('tiav')->value->nombres;?>
 <?php echo $_smarty_tpl->getVariable('tiav')->value->apellido_paterno;?>
 <?php echo $_smarty_tpl->getVariable('tiav')->value->apellido_materno;?>
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
                <button id="cargar2">Mostrar</button>
            </td>
        </tr>
    </table>
</fieldset> 
<br/>
<iframe src="javascript:;" id="reporte" style="width: 99%;height: 350px;border: #000000 solid 1px;" ></iframe>