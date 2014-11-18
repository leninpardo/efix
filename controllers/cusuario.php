<?php

include_once('ControllerBase.php');
include_once 'models/usuario.php';

class cUsuario extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'usuario';

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

        $obj = new Usuario();
        $obj->setFields($_REQUEST);
        $obj->usua_estado = 'true';
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
        $obj = new Usuario();
        try {
            $obj->find($_REQUEST);

            if ($obj->usua_estado == 'false')
                $obj->usua_estado = 'true';
            else
                $obj->usua_estado = 'false';

            $obj->update();
        } catch (ORMException $e) {
            
        }
        $obj->usua_clave = '---';
        return $obj->getFields();
    }

    public function getAjax() {

        $obj = new Usuario();
        try {
            $obj->find($_REQUEST);
        } catch (ORMException $e) {
            $obj = null;
        }
        return $obj->getFields();
    }

    public function formAction() {

        $grilla = new jsGrid();

        $grilla->setCaption("Usuarios");
        $grilla->setPager("pgusuario");
        $grilla->setTabla("lsusuario");
        $grilla->setSortname("usua_nombres");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "/usuario/lista");
        $grilla->setWidth(400);
        $grilla->setAlto(350);

        $grilla->addColumnas("usua_nombres", "Nombres");
        $grilla->addColumnas("usua_apellido_paterno", "Apellido Paterno");
        $grilla->addColumnas("usua_apellido_materno", "Apellido Materno");
        $grilla->addColumnas("usua_documento_identidad", "DNI");
        $grilla->addColumnas("usua_direccion", "Direccion");

        global $smarty;

        include_once 'models/perfil.php';
        $perfil = new Perfil();
        $perfil = $perfil->getAll()->WhereAnd('perf_estado=', 'true');

        $smarty->assign('perfil', $perfil);
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('usuario/form.tpl');
    }

    public function listaAction() {

        $db = new jsGridBdORM();

        $db->setTabla('usuario');
        $db->setParametros($_REQUEST);

        $db->setColumnaId('usua_id');

        $db->addColumna('usua_nombres');
        $db->addColumna('usua_apellido_paterno');
        $db->addColumna('usua_apellido_materno');
        $db->addColumna('usua_documeto_identidad');
        $db->addColumna('usua_direccion');

        $db->addWhereAnd("usua_estado=", "true");

        echo $db->to_json();
    }

    public function cambiarClaveAjax() {
        $usu = $_SESSION['usuario'];
        $usuario = new usuario();
        try {
            $usuario->find(array('usua_id' => $usu['usua_id']));
            if ($usuario->usua_clave == $_REQUEST['claveactual']) {
                $usuario->usua_clave = $_REQUEST['clavenueva'];
                $usuario->update();

                $usuario->usua_clave = '---';

                return $usuario->getFields();
            } else {
                return array('error' => 'Clave actual incorrecta.');
            }
        } catch (ORMException $e) {
            return array('error' => 'Error en la autenticacion del usuario.');
        }
    }

}

?>
