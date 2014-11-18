<?php

include_once('ControllerBase.php');
include_once 'models/tarea.php';

class cTarea extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'tarea';

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
        include_once 'models/averia.php';
        include_once 'models/usuario.php';

        $obj = new Tarea();

        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $usuario = $_SESSION['usuario'];
            $obj->usuario_atendio = $usuario['usua_id'];
            $obj->fecha_termino = date('Y-m-d');
            $obj->hora_termino = date('H:i:s');
            $obj->update();

            $averia = new Averia(array("id_averia" => $obj->id_averia));
            $averia->seguimiento = 'A';
            $averia->update();
            
            $usuario = new Usuario(array('usua_id'=>$averia->usua_id));
            
            $asunto = 'Averia corregida';
            $cuerpo = 'La averia que reporto ya fue corregida.';
            $header = 'From: efixunsm@gmail.com \r\n';
            //$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";
            $header .= "Content-Type: text/plain";

           // mail(strtolower($usuario->usua_login), $asunto, utf8_decode($cuerpo), $header);
            
        } catch (ORMException $e) {
            $obj->create(true);
        }
        return $obj->getFields();
    }

    public function anularAjax() {
        $obj = new Tarea();
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

        $obj = new Tarea();
        try {
            $obj->find($_REQUEST);
            
            $tar = $obj->getFields();
            
            include_once 'models/averia.php';
            $averia = new Averia(array('id_averia'=>$obj->id_averia));
            $data=$averia->getFields();
            $tar['averia'] = Tarea::averias($obj->id_averia);///
            
        } catch (ORMException $e) {
            $tar = null;
        }
        return $tar;
        //return Tarea::bucarUbicacionAll($_REQUEST['id_averia']);
    }

    public function getInsidenciaAjax() {

        $obj = new Tarea();
        $obj = $obj->getAll()->WhereAnd('estado=', 'true')->WhereAnd('id_personal=', $_REQUEST['id_personal']);
        return $obj->getArrayAll();
    }

    public function formAction() {
        $grilla = new jsGrid();

        $grilla->setCaption("Tareas");
        $grilla->setPager("pgtarea");
        $grilla->setTabla("lstarea");
        $grilla->setSortname("id_tarea");
		  $grilla->setSortorder("DESC");
        $usuario = $_SESSION['usuario']; 
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/tarea/listaTarea?id_personal=" . $usuario['id_personal']);
        $grilla->setWidth(400);
        $grilla->setAlto(300);

        $grilla->addColumnas("fecha_asignacion", "Fecha", 15);
        $grilla->addColumnas("hora_asignacion", "Hora", 15);
        $grilla->addColumnas("f.facu_descripcion", "Facultad", 40);
        $grilla->addColumnas("ambi_descripcion", "Ambiente", 40);
        $grilla->addColumnas("ubic_descripcion", "Ubicacion", 40);
        $grilla->addColumnas("descripcion", "Incidencia", 40);
        $grilla->addColumnas("seguimiento", "Seguimiento", 20);

        $grilla->setFnCargaCompleta("setSeguimiento");

        global $smarty;
        // PERSONAL
        include_once 'models/personal.php';
        $personal = new Personal();
        $personal = $personal->getAll()->WhereAnd('estado=', 'true');
        $smarty->assign('personal', $personal);

        $smarty->assign('usuario',$usuario);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('tarea/form.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('tarea');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_tarea');

        $db->addColumna('fecha_asignacion');
        $db->addColumna('hora_asignacion');

        $db->addWhereAnd("estado=", "true");
        $db->addWhereAnd("id_personal=", $_REQUEST['id_personal']);

        echo $db->to_json();
    }

    public function listaTareaAction() {
        $db = new jsGridBd();
        $db->setParametros($_REQUEST);
        $db->setFrom("
            tarea as t
            INNER JOIN averia as a ON a.id_averia=t.id_averia
            INNER JOIN incidencia as i ON i.id_incidencia=a.id_incidencia
            INNER JOIN ubicacion as b ON b.ubic_id=a.ubic_id
            INNER JOIN ambiente as m ON m.ambi_id=b.ambi_id
            INNER JOIN facultad as f ON f.facu_id=m.facu_id
        ");
        $db->setSelect(" 
            t.id_tarea,
            to_char(t.fecha_asignacion,'dd/MM/yyyy'),
            t.hora_asignacion,
            f.facu_descripcion,m.ambi_descripcion,b.ubic_descripcion,
            i.descripcion,            
            CASE 
                WHEN a.seguimiento='P' THEN 'PENDIENTE'
                WHEN a.seguimiento='O' THEN 'PROCESO'
                WHEN a.seguimiento='A' THEN 'ATENDIDO'
            END as seguimiento
        ");

        $db->setWhere("id_personal=" . $_REQUEST['id_personal']);

        $db->setColumnaId("id_tarea");
        echo $db->to_json();
    }
    
    public function getCodigoPatrimonialAjax(){
        
        include_once 'models/patrimonio.php';
        
        $obj = new Patrimonio();
        
        $nombre = strtoupper($_REQUEST['term']);
        
        return $obj->getAll()
                ->WhereOr('upper(codigo_patrimonial) like ', $nombre.'%')
                ->getDatos(10);
    }
    
    public function getIncidenciaAjax(){
        
        return Tarea::getNumeroDias($_REQUEST['id_tarea']);
    }

}

?>
