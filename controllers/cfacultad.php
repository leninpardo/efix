<?php

include_once('ControllerBase.php');
include_once 'models/facultad.php';

class cFacultad extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'facultad';

    /**
     *  listAjax
     *  saveAjax
     *  selectAjax
     *  deleteAjax
     */
    public function indexAction() {
        $this->formAction();
    }

    public function guardarAjax() {
        $obj = new Facultad();
        $obj->setFields($_REQUEST);
        $obj->facu_estado = 'true';
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
        }
        return $obj->getFields();
    }
    
    public function guardarCoordenadaAjax() {
        include_once 'models/coordenada.php';
        $obj = new Coordenada();
        $obj->setFields($_REQUEST);
        $obj->estado = 'true';
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
        }
        return $obj->getFields();
    }

    public function anularAjax() {

        $obj = new Facultad();
        try {
            $obj->find($_REQUEST);

            if ($obj->facu_estado == 'false')
                $obj->facu_estado = 'true';
            else
                $obj->facu_estado = 'false';
            $obj->update();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {
        $obj = new Facultad();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Facultades");
        $grilla->setPager("pgfacultad");
        $grilla->setTabla("lsfacultad");
        $grilla->setSortname("facu_descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/facultad/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("facu_descripcion", "Descripcion");

        $grillaCoordenada = new jsGrid();

        $grillaCoordenada->setCaption("Coordenadas");
        $grillaCoordenada->setPager("pgcoordenada");
        $grillaCoordenada->setTabla("lscoordenada");
        $grillaCoordenada->setSortname("id_coordenada");
        $grillaCoordenada->setUrl($_SESSION['URL_INDEX'] . "/facultad/listaCoordenada?facu_id=0)");
        $grillaCoordenada->setWidth(480);
        $grillaCoordenada->setAlto(100);
        $grillaCoordenada->setConBusqueda(false);
        $grillaCoordenada->setFullwidth(false);
        $grillaCoordenada->addColumnas("latitud", "Latitud");
        $grillaCoordenada->addColumnas("longitud", "Longitud");

        global $smarty;
        
      include_once 'models/tipo_lugares.php';
        $tipo = new tipo_lugares();
        $tipo = $tipo->getAll()->WhereAnd('tipo_estado=', 'true');

        $smarty->assign('tipo', $tipo); 
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->assign('grillaCoordenada', $grillaCoordenada->buildJsGrid());
        $smarty->display('facultad/form.tpl');
    }

    public function listaCoordenadaAction() {
        $db = new jsGridBd();
        $db->setParametros($_REQUEST);
        $db->setFrom("
            coordenada 
        ");
        $db->setSelect(" 
            id_coordenada,latitud,longitud
        ");
        $db->setWhere("estado=true AND facu_id=" . $_REQUEST['facu_id']);
        $db->setColumnaId("id_coordenada");
        echo $db->to_json();
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('facultad');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('facu_id');
        $db->addColumna('facu_descripcion');
        $db->addWhereAnd("facu_estado=", "true");
        echo $db->to_json();
    }

}

?>
