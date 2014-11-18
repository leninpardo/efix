<?php

include_once('ControllerBase.php');
include_once 'models/area_administrativa.php';

class cArea_Administrativa extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'area_administrativa';

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
        $obj = new Area_Administrativa();
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

        $obj = new Area_Administrativa();
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
        $obj = new Area_Administrativa();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Areas Administrativas");
        $grilla->setPager("pgarea_administrativa");
        $grilla->setTabla("lsarea_administrativa");
        $grilla->setSortname("aa.descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/area_administrativa/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("aa.descripcion", "Descripcion");
        $grilla->addColumnas("ta.descripcion", "Tipo Averia");

        global $smarty;

        include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');
        
        $smarty->assign('tipo_averia', $tipo_averia);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('area_administrativa/form.tpl');
    }

    public function listaAction() {
       $db=new jsGridBd();
       $db->setParametros($_REQUEST);
       $db->setFrom(" area_administrativa aa inner join tipo_averia ta on aa.id_tipoaveria = ta.id_tipoaveria ");
        
       $db->setOrder("aa.descripcion");
        
       $db->setSelect(" aa.id_area,aa.descripcion as area,ta.descripcion as tipo ");

        $db->setColumnaId("id_area");
        
        $db->setWhere("aa.estado=true");
        
        echo $db->to_json();
    }

}

?>
