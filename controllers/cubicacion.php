<?php

include_once('ControllerBase.php');
include_once 'models/ubicacion.php';

class cUbicacion extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'ubicacion';

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

        $obj = new Ubicacion();
        $obj->setFields($_REQUEST);
        $obj->ubic_estado = 'true';
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
        $obj = new Ubicacion();
        try {
            $obj->find($_REQUEST);

            if ($obj->ubic_estado == 'false')
                $obj->ubic_estado = 'true';
            else
                $obj->ubic_estado = 'false';
            $obj->update();
        } catch (ORMException $e) {
            
        }
        return $obj->getFields();
    }

    public function getAjax() {
        return Ubicacion::bucarUbicacionAll($_REQUEST['ubic_id']);
    }

    public function getUbicacionAjax() {
        $ubi = new Ubicacion();
        $ubi = $ubi->getAll()->WhereAnd('ubic_estado=', 'true')->WhereAnd('ambi_id=', $_REQUEST['ambi_id']);
        return $ubi->getArrayAll();
    }
    
    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Ubicacions");
        $grilla->setPager("pgubicacion");
        $grilla->setTabla("lsubicacion");
        $grilla->setSortname("u.ubic_descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/ubicacion/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("u.ubic_descripcion", "Ubicacion");
        $grilla->addColumnas("a.ambi_descripcion", "Ambiente");
        $grilla->addColumnas("f.facu_descripcion", "Facultad");
        
        global $smarty;

        include_once 'models/facultad.php';
        $facultad = new Facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true');

        $smarty->assign('facultad', $facultad);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('ubicacion/form.tpl');
    }

    public function listaAction() {

       $db=new jsGridBd();
       $db->setParametros($_REQUEST);
       $db->setFrom(" ubicacion u inner join ambiente a on u.ambi_id = a.ambi_id inner join facultad f on a.facu_id = f.facu_id ");
        
       $db->setOrder("a.ambi_descripcion");
        
       $db->setSelect(" u.ubic_id ,u.ubic_descripcion,a.ambi_descripcion,f.facu_descripcion ");

        $db->setColumnaId("ubic_id");
        
        $db->setWhere("u.ubic_estado=true");
        
        echo $db->to_json();
        
    }

}

?>
