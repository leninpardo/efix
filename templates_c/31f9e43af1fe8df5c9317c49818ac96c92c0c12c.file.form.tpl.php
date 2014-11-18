<?php /* Smarty version 3.0rc1, created on 2014-06-11 15:56:38
         compiled from ".\templates\tipo_averia/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2215398c286c19ef2-63398686%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31f9e43af1fe8df5c9317c49818ac96c92c0c12c' => 
    array (
      0 => '.\\templates\\tipo_averia/form.tpl',
      1 => 1402368363,
    ),
  ),
  'nocache_hash' => '2215398c286c19ef2-63398686',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/tipo_averia.js"></script>
<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>
<div style="width: 100%">    
    <div>        
        <table id="lstipo_averia"></table>
        <div id="pgtipo_averia"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_tipo_averia">Nuevo</button>
            <button id="modificar_tipo_averia">Modificar</button>
            <button id="anular_tipo_averia">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Tipo de Averia...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/tipo_averia/guardar" title="Administrar Tipos de Averia" method="post" id="frm_tipo_averia" class="formulario ">
                <table style="width: 100%">                     
                    <tr>
                        <td colspan="3">
                            <label class="required" for="descripcion">Descripcion</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                   
                        </td>
                    </tr>                                             
                </table>

                <input type="hidden" name="id_tipoaveria" id="id_tipoaveria" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>