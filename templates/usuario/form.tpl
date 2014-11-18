{include file=$links}
<script type="text/javascript" src="{$HOST}js/modulos/usuario.js"></script>
<script type="text/javascript">{$grilla}</script>
<div style="width: 100%">    
    <div>        
        <table id="lsusuario"></table>
        <div id="pgusuario"></div> 
        <fieldset class="ui-widget ui-widget-content" style="margin-top: 5px;"> 
            <legend class="ui-widget-header ui-corner-all">Operaciones</legend>            
            <!--<button id="nuevo_usuario">Nuevo</button>-->
            <button id="modificar_usuario">Modificar</button>
            <button id="anular_usuario">Anular</button>
        </fieldset>        
    </div>
    <div id="modalRegistro" title="Usuario...">        
        <fieldset class="ui-widget ui-widget-content"> 
          <legend class="ui-widget-header ui-corner-all">Datos</legend>

            <form action="/index.php/usuario/guardar" title="Administrar Usuarios" method="post" id="frm_usuario" class="formulario ">
                <table style="width: 100%">
                     <tr>                    
                        <td><label class="required" for="dni">DNI</label>
                            <br/>
                            <input type="text" name="dni" id="dni" class="text ui-widget-content ui-corner-all" style="width: 100%" onKeyPress="return validarNumeros(event);" maxlength="8"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="nombres">Nombres</label>
                            <br/>
                            <input type="text" name="nombres" id="nombres" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="apellido_paterno">Apellido Paterno</label>
                            <br/>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="required" for="apellido_materno">Apellido Materno</label>
                            <br/>
                            <input type="text" name="apellido_materno" id="apellido_materno" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <label  class="required"  for="direccion">Direccion</label>
                            <br/>
                            <input type="text" name="direccion" id="direccion" class="text ui-widget-content ui-corner-all" style="width: 100%" />                    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="telefono">Telefono</label>
                            <br/>
                            <input type="text" name="telefono" id="telefono" class="text ui-widget-content ui-corner-all" style="width: 100%"/>                    
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label  class="required"  for="usuario">Usuario</label>
                            <br/>
                            <input type="text" name="usuario" id="usuario" class="text ui-widget-content ui-corner-all" style="width: 100%" />                    
                        </td>
                        <td><label  class="required"  for="password">Clave</label>
                            <br/>
                            <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" style="width: 100%"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label  class="required" for="id_perfil">Perfil</label>
                            <br/>
                            <select name="id_perfil" id="id_perfil" style="width: 100%" title="Seleccione Perfil" >
                                {foreach from=$perfil item="perf"}
                                    <option value="{$perf->perf_id}" >{$perf->perf_descripcion}</option>
                                {/foreach}
                            </select> 
                        </td>
                    </tr>                
                </table>

                <input type="hidden" name="id_usuario" id="id_usuario" value ="-1"/>

                <span id="load"></span>

            </form>
        </fieldset>    
    </div>
</div>