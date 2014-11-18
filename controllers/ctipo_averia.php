<?php

include_once('ControllerBase.php');
include_once 'models/tipo_averia.php';

class cTipo_Averia extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'tipo_averia';

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
        $obj = new Tipo_Averia();
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

        $obj = new Tipo_Averia();
        try {
            $obj->find($_REQUEST);

            if ($obj->estado == 'false')
                $obj->estado = 'true';
            else
                $obj->estado = 'false';

            $obj->update();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {
        $obj = new Tipo_Averia();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Tipos de Averia");
        $grilla->setPager("pgtipo_averia");
        $grilla->setTabla("lstipo_averia");
        $grilla->setSortname("descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/tipo_averia/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("descripcion", "Descripcion");

        global $smarty;

        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('tipo_averia/form.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('tipo_averia');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_tipoaveria');
        $db->addColumna('descripcion');
        $db->addWhereAnd("estado=", "true");
        echo $db->to_json();
    }

}

?>
