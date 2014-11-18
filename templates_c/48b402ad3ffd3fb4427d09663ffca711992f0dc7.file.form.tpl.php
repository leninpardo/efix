<?php /* Smarty version 3.0rc1, created on 2014-06-30 00:46:30
         compiled from "./templates/permiso/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212298549653b0f9b69d5639-62910734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48b402ad3ffd3fb4427d09663ffca711992f0dc7' => 
    array (
      0 => './templates/permiso/form.tpl',
      1 => 1398635232,
    ),
  ),
  'nocache_hash' => '212298549653b0f9b69d5639-62910734',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
css/style.css"/>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
css/theme/jquery-ui-1.8.17.custom.css"/>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
css/ui.jqgrid.css"/>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/jquery.jstree.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/grid.locale-es.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('HOST')->value;?>
js/util.js"></script>

<script type="text/javascript">

    
    jQuery(document).ready(function(){
        
        jQuery('#lsperfil').jqGrid({
        url:URLINDEX + '/perfil/lista',
        height:'350',
        datatype: 'json',
        colNames:['Descripcion'],
        colModel:[
            { name:'perf_descripcion',index:'descripcion',width:'150',sortable:'false',search:'true',align:'left'}
        ],
        rowNum:20,
        rowList:[10,20,30],
        forceFit:false,
        pager:'#pgperfil',
        sortname:'perf_descripcion',
        autowidth:true,
        viewrecords:true,
        multiselect:false,
        sortorder:'asc',
        rownumbers:true,
        caption:'Perfil',
        onSelectRow: function(ids) {
            if(ids == null) {
                                        $("#tree").jstree({
                                                plugins : [ "themes", "json_data", "checkbox","sort", "ui" ],
                                                themes : {
                                                        theme : "apple",
                                                        url : URLHOST + 'css/apple/style.css'
                                                    },
                                                json_data : {
                                                    ajax : {
                                                        url : URLINDEX + "/perfil/getPermisos",
                                                        data : {
                                                               perf_id : 0
                                                            }
                                                        }
                                                    }
                                        });
            } else {

                                    $("#tree").jstree({
                                            plugins : [ "themes", "json_data", "checkbox","sort", "ui" ],
                                            themes : {
                                                    theme : "apple",
                                                    url : URLHOST + 'css/apple/style.css'
                                                },
                                            json_data : {
                                                ajax : {
                                                    url : URLINDEX + "/perfil/getPermisos",
                                                    data : {
                                                           perf_id : ids
                                                        }
                                                    }
                                                }
                                    });

            }
         },
         gridComplete:function(){
                                    $("#tree").jstree({
                                                plugins : [ "themes", "json_data", "checkbox","sort", "ui" ],
                                                themes : {
                                                        theme : "apple",
                                                        url : URLHOST + 'css/apple/style.css'
                                                    },
                                                json_data : {
                                                    ajax : {
                                                        url : URLINDEX + "/perfil/getPermisos",
                                                        data : {
                                                               perf_id : 0
                                                            }
                                                        }
                                                    }
                                        });
            }
    });
    jQuery('#lsperfil').jqGrid('navGrid','#pgperfil',{ edit:false,add:false,del:false,search:false});jQuery('#lsperfil').jqGrid('filterToolbar',{ stringResult: true,searchOnEnter : true});
	$("#tree").jstree({
		plugins : [ "themes", "json_data", "checkbox","sort", "ui" ],
                themes : {
                        theme : "apple",
                        url : URLHOST + 'css/apple/style.css'
                    },
                json_data : {
                    ajax : {
                        url : URLINDEX + "/perfil/getPermisos",
                        data : {
                               perf_id : 0
                            }
                        }
                    }
	});
        
        
        $( "#actualizar_perfil" ).button().click(function() {                
                var aPermisos = [];
                var p;                
                $('#tree').find('li').each(function(i, element){
                    if($(element).hasClass("jstree-checked") || $(element).hasClass("jstree-undetermined")){
                        p = 'true';
                    }else{
                        p = 'false';
                    }

                    aPermisos.push({ id:this.id,val:p}); 

                });
                
                if (aPermisos.length > 0){                    
                            Loading('Actualizando permisos...');

                            $.get(
                                URLINDEX + '/perfil/actualizarPermisos',
                                {
                                    ajax:'ajax',
                                    permisos:aPermisos
                                },
                                function(response){
                                    QuitarLoading();
                                    Mensaje('Permisos actualizados','Mensaje');

                                },
                                'json'
                            );
                                
                }else{
                    Mensaje('Carge los permisos','Error');
                }
                
            });
        
    });

</script>

<div style="width: 100%">
    
    <div style="width: 410px;float: left">
        
        <table id="lsperfil"></table>
        <div id="pgperfil"></div>
        
    </div>
    
    <div style="width: 400px;float: left" >
        
    <fieldset class="ui-widget ui-widget-content"> 
      <legend class="ui-widget-header ui-corner-all">Permisos</legend>
        
    <div id="tree" style="font-size: 12px;overflow: auto;height: 360px">

    </div>
      
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Confirmar</legend>

            <input type="button" id="actualizar_perfil" value="Actualizar Permisos" />
            <span id="load"></span>
        </fieldset>
        
    </fieldset>
    
    </div>
    
</div>


