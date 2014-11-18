<?php

include_once('ControllerBase.php');
include_once 'models/ambiente.php';

class cAmbiente extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'ambiente';

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

        $obj = new Ambiente();
        $obj->setFields($_REQUEST);
        $obj->ambi_estado = 'true';
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
        $obj = new Ambiente();
        try {
            $obj->find($_REQUEST);

            if ($obj->ambi_estado == 'false')
                $obj->ambi_estado = 'true';
            else
                $obj->ambi_estado = 'false';
            $obj->update();
        } catch (ORMException $e) {
            
        }
        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Ambiente();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function getAmbientesForFacultadAjax() {
        $obj = new Ambiente();
        $obj = $obj->getAll()->WhereAnd("ambi_estado=", "true")->WhereAnd("facu_id=", $_REQUEST["id_facultad"]);
        return $obj->getArrayAll();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Ambientes");
        $grilla->setPager("pgambiente");
        $grilla->setTabla("lsambiente");
        $grilla->setSortname("a.ambi_descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/ambiente/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("a.ambi_descripcion", "Ambiente");
        $grilla->addColumnas("f.facu_descripcion", "Facultad");

        global $smarty;

        include_once 'models/facultad.php';
        $facultad = new Facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true');

        $smarty->assign('facultad', $facultad);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('ambiente/form.tpl');
    }

    public function listaAction() {

        
       $db=new jsGridBd();
       $db->setParametros($_REQUEST);
       $db->setFrom(" ambiente a inner join facultad f on a.facu_id = f.facu_id ");
        
       $db->setOrder("a.ambi_descripcion");
        
       $db->setSelect(" a.ambi_id,a.ambi_descripcion,f.facu_descripcion ");

        $db->setColumnaId("ambi_id");
        
        $db->setWhere("a.ambi_estado=true");
        
        echo $db->to_json();
        
    }

}

?>
