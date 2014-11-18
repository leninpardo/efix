<?php
/**
* Smarty plugin
* 
* Parametros :
 *  id  ->''
 *  texto -> ''
 *  tipo = 'ninguna' - ['ninguna','nuevo','guardar','aceptar','modificar','cancelar','anular','cambiar']
*/

function smarty_function_html_boton($params, $smarty, $template)
{
    $salida = '';
    
    $id = isset($params['id'])?$params['id']:'';
    $texto = isset($params['texto'])?$params['texto']:'';
    $tipo = isset($params['tipo'])?$params['tipo']:'ninguna';
    
    $salida = '<button id="'.$id.'">'.$texto.'</button>';
    
    return $salida;
    
}

?>
