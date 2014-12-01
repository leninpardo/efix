<?php /* Smarty version 3.0rc1, created on 2014-12-01 00:52:33
         compiled from ".\templates\usuario/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9601547c0221610af4-39036701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f15597765926956d72063c0dae40bb4143bf9a1' => 
    array (
      0 => '.\\templates\\usuario/form.tpl',
      1 => 1402900190,
    ),
  ),
  'nocache_hash' => '9601547c0221610af4-39036701',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/usuario.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lsusuario"></table>
        <div id="pgusuario"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <!--<button id="nuevo_usuario">Nuevo</button>-->
            <button id="modificar_usuario">Modificar</button>
            <button id="anular_usuario">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Usuario...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/usuario/guardar" title="Administrar Usuarios" method="post" id="frm_usuario" class="formulario ">
                <table style="width: 100%">
                     <tr>                    
                        <td><label class="required" for="dni">DNI</label>
                            <br/>
                            <input type="text" name="dni" id="dni" class="text ui-widget-content ui-corner-all" style="width: 100%" onKeyPress="return validarNumeros(event);" maxlength="8"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="nombres">Nombres</label>
                            <br/>
                            <input type="text" name="nombres" id="nombres" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="apellido_paterno">Apellido Paterno</label>
                            <br/>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="apellido_materno">Apellido Materno</label>
                            <br/>
                            <input type="text" name="apellido_materno" id="apellido_materno" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <label  class="required"  for="direccion">Direccion</label>
                            <br/>
                            <input type="text" name="direccion" id="direccion" class="text ui-widget-content ui-corner-all" style="width: 100%" />                    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="telefono">Telefono</label>
                            <br/>
                            <input type="text" name="telefono" id="telefono" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label  class="required"  for="usuario">Usuario</label>
                            <br/>
                            <input type="text" name="usuario" id="usuario" class="text ui-widget-content ui-corner-all" style="width: 100%" />                    
                        </td>
                        <td><label  class="required"  for="password">Clave</label>
                            <br/>
                            <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label  class="required" for="id_perfil">Perfil</label>
                            <br/>
                            <select name="id_perfil" id="id_perfil" style="width: 100%" title="Seleccione Perfil" >
                                <?php  $_smarty_tpl->tpl_vars["perf"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('perfil')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["perf"]->key => $_smarty_tpl->tpl_vars["perf"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('perf')->value->perf_id;?>
" ><?php echo $_smarty_tpl->getVariable('perf')->value->perf_descripcion;?>
</option>
                                <?php }} ?>
                            </select> 
                        </td>
                    </tr>                
                </table>

                <input type="hidden" name="id_usuario" id="id_usuario" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>