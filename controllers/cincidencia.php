<?php

include_once('ControllerBase.php');
include_once 'models/incidencia.php';

class cIncidencia extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'incidencia';

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

        $obj = new Incidencia();
        $obj->setFields($_REQUEST);
        $obj->estado = 'true';
        //$usuario = $_SESSION['usuario'];
        //$obj->usua_id = $usuario['usua_id'];
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
        }
        return $obj->getFields();
    }

    public function guardarTareaAjax() {
        include_once 'models/tarea.php';
        include_once 'models/equipo.php';
        $obj = new Tarea();
        $ins = new Equipo();
        if ($_REQUEST['instalado'] == "true") {
            $ins->equi_descripcion = $_REQUEST['tieqd_instalado'];
            $ins->marc_id = $_REQUEST['marc_instalado'];
            $ins->equi_modelo = $_REQUEST['mode_instalado'];
            $ins->equi_partnumber = $_REQUEST['part_instalado'];
            $ins->equi_serie = $_REQUEST['seri_instalado'];
            $ins->equi_detalle = $_REQUEST['deta_instalado'];
            $ins->tieq_id = $_REQUEST['tieq_instalado'];
            $ins->create(true);
            $obj->tare_cantidad_instalado = 1;
        } else {
            $obj->tare_cantidad_instalado = 0;
        }
        $ret = new Equipo();
        if ($_REQUEST['retirado'] == "true") {
            $ret->equi_descripcion = $_REQUEST['tieqd_retirado'];
            $ret->marc_id = $_REQUEST['marc_retirado'];
            $ret->equi_modelo = $_REQUEST['mode_retirado'];
            $ret->equi_partnumber = $_REQUEST['part_retirado'];
            $ret->equi_serie = $_REQUEST['seri_retirado'];
            $ret->equi_detalle = $_REQUEST['deta_retirado'];
            $ret->tieq_id = $_REQUEST['tieq_retirado'];
            $ret->create(true);
            $obj->tare_cantidad_retirado = 1;
        } else {
            $obj->tare_cantidad_retirado = 0;
        }


        $obj->setFields($_REQUEST);
        $obj->equi_id_instalado = $ins->equi_id;
        $obj->equi_id_retirado = $ret->equi_id;
        $obj->tare_estado = 'true';

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
        $obj = new Incidencia();
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

    public function anularTareaAjax() {
        include_once 'models/tarea.php';
        $obj = new Tarea();
        try {
            $obj->find($_REQUEST);

            if ($obj->tare_estado == 'false')
                $obj->tare_estado = 'true';
            else
                $obj->tare_estado = 'false';

            $obj->update();
        } catch (ORMException $e) {
            
        }
        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Incidencia();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function getInsidenciaAjax() {

        $obj = new Incidencia();
        $obj = $obj->getAll()->WhereAnd('estado=', 'true')->WhereAnd('id_tipoaveria=', $_REQUEST['id_tipoaveria']);
        return $obj->getArrayAll();
    }
    
    public function formAction() {
        $grilla = new jsGrid();

        $grilla->setCaption("Incidencias");
        $grilla->setPager("pgincidencia");
        $grilla->setTabla("lsincidencia");
        $grilla->setSortname("id_incidencia");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/incidencia/lista?id_tipoaveria=0");
        $grilla->setWidth(400);
        $grilla->setAlto(300);

        $grilla->addColumnas("descripcion", "Descripcion");
        $grilla->addColumnas("tiempo_estimado", "Tiempo Solucion");  

        global $smarty;
        // TIPO AVERIA
        include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');
        $smarty->assign('tipo_averia', $tipo_averia);


        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('incidencia/form.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('incidencia');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_incidencia');

        $db->addColumna('descripcion');
        $db->addColumna('tiempo_estimado');

        $db->addWhereAnd("estado=", "true");
        $db->addWhereAnd("id_tipoaveria=", $_REQUEST['id_tipoaveria']);

        echo $db->to_json();
    }

    public function listaTareaAction() {
        $db = new jsGridBd();
        $db->setParametros($_REQUEST);
        $db->setFrom("
            tarea as t
            INNER JOIN tipo_trabajo as tt ON tt.titr_id=t.titr_id
            INNER JOIN falla as f ON f.fall_id=t.fall_id
            LEFT JOIN equipo as i ON i.equi_id=t.equi_id_instalado
            LEFT JOIN tipo_equipo as tei ON tei.tieq_id=i.tieq_id
            LEFT JOIN marca as mi ON mi.marc_id=i.marc_id
            LEFT JOIN equipo as r ON r.equi_id=t.equi_id_retirado
            LEFT JOIN tipo_equipo as ter ON ter.tieq_id=r.tieq_id
            LEFT JOIN marca as mr ON mr.marc_id=r.marc_id
        ");
        $db->setSelect(" 
            t.tare_id, 
            tt.titr_descripcion,f.fall_descripcion,
            t.tare_cantidad_instalado,
            tei.tieq_descripcion as tipo_equipo_instalado,
            mi.marc_descripcion as marca_instalado,
            t.tare_cantidad_retirado,
            ter.tieq_descripcion as tipo_equipo_retirado,
            mr.marc_descripcion as marca_retirado
        ");

        $db->setWhere("t.tare_estado=true AND t.id=" . $_REQUEST['id']);

        $db->setColumnaId("tare_id");
        echo $db->to_json();
    }

 
    public function getExisteAjax() {
        include_once 'models/averia.php';
        $obj = new Averia();
        $obj = $obj->getAll()->WhereAnd('estado=', 'true')->WhereAnd('id_incidencia=', $_REQUEST['id_incidencia'])
                ->WhereAnd('ubic_id=', $_REQUEST['ubic_id'])->WhereAnd('seguimiento<>', 'A')->Orderby('id_averia',true);
        
        $incidencia = new Incidencia(array('id_incidencia'=>$_REQUEST['id_incidencia']));
        
        $con_solucion = 'NO';
        $solucion = '';
        $imagen = '';
        if (strlen(trim($incidencia->posible_solucion)) > 0){
            $con_solucion = 'SI';
            $solucion = $incidencia->posible_solucion;
        }
        
        if ($obj->count() > 0){
            $obj = $obj->get($obj->count()-1);
            return array('respuesta'=>'SI','id_averia'=>$obj->id_averia,'img_averia'=>$obj->imagen,'obs_averia'=>$obj->observacion,'con_solucion'=>$con_solucion,'solucion'=>$solucion);
        }else{
            return array('respuesta'=>'NO','con_solucion'=>$con_solucion,'solucion'=>$solucion,'imagen'=>$imagen);
        }
        
    }
    
    public function calificarAction() {
        $id_averia = $_REQUEST['id'];
        $valor = $_REQUEST['rating'];
        
        include_once 'models/averia.php';
        $obj = new Averia(array('id_averia'=>$id_averia));
        $obj->calificacion = $valor;
        $obj->update();
        
        return array('ok');
    }
}

?>
