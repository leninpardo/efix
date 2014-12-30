<?php /* Smarty version 3.0rc1, created on 2014-12-03 10:31:15
         compiled from ".\templates\area_administrativa/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14451547f2cc3c00314-79577545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c1ffb08fff65b8bc6b4d66f81ef6f3e147587d2' => 
    array (
      0 => '.\\templates\\area_administrativa/form.tpl',
      1 => 1402905674,
    ),
  ),
  'nocache_hash' => '14451547f2cc3c00314-79577545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/area_administrativa.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
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
                                <?php  $_smarty_tpl->tpl_vars["perf"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tipo_averia')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["perf"]->key => $_smarty_tpl->tpl_vars["perf"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('perf')->value->id_tipoaveria;?>
" ><?php echo $_smarty_tpl->getVariable('perf')->value->descripcion;?>
</option>
                                <?php }} ?>
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