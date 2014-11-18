<?php

include_once('ControllerBase.php');
include_once 'models/modulo.php';

class cModulo extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'modulo';

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
        $obj = new Modulo();
        $obj->setFields($_REQUEST);
        $obj->modu_estado = true;
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
            include_once 'models/perfil.php';
            include_once 'models/permiso.php';
            $perfil = new Perfil();
            $perfil = $perfil->getAll();
            $permiso = new Permiso();
            foreach ($perfil as $value) {
                $permiso->perm_estado = 'false';
                $permiso->modu_id = $obj->modu_id;
                $permiso->perf_id = $value->perf_id;
                $permiso->create(true);
            }
        }
        return $obj->getFields();
    }

    public function anularAjax() {

        $obj = new Modulo();
        try {
            $obj->find($_REQUEST);

            if ($obj->modu_estado == 'false')
                $obj->modu_estado = 'true';
            else
                $obj->modu_estado = 'false';

            $obj->update();
        } catch (ORMException $e) {
            
        }
        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Modulo();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }

        return $obj->getFields();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Modulo");
        $grilla->setPager("pgmodulo");
        $grilla->setTabla("lsmodulo");
        $grilla->setSortname("modu_padre");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/modulo/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("modu_descripcion", "Descripcion");
        $grilla->addColumnas("modu_url", "URL");
        $grilla->addColumnas("modu_peso", "Peso");

        global $smarty;

        $smarty->assign('dependencias', $this->getModuloAjax());
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('modulo/form.tpl');
    }

    public function getModuloAjax() {
        $obj = new Modulo();
        $obj = $obj->getAll()->WhereAnd('modu_estado=', true)->WhereAnd('modu_padre=', '0');
        return $obj->getArray();
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('modulo');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('modu_id');
        $db->addColumna('modu_descripcion');
        $db->addColumna("modu_url");
        $db->addColumna("modu_peso");
        $db->addWhereAnd("modu_estado=", true);
        $db->addOrderby("modu_peso",true);
        echo $db->to_json();
    }
    
    // Arbol de Usuario
    public function moduloAction() {
        if (isset($_SESSION['usuario'])) {
            $perf_id = $_SESSION['usuario'];
            $perf_id = $perf_id['perf_id'];
        } else {
            $perf_id = 0;
        }
        $permisos = array();
        $padres = Modulo::ModulosPadre($perf_id);
        //$xml  = "<?xml version='1.0' encoding=\"utf-8\"";
        $xml = "";
        $xml .= "<rows>\n";
        $xml .= "   <page>1</page>\n";
        $xml .= "   <total>1</total>\n";
        $xml .= "   <records>1</records>\n";

        $hasta = 0;
        $lista = 1;

        for ($index = 0; $index < count($padres); $index++) {
            $hijos = Modulo::ModulosHijo($padres[$index]['modu_id'],$perf_id);
            $numHijos = count($hijos);
            $count = $hasta;
            $count++;
            $hasta = ($numHijos * 2) + $count + 1;

            $xml .= "       <row>\n";
            $xml .= "           <cell>$lista</cell>\n";
            $xml .= "           <cell>" . $padres[$index]['modu_descripcion'] . "</cell>\n";
            $xml .= "           <cell></cell>\n";
            $xml .= "           <cell>0</cell>\n";
            $xml .= "           <cell>$count</cell>\n";
            $xml .= "           <cell>" . $hasta . "</cell>\n";
            $xml .= "           <cell>false</cell>\n";
            $xml .= "           <cell>false</cell>\n";
            $xml .= "       </row>\n";

            $lista++;

            for ($indey = 0; $indey < $numHijos; $indey++) {
                $count++;
                $xml .= "       <row>\n";
                $xml .= "           <cell>$lista</cell>\n";
                $xml .= "           <cell>" . $hijos[$indey]['modu_descripcion'] . "</cell>\n";
                $xml .= "           <cell>" . $hijos[$indey]['modu_url'] . "</cell>\n";
                $xml .= "           <cell>1</cell>\n";
                $xml .= "           <cell>$count</cell>\n";
                $xml .= "           <cell>" . ($count + 1) . "</cell>\n";
                $xml .= "           <cell>true</cell>\n";
                $xml .= "           <cell>true</cell>\n";
                $xml .= "       </row>\n";

                $lista++;
                $count++;

                $permisos[] = $hijos[$indey]['modu_url'];
            }
        }
        $xml .= "</rows>";        
        header("Content-type: text/xml");
        echo $xml;
    }
}

?>
