<?php /* Smarty version 3.0rc1, created on 2014-11-30 15:11:48
         compiled from ".\templates\ubicacion/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25518547b7a04ac2d39-31954548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3672c016a1b6b3ce45555a9514f4f2504befe5b9' => 
    array (
      0 => '.\\templates\\ubicacion/form.tpl',
      1 => 1401943556,
    ),
  ),
  'nocache_hash' => '25518547b7a04ac2d39-31954548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/ubicacion.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lsubicacion"></table>
        <div id="pgubicacion"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_ubicacion">Nuevo</button>
            <button id="modificar_ubicacion">Modificar</button>
            <button id="anular_ubicacion">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Ubicacion...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/ubicacion/guardar" title="Administrar Aulas - Oficinas" method="post" id="frm_ubicacion" class="formulario ">
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
                    <tr>
                        <td colspan="2">
                            <label  class="required" for="id_ambiente">Ambiente</label>
                            <br/>
                            <select name="id_ambiente" id="id_ambiente" style="width: 100%" title="Seleccione Ambiente">
                                <?php  $_smarty_tpl->tpl_vars["ambi"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('ambiente')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["ambi"]->key => $_smarty_tpl->tpl_vars["ambi"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('ambi')->value->ambi_id;?>
" ><?php echo $_smarty_tpl->getVariable('ambi')->value->ambi_descripcion;?>
</option>
                                <?php }} ?>
                            </select> 
                        </td>
                    </tr>  
                </table>

                <input type="hidden" name="id_ubicacion" id="id_ubicacion" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>