<?php /* Smarty version 3.0rc1, created on 2014-06-11 15:59:19
         compiled from ".\templates\perfil/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116845398c3276574e7-08559808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca7f2d95712a7cc7d5e2f10074f82e78f72e33ae' => 
    array (
      0 => '.\\templates\\perfil/form.tpl',
      1 => 1398633170,
    ),
  ),
  'nocache_hash' => '116845398c3276574e7-08559808',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

 <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/perfil.js"></script>

<script type="text/javascript">

<?php echo $_smarty_tpl->getVariable('grilla')->value;?>


</script>


<div style="width: 100%">
    
    <div style="width: 410px;float: left">
        
        <table id="lsperfil"></table>
        <div id="pgperfil"></div>
        
        
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>
            
            <button id="nuevo_perfil">Nuevo</button>
            <button id="modificar_perfil">Modificar</button>
            <button id="anular_perfil">Anular</button>
        </fieldset>
        
    </div>
    
    <div style="width: 400px;float: left" >
        
    <fieldset class="ui-widget ui-widget-content"> 
      <legend class="ui-widget-header ui-corner-all">Datos</legend>
        
        <form action="/index.php/perfil/guardar" title="Administrar Perfiles" method="post" id="frm_perfil" class="formulario ">

            <table style="width: 100%">
                <tr>
                    <td>
                        <label class="required" for="descripcion">Descripcion</label>
                        <br/>
                        <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style=";width: 100%"/>
                    </td>
                </tr>
            </table>
            
            <input type="hidden" name="id_perfil" id="id_perfil" value ="-1"/>
            
            <span id="load"></span>
            
        </form>
      
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="guardar_perfil" value="Guardar" />
            <input type="button" id="cancelar_perfil" value="Cancelar" />
        </fieldset>
        
    </fieldset>
    
    </div>
    
</div>



