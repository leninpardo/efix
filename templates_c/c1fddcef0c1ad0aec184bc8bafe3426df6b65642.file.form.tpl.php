<?php /* Smarty version 3.0rc1, created on 2014-11-30 11:02:45
         compiled from ".\templates\ambiente/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2357547b3fa5bf88a2-28484908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1fddcef0c1ad0aec184bc8bafe3426df6b65642' => 
    array (
      0 => '.\\templates\\ambiente/form.tpl',
      1 => 1401943536,
    ),
  ),
  'nocache_hash' => '2357547b3fa5bf88a2-28484908',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/ambiente.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lsambiente"></table>
        <div id="pgambiente"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_ambiente">Nuevo</button>
            <button id="modificar_ambiente">Modificar</button>
            <button id="anular_ambiente">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Ambiente...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/ambiente/guardar" title="Administrar Ambientes" method="post" id="frm_ambiente" class="formulario ">
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

                <input type="hidden" name="id_ambiente" id="id_ambiente" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>