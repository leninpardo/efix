<?php /* Smarty version 3.0rc1, created on 2014-07-06 10:33:03
         compiled from ".\templates\config.php" */ ?>
<?php /*%%SmartyHeaderCode:291653b96c2fe48c26-64765377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2799f1a8feddbaf5378c7702bcc30c8a712a4e8' => 
    array (
      0 => '.\\templates\\config.php',
      1 => 1404660775,
    ),
  ),
  'nocache_hash' => '291653b96c2fe48c26-64765377',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
 <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/perfil.js"></script>
<div>
    <fieldset>
        <legend>Configracion de la conexion a BD,lo cual esta en postgres</legend>
    <table>
        <tr>
            <td>nombre BD:
                <BR/>
                <input type="text" name="bd" id="bd"/>
            </td>
        </tr>
          <tr>
            <td>HOST:
                <BR/>
                <input type="text" name="host" id="host"/>
            </td>
        </tr>
          <tr>
            <td>PUERTO:
                <BR/>
                <input type="text" name="port" id="port"/>
            </td>
         
        </tr>
        <tr>
            <td>
                  <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;">
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="btn_config" value="Actualizar Configuracion" />
            <span id="load"></span>
        </fieldset>
            </td>
        </tr>
    </table>
    </fieldset>
</div>