<?php /* Smarty version 3.0rc1, created on 2014-06-10 16:56:59
         compiled from ".\templates\modulo/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2958953977f2b355187-58238459%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30ae0a4b2effbe15a936aa0a1c4b309616840aea' => 
    array (
      0 => '.\\templates\\modulo/form.tpl',
      1 => 1398631434,
    ),
  ),
  'nocache_hash' => '2958953977f2b355187-58238459',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
 <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

 
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/modulo.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>


<div style="width: 100%">    
    <div style="width: 410px;float: left">        
        <table id="lsmodulo"></table>
        <div id="pgmodulo"></div>       
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>
            <button id="nuevo_modulo">Nuevo</button>
            <button id="modificar_modulo">Modificar</button>
            <button id="anular_modulo">Anular</button>
        </fieldset>
    </div>
    
    <div style="width: 400px;float: left" >        
    <fieldset class="ui-widget ui-widget-content"> 
      <legend class="ui-widget-header ui-corner-all">Datos</legend>        
        <form action="/index.php/Modulo/guardar" title="Administrar Modulo" method="post" id="frm_Modulo" class="formulario ">

            <table style="width: 100%">
                <tr>
                    <td>
                        <label class="required" for="descripcion">Descripcion</label>
                        <br/>
                        <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required"  for="url">Url</label>
                        <br/>
                        <input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" style="text-transform: none;width: 100%" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required" for="descripcion">Dependencia</label>
                        <br/>
                        <select name="id_padre" id="id_padre" style="width: 100%" title="Seleccione dependencia">
                            <option value="0" >-Ninguno-</option>
                            <?php  $_smarty_tpl->tpl_vars["d"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('dependencias')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["d"]->key => $_smarty_tpl->tpl_vars["d"]->value){
?>
                                <option value="<?php echo $_smarty_tpl->getVariable('d')->value->modu_id;?>
" ><?php echo $_smarty_tpl->getVariable('d')->value->modu_descripcion;?>
</option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="required"  for="url">Orden</label>
                        <br/>
                        <input type="text" name="peso" id="peso" class="text ui-widget-content ui-corner-all" style="text-transform: none;width: 20%" onkeypress="return validarNumeros(event)" />
                    </td>
                </tr>
            </table>
            
            <input type="hidden" name="id_modulo" id="id_modulo" value ="-1"/>
            
            <span id="load"></span>
            
        </form>
      
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="guardar_modulo" value="Guardar" />
            <input type="button" id="cancelar_modulo" value="Cancelar" />
        </fieldset>
        
    </fieldset>
    
    </div>
    
</div>



