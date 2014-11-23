<?php /* Smarty version 3.0rc1, created on 2014-06-12 08:41:15
         compiled from ".\templates\incidencia/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42325399adfbe6bbf6-56420946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4640a02d2675714ae83ed1039233b16ed94a95d0' => 
    array (
      0 => '.\\templates\\incidencia/form.tpl',
      1 => 1402580432,
    ),
  ),
  'nocache_hash' => '42325399adfbe6bbf6-56420946',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('links')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
css/jquery-te-1.4.0.css"/>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/jquery-te-1.4.0.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/modulos/incidencia.js"></script>

<script type="text/javascript"><?php echo $_smarty_tpl->getVariable('grilla')->value;?>
</script>

<div style="width: 100%">    
    <div>    
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Filtro</legend>            
            <table>
                <tr>
                    <td>
                        <label>Tipo Averia</label>
                    </td>
                    <td>
                        <select name="id_tipoaveria" id="id_tipoaveria" style="width: 200px;" title="Seleccione Tipo Averia">
                            <option value="0">-Seleccione-</option>
                            <?php  $_smarty_tpl->tpl_vars["tiav"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tipo_averia')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["tiav"]->key => $_smarty_tpl->tpl_vars["tiav"]->value){
?>
                                <option value="<?php echo $_smarty_tpl->getVariable('tiav')->value->id_tipoaveria;?>
" ><?php echo $_smarty_tpl->getVariable('tiav')->value->descripcion;?>
</option>
                            <?php }} ?>
                        </select>
                    </td>                    
                    <td>
                        <button id="cargar">Cargar</button>
                    </td>
                </tr>
            </table>
        </fieldset>   
        <br/>
        <table id="lsincidencia"></table>
        <div id="pgincidencia"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <button id="nuevo_incidencia">Nuevo</button>
            <button id="modificar_incidencia">Modificar</button>
            <button id="anular_incidencia">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Incidencia...">
            <form action="/index.php/incidencia/guardar" title="Administrar Incidencias" method="post" id="frm_incidencia" class="formulario ">
                <fieldset class="ui-widget ui-widget-content"> 
                <table style="width: 100%">
                     <tr>                    
                         <td colspan="2"><label class="required" for="tipoaveria">TIPO AVERIA</label>
                            <br/>
                            <input type="text" name="tipoaveria" id="tipoaveria" class="text ui-widget-content ui-corner-all" style="width: 100%; background: #F5F5F5 none;" disabled=""/>
                        </td>                       
                     </tr>                     
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label class="required" for="descripcion">DESCRIPCION</label>
                            <br/>
                            <input type="text" name="descripcion" id="descripcion" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>                           
                    <tr>
                        <td>
                            <label  class="required"  for="tiempo_estimado">TIEMPO SOLUCION (dias)</label>
                            <br/>
                            <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>                        
                    </tr>  
                    <tr>
                        <td>
                            <label for="posible_solucion">POSIBLE SOLUCION</label>
                            <br/>
                            <textarea  name="posible_solucion" id="posible_solucion" rows="8" class="text ui-widget-content ui-corner-all" style="width: 100%;resize: none;"></textarea>                    
                        </td>
                    </tr> 
                    <input type="hidden" name="id_incidencia" id="id_incidencia" value ="-1"/>
                    <input type="hidden" name="id_tipoaveria" id="id_tipoaveria" value ="-1"/>
                </table>
                </fieldset>
                <span id="load"></span>
            </form>    
    </div>
</div>