<?php

include_once('ControllerBase.php');
include_once 'models/averia.php';

class cAveria extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'averia';

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

        $obj = new Averia();
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
        $obj = new Averia();
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

      // return Averia::averias($_REQUEST['id_averia']);
         $obj = new averia();
        try {
            $obj->find($_REQUEST);
            
            $tar = $obj->getFields();
            
            include_once 'models/averia.php';
            $averia = new Averia(array('id_averia'=>$obj->id_averia));
            $data=$averia->getFields();
            $tar['averia'] = Averia::averias($obj->id_averia);///
            
        } catch (ORMException $e) {
            $tar = null;
        }
        return $tar;
    }

    public function getAveriasForFacultadAjax() {
        $obj = new Averia();
        $obj = $obj->getAll()->WhereAnd("estado=", "true")->WhereAnd("facu_id=", $_REQUEST["id_facultad"]);
        return $obj->getArrayAll();
    }

    public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Averias");
        $grilla->setPager("pgaveria");
        $grilla->setTabla("lsaveria");
        $grilla->setSortname("id_averia");
        $grilla->setSortorder("DESC");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/averia/listaAveria");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("asignar", "", 5, 'false', 'false');
        $grilla->addColumnas("id_averia", "Cod.", 8);
        $grilla->addColumnas("fecha_reporte", "Fecha", 15);
        $grilla->addColumnas("hora_reporte", "Hora", 15);
        $grilla->addColumnas("facu_descripcion", "Facultad", 40);
        $grilla->addColumnas("ambi_descripcion", "Ambiente", 40);
        $grilla->addColumnas("ubic_descripcion", "Ubicacion", 40);
        $grilla->addColumnas("i.descripcion", "Incidencia", 40);
        //$grilla->addColumnas("usua_nombres", "Reportado por", 40);
        $grilla->addColumnas("personal_nombres", "Asignado A", 40);
        $grilla->addColumnas("seguimiento", "Seguimiento", 20);
        $grilla->setFnCargaCompleta("setSeguimiento");
        global $smarty;

        include_once 'models/personal.php';
        $personal = new Personal();
        $personal = $personal->getAll()->WhereAnd('estado=', 'true');
        //facultades
        include_once 'models/facultad.php';
    $facultad = new facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true');
        //AMBIENTES
        //UBICACIONES
        $smarty->assign('personal', $personal);
         $smarty->assign('facultad', $facultad);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('averia/form.tpl');
    }

    public function listaAction() {

        $db = new jsGridBdORM();

        $db->setTabla('averia');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_averia');

        $db->addColumna('id_averia');
        $db->addColumna('fecha_reporte');
        $db->addColumna('hora_reporte');
        $db->addColumna('facu_descripcion');
        $db->addColumna('ambi_descripcion');
        $db->addColumna('ubic_descripcion');
        $db->addColumna('i.descripcion');
       // $db->addColumna('usua_nombres');
        $db->addColumna('personal_nombres');
        $db->addColumna('seguimiento');

        $db->addWhereAnd("estado=", "true");

        echo $db->to_json();
    }

    public function listaAveriaAction() {
        $db = new jsGridBd();
        $db->setParametros($_REQUEST);
        $db->setFrom("
            averia as a
            INNER JOIN incidencia as i ON i.id_incidencia=a.id_incidencia
            INNER JOIN ubicacion as b ON b.ubic_id=a.ubic_id
            INNER JOIN ambiente as m ON m.ambi_id=b.ambi_id
            INNER JOIN facultad as f ON f.facu_id=m.facu_id
            INNER JOIN usuario as u ON u.usua_id=a.usua_id
            LEFT JOIN tarea as t ON t.id_averia=a.id_averia
            LEFT JOIN personal as p ON p.id_personal=t.id_personal
        ");
        $db->setSelect(" '' as asignar,
            a.id_averia,a.id_averia as id,to_char(a.fecha_reporte,'dd/MM/yyyy') ,
a.hora_reporte,
            f.facu_descripcion,
            m.ambi_descripcion,
            b.ubic_descripcion,
            i.descripcion,            
            (p.nombres||' '||p.apellido_paterno||' '||p.apellido_materno) as personal_nombres,
            CASE 
                WHEN a.seguimiento='P' THEN 'PENDIENTE'
                WHEN a.seguimiento='O' THEN 'PROCESO'
                WHEN a.seguimiento='A' THEN 'ATENDIDO'
            END as seguimiento  ");
        
       /* $usuario = $_SESSION['usuario'];
        
        if ($usuario['id_personal'] == null || $usuario['id_personal'] == '0'){
            $db->setWhere("a.id_averia=0");
        }else{
            
            include_once 'models/personal.php';
            $personal = new Personal(array('id_personal'=>$usuario['id_personal']));
            
            include_once 'models/area_administrativa.php';
            $area_administrativa = new Area_Administrativa(array('id_area'=>$personal->id_area));
            
            $db->setWhere("a.estado=TRUE and i.id_tipoaveria = " .$area_administrativa->id_tipoaveria);
        }*/
        
        

        $db->setColumnaId("id_averia");
        echo $db->to_json();
    }

    public function asignarAjax() {

        include_once 'models/tarea.php';

        $averias = $_REQUEST['averias'];
        $id_personal = $_REQUEST['id_personal'];
        $usuario = $_SESSION['usuario'];

        foreach ($averias as $value) {
            $tarea = new Tarea();
            $tarea->fecha_asignacion = date('Y-m-d');
            $tarea->hora_asignacion = date('H:i:s');
            $tarea->id_personal = $id_personal;
            $tarea->usuario_asigno = $usuario['usua_id'];
            $tarea->usuario_atendio = null;
            $tarea->codigo_referencia = '';
            $tarea->observacion = '';
            $tarea->id_averia = $value;
            $tarea->fecha_termino = null;
            $tarea->hora_termino = null;
            $tarea->create();

            $averia = new Averia(array('id_averia' => $value));
            $averia->seguimiento = 'O';
            $averia->update();
        }

        return array('ok');
    }

}

?>
