<?php
/**
* Smarty plugin
* 
* Parametros :
 *  id  ->''
 *  value -> ''
 *  ancho -> 100%
 *  lectura ->false
 *  solo_numero ->false
 *  etiqueta -> ''
 *  separacion  -> 'ESPACIO' ['ESPACIO','<br/>']
*/

function smarty_function_html_caja_texto($params, $smarty, $template)
{
    $salida = '';
    
    $id = isset($params['id'])?$params['id']:'';
    $value = isset($params['value'])?$params['value']:'';
    $ancho = isset($params['ancho'])?$params['ancho']:'100%';
    $lectura = isset($params['lectura'])?$params['lectura']:false;
    $requerido = isset($params['requerido'])?$params['requerido']:true;
    $solo_numero = isset($params['solo_numero'])?$params['solo_numero']:false;
    $etiqueta = isset($params['etiqueta'])?$params['etiqueta']:'';
    $separacion = isset($params['separacion'])?$params['separacion']:'<br/>'; //'&nbsp'
    
    $titulo = $etiqueta;
    
    if (strlen($etiqueta) > 0){
        $salida = '<label ';
        
        if ($requerido)
            $salida = $salida . ' class="required" ';
        
        $salida = $salida . ' for="'.$id.'">'.$etiqueta.'</label>'.$separacion;
    }else{
        $titulo = $id;
    }
    
    
    $salida = $salida . '<input type="text" id="'.$id.'" name="'.$id.'" value="'.$value.'" class="text ui-widget-content ui-corner-all"';
    $salida = $salida . 'style="width: '.$ancho.'" title="'.$titulo.'" ';
    
    if ($lectura)
        $salida = $salida . ' readonly="readonly" ';

    if ($solo_numero)
        $salida = $salida . ' onkeypress="return validarNumeros(event);" ';
    
    
    $salida = $salida . '/>';
    
    return $salida;
    
}

?>
