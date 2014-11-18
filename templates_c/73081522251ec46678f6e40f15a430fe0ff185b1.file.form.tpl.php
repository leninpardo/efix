<?php /* Smarty version 3.0rc1, created on 2014-06-30 00:46:52
         compiled from "./templates/patrimonio/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130082127353b0f9ccc4f126-74771105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73081522251ec46678f6e40f15a430fe0ff185b1' => 
    array (
      0 => './templates/patrimonio/form.tpl',
      1 => 1404106555,
    ),
  ),
  'nocache_hash' => '130082127353b0f9ccc4f126-74771105',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/patrimonio.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lspatrimonio"></table>
        <div id="pgpatrimonio"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_patrimonio">Nuevo</button>
            <button id="modificar_patrimonio">Modificar</button>
            <button id="anular_patrimonio">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Tipo de Averia...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/patrimonio/guardar" title="Administrar Tipos de Averia" method="post" id="frm_patrimonio" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="codigo_patrimonial">Codigo Patrimonial</label>
                            <br/>
                            <input type="text" name="codigo_patrimonial" id="codigo_patrimonial" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr> 
                </table>

                <input type="hidden" name="id_patrimonio" id="id_patrimonio" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>