<?php
/**
* Smarty plugin
* 
* Parametros :
 *  id  ->''
 *  datos -> ''
 *  ancho -> 100%
 *  lectura ->false
 *  solo_numero ->false
 *  etiqueta -> ''
 *  separacion  -> 'ESPACIO' ['ESPACIO','<br/>']
*/

function smarty_function_html_combo($params, $smarty, $template)
{
    $salida = '';
    
    $id = isset($params['id'])?$params['id']:'';
    $ancho = isset($params['ancho'])?$params['ancho']:'100%';
    $lectura = isset($params['lectura'])?$params['lectura']:false;
    $requerido = isset($params['requerido'])?$params['requerido']:true;
    $etiqueta = isset($params['etiqueta'])?$params['etiqueta']:'';
    $separacion = isset($params['separacion'])?$params['separacion']:'<br/>'; //'&nbsp'
    $datos = isset($params['datos'])?$params['datos']:null;
    $id_dato = isset($params['id_dato'])?$params['id_dato']:null;
    $desc_dato = isset($params['desc_dato'])?$params['desc_dato']:null;
    $seleccione = isset($params['seleccione'])?$params['seleccione']:false;
    
    if (strlen($etiqueta) > 0){
        $salida = '<label ';
        
        if ($requerido)
            $salida = $salida . ' class="required" ';
        
        $salida = $salida . ' for="'.$id.'">'.$etiqueta.'</label>'.$separacion;
    }else{
        $etiqueta = $id;
    }
    
    
    $salida = $salida . '<select name="'.$id.'" id="'.$id.'" class="text ui-widget-content ui-corner-all"';
    $salida = $salida . 'style="width: '.$ancho.'" title="Seleccione '.$etiqueta.'" ';
    
    if ($lectura)
        $salida = $salida . ' disabled="disabled" ';
    
    $salida = $salida . '>';
    
    if ($seleccione)
        $salida = $salida . '  <option value="0" >.: SELECCIONE :.</option> ';
    
    if ($datos != null && $id_dato != null && $desc_dato != null){
        if (is_array($datos)){
            foreach ($datos as $value) {
                $salida = $salida . '  <option value="'.$value[$id_dato].'" >'.$value[$desc_dato].'</option> ';
            }
        }else{
            
            foreach ($datos as $value) {
                $salida = $salida . '  <option value="'.$value->$id_dato.'" >'.$value->$desc_dato.'</option> ';
            }
            
        }
        
    }
    
    
    $salida = $salida . '</select>';
    
    return $salida;
    
    
//        {foreach from=$tipo_beneficiario item="p"}
//            <option value="{$p->id_tipo_beneficiario}" >{$p->descripcion}</option>
//        {/foreach}

}

?>
