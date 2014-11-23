<?php /* Smarty version 3.0rc1, created on 2014-11-13 01:02:24
         compiled from ".\templates\reportes/bi.html" */ ?>
<?php /*%%SmartyHeaderCode:2600654644970df6026-82207102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '090b20af468bf14e498c426406dd3d71e68a166c' => 
    array (
      0 => '.\\templates\\reportes/bi.html',
      1 => 1415858534,
    ),
  ),
  'nocache_hash' => '2600654644970df6026-82207102',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/reportes.js"></script>

<fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
    <legend class="ui-widget-header ui-corner-all">Filtro</legend>   
    <iframe src="http://localhost:8080/pentaho/content/saiku-ui/index.html?biplugin=true&userid=joe&password=password" style="width:100%;height:100%;" scrolling="no"></iframe>
</fieldset>