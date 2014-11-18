

<script type="text/javascript" src="{$HOST}js/modulos/config.js"></script>
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