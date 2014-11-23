<?php /* Smarty version 3.0rc1, created on 2014-11-12 03:51:29
         compiled from ".\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:789554631f91e4f062-37221739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06f2fd8d9a960ed1fa3c26ccfad67689d23fc229' => 
    array (
      0 => '.\\templates\\index.html',
      1 => 1415782270,
    ),
  ),
  'nocache_hash' => '789554631f91e4f062-37221739',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>..:: Efix - UNSM ::..</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, user-scalable=no" >
        <link href="css/bootstrap.min.css" rel="stylesheet">

            <link type="text/css" rel="stylesheet" href="css/style.css"/>
            <link type="text/css" rel="stylesheet" media="screen" href="css/theme/jquery-ui-1.8.17.custom.css"/>
            <link type="text/css" rel="stylesheet" media="screen" href="css/ui.jqgrid.css"/>

            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="js/jquery.layout.js"></script>
            <script type="text/javascript" src="js/grid.locale-es.js"></script>
            <script type="text/javascript" src="js/jquery.jqGrid.min.js"></script>
            <script type="text/javascript" src="js/util.js"></script>

            

            <script type="text/javascript">
                jQuery(document).ready(function() {
                    //$('#switcher').themeswitcher();

                    /* $('body').layout({
                     resizerClass: 'ui-state-default',
                     west__onresize: function(pane, $Pane) {
                     jQuery("#west-grid").jqGrid('setGridWidth', $Pane.innerWidth() - 2);
                     }
                     });*/

                    //$.jgrid.defaults = $.extend($.jgrid.defaults,{loadui:"enable"});

                    var maintab = jQuery('#tabs', '#RightPane').tabs({
                        add: function(e, ui) {
                            // append close thingy
                            $(ui.tab).parents('li:first')
                                    .append('<span class="ui-tabs-close ui-icon ui-icon-close" title="Cerra Tab"></span>')
                                    .find('span.ui-tabs-close')
                                    .click(function() {
                                        maintab.tabs('remove', $('li', maintab).index($(this).parents('li:first')[0]));
                                    });
                            // select just added tab
                            maintab.tabs('select', '#' + ui.panel.id);

                        }
                    });

                    jQuery("#west-grid").jqGrid({
                        url: "index.php/modulo/modulo",
                        datatype: "xml",
                        height: "auto",
                        pager: false,
                        loadui: "enable",
                        colNames: ["id", "Opciones", "url"],
                        colModel: [
                            {name: "id", width: 1, hidden: true, key: true},
                            {name: "menu", width: 200, resizable: false, sortable: false},
                            {name: "url", width: 1, hidden: true}
                        ],
                        treeGrid: true,
                        caption: "Panel de Administracion",
                        ExpandColumn: "menu",
                        autowidth: true,
                        width: 195,
                        rowNum: 200,
                        ExpandColClick: true,
                        treeIcons: {leaf: 'ui-icon-document-b'},
                        onSelectRow: function(rowid) {
                            var treedata = $("#west-grid").jqGrid('getRowData', rowid);

                            if (treedata.isLeaf == "true") {
                                //treedata.url
                                var st = "#t" + treedata.id;

                                if ($(st).html() != null) {
                                    maintab.tabs('select', st);
                                } else {

                                    maintab.tabs('add', st, treedata.menu);

                                    $(st).css("overflow", "hidden").css("position:", "relative");
                                    $(st, "#tabs").append("<iframe frameborder='0' width='100%' height='600px' id='if_" + treedata.id + "' src='" + treedata.url + "' ></iframe>");

                                }
                            }
                        },
                        gridComplete: function() {
                            //jQuery("#west-grid").jqGrid('setGridWidth', $('#LeftPane').innerWidth() - 2);
                        }

                    });
                    var timer = window.setInterval(activar, 5 * 60000);
                });

                function activar() {
                    $.post(
                            URLINDEX + '/activar',
                            {
                                ajax: 'ajax'
                            }, //parametros
                    function(response) { //funcion para procesar los datos
                    },
                            'json'//tipo de dato devuelto
                            );
                }
            </script>
            

    </head>
    <body row>
        <div id="northPane">            
            <?php if ($_smarty_tpl->getVariable('info')->value=='S'){?>
            <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 5px;" >
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#optionsTop">
                            <span class="sr-only">User</span>
                            <span class="glyphicon glyphicon-user" style="font-size: 1.4em;"></span>
                        </button>
                        <a class="navbar-brand" href="index.php" style="font-size: 2em;"><span class="glyphicon glyphicon-pushpin" style="font-size: 1.1em;"></span> Efix</a>
                        <div>Welcome!  <strong><?php echo $_smarty_tpl->getVariable('usuario')->value['usua_nombres'];?>
 <?php echo $_smarty_tpl->getVariable('usuario')->value['usua_apellido_paterno'];?>
 <?php echo $_smarty_tpl->getVariable('usuario')->value['usua_apellido_materno'];?>
</strong></div>
                    </div>
                    <div class="collapse navbar-collapse" id="optionsTop">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="javascript:frmclave()" style="font-size: 1.2em;"><span class="glyphicon glyphicon-edit"></span> Cambiar Clave</a></li>
                            <li class="danger"><a href="index.php/logout" style="font-size: 1.2em;"><span class="glyphicon glyphicon-off text-danger"></span> <span  class="text-danger">Cerrar Sesión</span></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php }?>
        </div> <!-- #LeftPane -->
        <div id="LeftPane" class="col-sm-2">
            <div>
                <table id="west-grid" ></table>
            </div>
        </div> <!-- #LeftPane -->
        <div id="RightPane" class="col-sm-10"><!-- Tabs pane -->
            <div id="switcher"></div>

            <div id="tabs" style="overflow: hidden; position: relative; min-height: 500px;" class="jqgtabs">

                <ul>
                    <li><a href="#tabs-1">Inicio</a></li>
                </ul>

                <div id="tabs-1">

                    <?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('contenido')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


                </div>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>