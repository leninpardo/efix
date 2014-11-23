<?php /* Smarty version 3.0rc1, created on 2014-07-06 19:59:22
         compiled from ".\templates\config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2457453b9f0ea7d8c86-09161203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe98351f543f8b6bd0c734cc7026512f2cce7ba9' => 
    array (
      0 => '.\\templates\\config.tpl',
      1 => 1404661158,
    ),
  ),
  'nocache_hash' => '2457453b9f0ea7d8c86-09161203',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/config.js"></script>
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