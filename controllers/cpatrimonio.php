<?php

include_once('ControllerBase.php');
include_once 'models/patrimonio.php';

class cPatrimonio extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'patrimonio';

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
        $obj = new Patrimonio();
        $obj->setFields($_REQUEST);
//        $obj->estado = 'true';
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

        $obj = new Patrimonio();
        try {
            $obj->find($_REQUEST);

//            if ($obj->estado == 'false')
//                $obj->estado = 'true';
//            else
//                $obj->estado = 'false';

            $obj->delete();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {
        $obj = new Patrimonio();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Patrimonio");
        $grilla->setPager("pgpatrimonio");
        $grilla->setTabla("lspatrimonio");
        $grilla->setSortname("descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/patrimonio/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);
        
       // $grilla->addColumnas("id_patrimonio", "id_patrimonio");
        $grilla->addColumnas("codigo_patrimonial", "Codigo Patrimonial");
        $grilla->addColumnas("descripcion", "Descripcion");
         $grilla->addColumnas("estado", "estado");
   
        global $smarty;

        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('patrimonio/form.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('patrimonio');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_patrimonio');
        $db->addColumna('codigo_patrimonial');
        $db->addColumna('descripcion');
         $db->addColumna('estado');
        echo $db->to_json();
    }

}

?>
