<?php /* Smarty version 3.0rc1, created on 2014-06-16 01:23:10
         compiled from "./templates/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:407049011539e8d4ec208e5-80485596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c85a4816056c868d0c9a13b024bfd4b4a27cf0dd' => 
    array (
      0 => './templates/error.tpl',
      1 => 1374344098,
    ),
  ),
  'nocache_hash' => '407049011539e8d4ec208e5-80485596',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
 <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

 
<fieldset class="ui-widget ui-widget-content"> 
  <legend class="ui-widget-header ui-corner-all">Datos</legend>
        
        <div class="box box-error"><?php echo $_smarty_tpl->getVariable('titulo_error')->value;?>
</div>
        <div class="box box-error-msg">
                <ol>
                        <li><?php echo $_smarty_tpl->getVariable('mensaje_error')->value;?>
</li>
                </ol>
        </div>

</fieldset>