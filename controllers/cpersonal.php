<?php

include_once('ControllerBase.php');
include_once 'models/personal.php';
include_once 'models/usuario.php';

class cPersonal extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'personal';

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

        $obj = new Personal();
        $obj->setFields($_REQUEST);
        $obj->estado = 'true';
        try {
            $obj->find($_REQUEST);
            $obj->setFields($_REQUEST);
            $obj->update();
        } catch (ORMException $e) {
            $obj->create(true);
        }
        
        if ($_REQUEST['con_usuario'] == 'S'){
            
            $usuarios = new Usuario();
            $usuarios = $usuarios->getAll()->WhereAnd('id_personal=', $obj->id_personal);
            
            $nvo = 'S';
            if ($usuarios->count() > 0){
                $usuarios = $usuarios->get(0);
                $nvo = 'N';
            }else{
                $usuarios = new Usuario();
                $nvo = 'S';
            }

            $usuarios->usua_login = $_REQUEST['usuario'];
            $usuarios->usua_clave = $_REQUEST['password'];
            $usuarios->usua_documeto_identidad = $obj->dni;
            $usuarios->usua_apellido_paterno = $obj->apellido_paterno;
            $usuarios->usua_apellido_materno = $obj->apellido_materno;
            $usuarios->usua_nombres = $obj->nombres;
            $usuarios->usua_direccion = $obj->direccion;
            $usuarios->usua_telefono = $obj->telefono;
            $usuarios->usua_estado = 'true';
            $usuarios->perf_id = $_REQUEST['id_perfil'];
            $usuarios->id_personal = $obj->id_personal;
            
            if ($nvo == 'S'){
                $usuarios->create();
            }else{
                $usuarios->update();
            }
            
            $obj->usua_id = $usuarios->usua_id;
            $obj->update();
            
        }else{
            
            $usuarios = new Usuario();
            $usuarios = $usuarios->getAll()->WhereAnd('id_personal=', $obj->id_personal);

            if ($usuarios->count() > 0){
                $usuarios = $usuarios->get(0);
                $usuarios->delete();
            }
                
            $obj->usua_id = 0;
            $obj->update();
            
        }
        
        return $obj->getFields();
    }

    public function anularAjax() {
        $obj = new Personal();
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

        $obj = new Personal();
        try {
            $obj->find($_REQUEST);
            
            $per = $obj->getFields();
            
            if ($obj->usua_id > 0){
                $per['con_usuario'] = 'S';
                
                $usuarios = new Usuario();
                $usuarios = $usuarios->getAll()->WhereAnd('id_personal=', $obj->id_personal);

                if ($usuarios->count() > 0){
                    $usuarios = $usuarios->get(0);
                    
                    $per['usuario'] = $usuarios->usua_login;
                    $per['password'] = $usuarios->usua_clave;
                    $per['id_perfil'] = $usuarios->perf_id;
                    
                }else{
                    $per['con_usuario'] = 'N';
                }
                
            }else{
                $per['con_usuario'] = 'N';
            }
            
        } catch (ORMException $e) {
            $per = null;
        }
        return $per;
    }

    public function formAction() {

        $grilla = new jsGrid();

        $grilla->setCaption("Personal");
        $grilla->setPager("pgpersonal");
        $grilla->setTabla("lspersonal");
        $grilla->setSortname("nombres");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/personal/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("nombres", "Nombres");
        $grilla->addColumnas("apellido_paterno", "Apellido Paterno");
        $grilla->addColumnas("apellido_materno", "Apellido Materno");
        $grilla->addColumnas("dni", "DNI");
        $grilla->addColumnas("direccion", "Direccion");
        $grilla->addColumnas("telefono", "Telefono");
        $grilla->addColumnas("cargo", "Cargo");

        global $smarty;

        include_once 'models/area_administrativa.php';
        $area = new Area_Administrativa();
        $area = $area->getAll()->WhereAnd('estado=', 'true');

        include_once 'models/perfil.php';
        $perfil = new Perfil();
        $perfil = $perfil->getAll()->WhereAnd('perf_estado=', 'true');

        $smarty->assign('perfil', $perfil);        
        $smarty->assign('area', $area);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('personal/form.tpl');
    }

    public function listaAction() {

        $db = new jsGridBdORM();

        $db->setTabla('personal');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('id_personal');

        $db->addColumna('nombres');
        $db->addColumna('apellido_paterno');
        $db->addColumna('apellido_materno');
        $db->addColumna('dni');
        $db->addColumna('direccion');
        $db->addColumna('telefono');
        $db->addColumna('cargo');

        $db->addWhereAnd("estado=", "true");

        echo $db->to_json();
    }
}

?>
