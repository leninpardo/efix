<?php

include_once('ControllerBase.php');
include_once 'models/perfil.php';

class cPerfil extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'perfil';

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

        $obj = new Perfil();
        $obj->setFields($_REQUEST);
        $obj->perf_estado = 'true';
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
            include_once 'models/modulo.php';
            include_once 'models/permiso.php';
            $modulos = new Modulo();
            $modulos = $modulos->getAll();

            $permiso = new Permiso();
            foreach ($modulos as $value) {
                $permiso->perm_estado = 'false';
                $permiso->modu_id = $value->modu_id;
                $permiso->perf_id = $obj->perf_id;
                $permiso->create(true);
            }
        }
        return $obj->getFields();
    }

    public function anularAjax() {

        $obj = new Perfil();
        try {
            $obj->find($_REQUEST);

            if ($obj->perf_estado == 'false')
                $obj->perf_estado = 'true';
            else
                $obj->perf_estado = 'false';

            $obj->update();
        } catch (ORMException $e) {
            
        }

        return $obj->getFields();
    }

    public function getAjax() {
        $obj = new Perfil();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Perfiles");
        $grilla->setPager("pgperfil");
        $grilla->setTabla("lsperfil");
        $grilla->setSortname("perf_descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/perfil/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("perf_descripcion", "Descripcion");

        global $smarty;

        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('perfil/form.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('perfil');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('perf_id');
        $db->addColumna('perf_descripcion');
        $db->addWhereAnd("perf_estado=", "true");
        echo $db->to_json();
    }

    public function permisoAction() {
        global $smarty;
        $smarty->assign('links', 'links.tpl');
        $smarty->display('permiso/form.tpl');
    }

    public function getPermisosAction() {

        include_once 'models/modulo.php';
        include_once 'lib/tree.php';
        include_once 'lib/chil.php';

        $perf_id = $_REQUEST['perf_id'];

        $padres = Modulo::modulosPadrePerfil($perf_id);

        $datos = array();

        for ($index = 0; $index < count($padres); $index++) {
            $hijos = Modulo::modulosHijoPerfil($perf_id, $padres[$index]['modu_id']);
            $numHijos = count($hijos);

            $value = new tree();

            $value->data = $padres[$index]['modu_descripcion'];
            $value->attr = new chil();
            $value->attr->id = $padres[$index]['modu_id'] . '-' . $padres[$index]['perf_id'];

            if ($numHijos > 0) {

                $value->state = "closed";

                $datoshijos = array();
                for ($indey = 0; $indey < $numHijos; $indey++) {

                    $valueh = new tree();
                    $valueh->data = $hijos[$indey]['modu_descripcion'];
                    $valueh->attr = new chil();
                    $valueh->attr->id = $hijos[$indey]['modu_id'] . '-' . $hijos[$indey]['perf_id'];
                    
                    if ($hijos[$indey]['perm_estado'] == 't')
                        $valueh->attr->class = "jstree-checked";
                    else
                        $valueh->attr->class = "jstree-unchecked";

                    $datoshijos[] = $valueh;

                    $valueh = null;
                }

                $value->children = $datoshijos;
            }
            $datos[] = $value;
            $value = null;
        }
        echo json_encode($datos);
    }

    public function actualizarPermisosAjax() {
        include_once 'models/permiso.php';
        if (isset($_REQUEST['permisos'])) {
            $permisos = $_REQUEST['permisos'];
            foreach ($permisos as $value) {
                $dm = new Permiso();
                try {
                    $ids = explode('-', $value['id']);
                    $dm = $dm->getAll()->WhereAnd('modu_id=', $ids[0])
                            ->WhereAnd('perf_id=', $ids[1]);
                    if ($dm->count() > 0) {
                        $dm = $dm->get(0);
                        $dm->perm_estado = $value['val'];
                        $dm->update();
                    }
                } catch (ORMException $e) {
                    
                }
            }
        }
    }

}

?>
