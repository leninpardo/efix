<?php /* Smarty version 3.0rc1, created on 2014-11-12 03:55:17
         compiled from ".\templates\home.html" */ ?>
<?php /*%%SmartyHeaderCode:1628654632075b32026-34375517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68ab31bf7b6c5ed0d021984e9faa76586af9cb6e' => 
    array (
      0 => '.\\templates\\home.html',
      1 => 1415782513,
    ),
  ),
  'nocache_hash' => '1628654632075b32026-34375517',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Efix - UNSM</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/rating.css" rel="stylesheet">
        <link rel="shortcut icon"  href="images/icono.ico" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="bs-example bs-example-tabs container">
            <div class="header" style="margin-bottom: 15px;border-bottom: 1px solid #e5e5e5;margin-top: 10px;">
                <ul id="myTab" class="nav nav-tabs nav-pills pull-right fade in" style="border-bottom: none;">
                    <li class="active" title="Inicio"  style="text-align: center;">
                        <a href="#me" data-toggle="tab"><span class="glyphicon glyphicon-home" style="font-size: 1.5em;"></span><br />Inicio</a>
                    </li>
                    <li class="" title="Contacto" style="text-align: center;">
                        <a href="#email" data-toggle="tab"><span class="glyphicon glyphicon-envelope" style="font-size: 1.5em;"></span><br />Contacto</a>
                    </li>
                    <?php if ($_smarty_tpl->getVariable('logeado')->value=='S'){?>
                    <li class="" title="Reporte" style="text-align: center;">
                        <a href="#work" data-toggle="tab"><span class="glyphicon glyphicon-pushpin" style="font-size: 1.5em;"></span><br />Averia</a>
                    </li>
                    <li class="" title="Mis Reportes" style="text-align: center;">
                        <a href="#myrep" data-toggle="tab"><span class="glyphicon glyphicon-list" style="font-size: 1.5em;"></span><br />Mis Reportes</a>
                    </li>
                    <?php if ($_smarty_tpl->getVariable('usuario')->value['perf_id']!=3){?>
                    <li class="" title="Intranet" style="text-align: center;">
                        <a href="index.php?intranet" ><span class="glyphicon glyphicon-user" style="font-size: 1.5em;"></span><br />Intranet</a>
                    </li>
                    <?php }?>
                    <li class="danger" title="Salir" style="text-align: center;">
                        <a href="index.php/logout" class="text-danger"><span class="glyphicon glyphicon-off" style="font-size: 1.5em;"></span><br />Salir</a>
                    </li>
                    <?php }else{ ?>
                    <li class="" title="Acceso" style="text-align: center;">
                        <a href="#work" data-toggle="tab"><span class="glyphicon glyphicon-lock" style="font-size: 1.5em;"></span><br />Acceso</a>
                    </li>
                    <?php }?>
                </ul>
                <h1 class="text-muted" style="padding-bottom: 10px;margin-top: 0;margin-bottom: 0;line-height: 70px;">Efix

                </h1>
                <?php if ($_smarty_tpl->getVariable('logeado')->value=='S'){?>
                <div class="alert alert-info fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Bienvenido: <strong><?php echo $_smarty_tpl->getVariable('usuario')->value['usua_nombres'];?>
 <?php echo $_smarty_tpl->getVariable('usuario')->value['usua_apellido_paterno'];?>
 <?php echo $_smarty_tpl->getVariable('usuario')->value['usua_apellido_materno'];?>
</strong>
                </div>
                <?php }?>

                <?php if ($_smarty_tpl->getVariable('mensaje_averia')->value!='-'){?>
                <div class="alert alert-info fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_smarty_tpl->getVariable('mensaje_averia')->value;?>

                </div>
                <?php }?>

            </div>
            <div id="myTabContent" class="tab-content jumbotron" style="min-height: 450px;">
                <div class="tab-pane fade active in row" id="me">
                    <div class="col-sm-1"></div>
                    <div class="page-header col-sm-4">
                        <h2>Efix <small><br />Estrategia de Gestión de Averias</small></h2>
                        <p class="text-justify" style="font-size: 1em;"><br /> <<< <br />Reporte su Averia desde cualquier lugar, sólo inicie sesión y contribuya a mantener el patrimonio 
                            de nuestra Alma Mater en las mejores condiciones. <br /> >>></p>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5">
                        <img src="images/me.jpg" alt=""  style="width: 100%;"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="email">                    
                    <h2>Contactenos</h2>
                    <form class="form-horizontal" role="form" method="post">                        
                        <div class="form-group">
                            <label for="nombre" class="col-sm-3 control-label">Nombre:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nombre" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo1" class="col-sm-3 control-label">Correo:</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="correo1" required="">
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="asunto" class="col-sm-3 control-label">Asunto:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="asunto" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mensaje" class="col-sm-3 control-label">Mensaje:</label>
                            <div class="col-sm-7">
                                <textarea id="mensaje" class="form-control" rows="5" style="resize: none;" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div> 
                <div class="tab-pane fade in row" id="myrep">
                    <div class="table-responsive" style="background-color: #ffffff;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Facultad
                                    </th>
                                    <th>
                                        Ambiente
                                    </th>
                                    <th>
                                        Ubicacion
                                    </th>
                                    <th>
                                        Incidencia
                                    </th>
                                    <th>
                                        Tecnico
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>
                                        Calificar
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $_smarty_tpl->tpl_vars["rep"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mis_reportes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["rep"]->key => $_smarty_tpl->tpl_vars["rep"]->value){
?>
                                    <tr>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['to_char'];?>
 <?php echo $_smarty_tpl->getVariable('rep')->value['hora_reporte'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['facu_descripcion'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['ambi_descripcion'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['ubic_descripcion'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['descripcion'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['personal_nombres'];?>

                                        </th>
                                        <th>
                                            <?php echo $_smarty_tpl->getVariable('rep')->value['seguimiento'];?>

                                        </th>
                                        <th>
                                            <?php if ($_smarty_tpl->getVariable('rep')->value['seguimiento']=='ATENDIDO'){?>
                                            <div id="rat_<?php echo $_smarty_tpl->getVariable('rep')->value['id_averia'];?>
" class="rating" id_averia="<?php echo $_smarty_tpl->getVariable('rep')->value['id_averia'];?>
" valor="<?php echo $_smarty_tpl->getVariable('rep')->value['calificacion'];?>
">&nbsp;</div>
                                            <?php }?>
                                        </th>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade in row" id="work">
                    <?php if ($_smarty_tpl->getVariable('logeado')->value=='S'){?>
                    <div class="alert alert-danger fade in" style="display: none;" id="mensaje_averia">
                        <span><?php echo $_smarty_tpl->getVariable('mensaje')->value;?>
</span>
                    </div>
                    <h2>Registro de Averias</h2>                    
                    <form enctype="multipart/form-data" action="index.php/averiarep" id="registro_averia" class="form-horizontal" role="form" method="post">
                        <div class="form-group">
                            <label for="apellido_paterno" class="col-sm-2 control-label">Ubicacion</label>
                            <div class="col-sm-3">
                                <select id="facu_id" name="facu_id" class="form-control">
                                    <option value="0">.: SELECCIONE FACULTAD :.</option>
                                    <?php  $_smarty_tpl->tpl_vars["fa"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('facultad')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["fa"]->key => $_smarty_tpl->tpl_vars["fa"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('fa')->value->facu_id;?>
" ><?php echo $_smarty_tpl->getVariable('fa')->value->facu_descripcion;?>
</option>
                                    <?php }} ?>
                                </select>
                            </div>                            
                            <div class="col-sm-3">
                                <select id="ambi_id" name="ambi_id" class="form-control">
                                    <option value="0">.: SELECCIONE AMBIENTE :.</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select id="ubic_id" name="ubic_id" class="form-control">
                                    <option value="0">.: SELECCIONE UBICACION :.</option>
                                </select>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno" class="col-sm-2 control-label">Tipo Averia</label>
                            <div class="col-sm-3">
                                <select id="id_tipoaveria" name="id_tipoaveria" class="form-control">
                                    <option value="0">.: SELECCIONE TIPO AVERIA :.</option>
                                    <?php  $_smarty_tpl->tpl_vars["ta"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tipo_averia')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["ta"]->key => $_smarty_tpl->tpl_vars["ta"]->value){
?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('ta')->value->id_tipoaveria;?>
" ><?php echo $_smarty_tpl->getVariable('ta')->value->descripcion;?>
</option>
                                    <?php }} ?>
                                </select>
                            </div>  
                            <label for="apellido_paterno" class="col-sm-2 control-label">Insidencia</label>
                            <div class="col-sm-4">
                                <select id="id_incidencia" name="id_incidencia" class="form-control">
                                    <option value="0">.: SELECCIONE UBICACION :.</option>
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno" class="col-sm-2 control-label">Observaciones</label>
                            <div class="col-sm-9">
                                <textarea id="observaiones" name="observaiones" class="form-control" rows="5" style="resize: none;" required=""></textarea>
                            </div>                            
                        </div>
                          <div class="form-group">
                            <label for="codigo" class="col-sm-2 control-label">Codigo patrimonial</label>
                            <div class="col-sm-9">
                                <input type="text" id="codigo_patrimonial" name="codigo_patrimonial" class="text text-primary"/>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno" class="col-sm-2 control-label">Imagen</label>
                            <div class="col-sm-9">
                                <input type="file"  name="imagen" id="imagen" value="" />
                            </div>                            
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-7">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-success" id="solucion" style="display: none;">Posible solucion</button>
                            </div>
                        </div>
                    </form>
                    <?php }else{ ?>
                    <div class="col-sm-5">
                        <?php if ($_smarty_tpl->getVariable('mensaje')->value=='-'){?>
                        <div class="alert alert-danger fade in" style="display: none;" id="mensaje_session">
                            <?php }else{ ?>
                            <div class="alert alert-danger fade in" id="mensaje_session">
                                <?php }?>
                                <span><?php echo $_smarty_tpl->getVariable('mensaje')->value;?>
</span>
                            </div>

                            <h3>Inicie Sesion</h3>
                            <form id="inicio_sesion" class="form-horizontal" role="form" action="index.php/login" method="post">                        
                                <div class="form-group">
                                    <label for="login" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="login" id="login" placeholder="Usuario" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="clave" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aaaa" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-primary btn-block" value="Ingresar"/>
                                    </div>
                                </div>                            
                            </form>                        
                        </div>
                        <div class="col-sm-7">

                            <?php if ($_smarty_tpl->getVariable('mensaje_registro')->value=='-'){?>
                            <div class="alert alert-danger fade in" style="display: none;" id="mensaje_registro">
                                <?php }else{ ?>
                                <div class="alert alert-danger fade in" id="mensaje_registro">
                                    <?php }?>
                                    <span><?php echo $_smarty_tpl->getVariable('mensaje')->value;?>
</span>
                                </div>

                                <h3>Registrese</h3>
                                <form  id="frm_registrese" action="index.php/nuevo" class="form-horizontal" role="form" method="post">                            
                                    <div class="form-group">
                                        <label for="dni" class="col-sm-2 control-label">DNI:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="dni" id="dni" placeholder="Dni" maxlength="8"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="nombres" class="col-sm-2 control-label">Nombres:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" />
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="apellido_paterno" class="col-sm-2 control-label">Apellidos</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" />
                                        </div>                            
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" />
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="correo" class="col-sm-2 control-label">Correo:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" />
                                        </div>
                                        <div class="col-sm-5">
                                            <select id="tipocorreo" name="tipocorreo" class="form-control">
                                                <option value="@alumno.unsm.edu.pe">@alumno.unsm.edu.pe</option>
                                                <option value="@docente.unsm.edu.pe">@docente.unsm.edu.pe</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="clave_re" class="col-sm-2 control-label">Clave:</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" name="clave_re" id="clave_re" placeholder="Clave" />
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" name="clave_re2" id="clave_re2" placeholder="Repetir Clave" />
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="aaaa" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <input type="submit" class="btn btn-success" value="Registrar"/>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            <?php }?> 
                        </div>
                    </div>
                    <div class="footer">
                        <p>© UNSM 2014</p>
                    </div>
                </div>
                    
                    <div class="modal fade" id="dlgSolucion" tabindex="-1" role="dialog" aria-labelledby="dlgSolucionLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="dlgSolucionLabel">Solucion de incidencias.</h4>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-success fade in">
                                Siga los siguientes pasos para intentar solucionar el problema.
                            </div>
                            <div id="texto">

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
                <div class="modal fade" id="dlgExiste" tabindex="-1" role="dialog" aria-labelledby="dlgExisteLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="dlgExisteLabel">Incidencia Encontrada</h4>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-warning fade in">
                                Se encontro una incidencia con los mismos datos.
                            </div>
                            <div>
                                <div style="width: 35%;float: left;">
                                    <img src="#"  alt="Imagen de la averia" style="width: 95%;height: 200px;" id="imginci"> 
                                </div>
                                <div style="width: 63%;float: left;" id="comen">
                                    
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="env_ave">Enviar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <script src="js/jquery-2.0.2.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/rating.js"></script>
                <script src="js/home.js"></script>
                </body>
                </html>