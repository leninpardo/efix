<?php /* Smarty version 3.0rc1, created on 2014-10-31 00:39:44
         compiled from "./templates/facultad/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1042150042545320a09ccc09-33356607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f8bb62b56b915f3a94673785ddf287e9f9c4dd1' => 
    array (
      0 => './templates/facultad/form.tpl',
      1 => 1414733963,
    ),
  ),
  'nocache_hash' => '1042150042545320a09ccc09-33356607',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/facultad.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lsfacultad"></table>
        <div id="pgfacultad"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_facultad">Nuevo</button>
            <button id="modificar_facultad">Modificar</button>
            <button id="coordenada_facultad">Coordenadas</button>
            <button id="anular_facultad">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Facultad...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/facultad/guardar" title="Administrar Lugares" method="post" id="frm_facultad" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr> 
                    <tr>
                           <td colspan="2">
                            <label  class="required" for="tipo_id">Tipo</label>
                            <br/>
                            <select name="tipo_id" id="tipo_id" style="width: 100%" title="Seleccione " >
                                <?php  $_smarty_tpl->tpl_vars["tip"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tipo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["tip"]->key => $_smarty_tpl->tpl_vars["tip"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('tip')->value->tipo_id;?>
" ><?php echo $_smarty_tpl->getVariable('tip')->value->descripcion;?>
</option>
                                <?php }} ?>
                            </select> 
                        </td>
                    </tr>
                </table>

                <input type="hidden" name="id_facultad" id="id_facultad" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>    
    <div id="modalCoordenada" title="Coordenadas...">        
            <form action="/index.php/facultad/guardarCoordenada" title="Administrar Coordenadas" method="post" id="frm_facultad_coordenada" class="formulario ">
                    <label class="required" for="facultad">Facultad</label>
                    <input type="text" name="facultad" id="facultad" class="text ui-widget-content ui-corner-all" style="width: 100%" readonly="" />                   
                    <table style="width: 100%">    
                        <tr>
                            <td >
                                Latitud: <input type="text" name="latitud" id="latitud" class="text ui-widget-content ui-corner-all" style="width: 60%"/>                   
                            </td>                   
                            <td >
                                Longitud: <input type="text" name="longitud" id="longitud"  class="text ui-widget-content ui-corner-all" style="width: 50%"/>                   
                                <button id="agregar_coordenada">Agregar</button>
                            </td>
                        </tr>
                    </table>
                    <script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grillaCoordenada')->value;?>
</script>
                    <table id="lscoordenada"></table>
                    <div id="pgcoordenada"></div> 
                    <input type="hidden" name="id_facultad" id="id_facultad" value ="-1"/>
                    <span id="load"></span>
            </form>
    </div>
</div>