<?php

include_once('ControllerBase.php');
include_once 'models/incidencia.php';

class cGraficos extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'incidencia';

    /**
     *  listAjax
     *  saveAjax
     *  selectAjax
     *  deleteAjax
     */
    public function indexAction() {
      /*include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');
        
        include_once 'models/facultad.php';
        $facultad = new Facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true');*/
        
        global $smarty;
       /* $smarty->assign('tipo_averia',$tipo_averia);
        $smarty->assign('facultad',$facultad);*/
        $smarty->assign('links', 'links.tpl');
        $smarty->display('reportes/bi.html');
    }
    

    
}

?>
