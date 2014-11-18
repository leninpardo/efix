<?php /* Smarty version 3.0rc1, created on 2014-06-10 17:14:44
         compiled from ".\templates\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20939539783544963c2-15836401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd206b131138557fc135d01cb3f9c30ca11fcf92' => 
    array (
      0 => '.\\templates\\error.tpl',
      1 => 1374344098,
    ),
  ),
  'nocache_hash' => '20939539783544963c2-15836401',
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